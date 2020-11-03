<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

use function PHPUnit\Framework\throwException;

abstract class ApiController extends Controller
{
    protected Model $model;
    protected FormRequest $request;
    protected $created_by_user_column;

    protected $accessLevels = [
        'create' => 0,
        'delete' => 0,
        'detail' => 0,
        'get' => 0,
        'update' => 0
    ];

    /**
     * Привязка фильтров к БД-запросу (WHERE CLAUSE)
     */
    static function attachFilters(Request $request, Builder $queryBuilder)
    {
        $filters = $request->filters;

        if (gettype($filters) == 'array' && count($filters) > 0) {
            foreach ($filters as $filterData) {
                $operator = isset($filterData['operator']) ? $filterData["operator"] : "=";
                $values = $filterData['values'];
                $column = $filterData['column'];

                $queryBuilder->where(function ($subWhere) use ($operator, $column, $values) {
                    foreach ($values as $value) {
                        switch ($operator) {
                            case "contains": {
                                    $subWhere->orWhere($column, 'LIKE', DB::raw("'%" . $value . "%'"));
                                    break;
                                }
                            default: {
                                    $subWhere->orWhere($column, $operator, $value);
                                    break;
                                }
                        }
                    }
                });
            }
        }

        return $queryBuilder;
    }

    /**
     * Привязка пагинации к БД-запросу (LIMIT, OFFSET)
     */
    static function attachPagination(Request $request, Builder $queryBuilder)
    {
        if (gettype($request->page) == 'integer' && gettype($request->limit) == 'integer') {
            $limit = (int) $request->limit ? $request->limit : 100;
            $offset = (int) $request->page ? ($request->page * $limit) - $limit : 0;

            $queryBuilder
                ->limit($limit)
                ->offset($offset);
        }

        return $queryBuilder;
    }

    private function accessDeniedMessage()
    {
        return $this->sendError('Доступ к данной операции запрещен', 403, []);
    }

    /**
     * Проверка доступа к операции
     */
    private function checkUserAccess(string $key)
    {
        $user = Auth::user();
        $userType = gettype($user) == 'object' ? $user->userType : null;

        $userPrivilegieLevel = gettype($userType) == 'object' ? $userType->privilegie_level : 0;

        if ($this->accessLevels[$key] > $userPrivilegieLevel) {
            return false;
        }

        return true;
    }

    /**
     * Выполнить CREATE по модели
     */
    public function create(Request $request)
    {
        if (!$this->checkUserAccess('create')) {
            return $this->accessDeniedMessage();
        }

        $validated = $request->validate($this->request->rules, $this->request->messages());

        if ($validated) {

            if (gettype($this->created_by_user_column) == 'string') {
                $validated[$this->created_by_user_column] = Auth::user()->user_id;
            }

            $row = $this->model;
            $row->fill($validated);
            $created = $row->save();

            if ($created) {
                return $this->sendResponse($row, 'Новая запись создана', 201);
            }
        }
    }

    /**
     * Выполнить DELETE по модели (WHERE entity)
     */
    public function delete(int $entityId)
    {
        if (!$this->checkUserAccess('delete')) {
            return $this->accessDeniedMessage();
        }

        $entity = $this->model->find($entityId);

        if (!$entity) {
            return $this->sendError('Запись не найдена', 404);
        }

        $entityDeleted = $entity->delete();

        if ($entityDeleted) {
            return $this->sendResponse([], 'Запись успешно удалена', 204);
        }
        return $this->sendError('Произошла ошибка при удалении записи', 304);
    }

    /**
     * Выполнить SELECT по модели (WHERE entity)
     */
    public function detail(int $entityId)
    {
        if (!$this->checkUserAccess('detail')) {
            return $this->accessDeniedMessage();
        }

        $entity = $this->model->find($entityId);

        if ($this->resource) {
            $entity = $this->resource::collection($entity);
        }

        if (!$entity) {
            return $this->sendError('Запись не найдена', 404);
        }

        return $this->sendResponse($entity, 'Запись успешно найдена', 200);
    }

    /**
     * Выполнить SELECT по модели
     */
    public function get(Request $request)
    {
        if (!$this->checkUserAccess('get')) {
            return $this->accessDeniedMessage();
        }

        $queryBuilder = clone $this->model->newQuery();

        $queryBuilder = ApiController::attachPagination($request, $queryBuilder);
        $queryBuilder = ApiController::attachFilters($request, $queryBuilder);

        $totalCount = $queryBuilder->count();
        $data = $queryBuilder->get();

        $this->sendResponse($data, 'Данные успешно загружены', 200, $totalCount);
    }

    /**
     * Выполнить UPDATE по модели (WHERE entity)
     */
    public function update(int $entityId, Request $request)
    {
        if (!$this->checkUserAccess('update')) {
            return $this->accessDeniedMessage();
        }

        $entity = $this->model->find($entityId);

        if (!$entity) {
            return $this->sendError('Запись не найдена', 404);
        }

        $data = $request->validate($this->request->updateRules, $this->request->messages());

        $entity->fill($data)->save();

        return $this->sendResponse($data, 'Запись успешно обновлена', 202);
    }
}