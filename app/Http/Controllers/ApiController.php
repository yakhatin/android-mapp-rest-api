<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

abstract class ApiController extends Controller
{
    protected Model $model;
    protected FormRequest $request;
    protected $created_by_user_column;

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

    /**
     * Выполнить SELECT по модели
     */
    public function get(Request $request)
    {
        $queryBuilder = clone $this->model->newQuery();

        $queryBuilder = ApiController::attachPagination($request, $queryBuilder);
        $queryBuilder = ApiController::attachFilters($request, $queryBuilder);

        $totalCount = $queryBuilder->count();
        $data = $queryBuilder->get();

        $this->sendResponse($data, 'Данные успешно загружены', 200, $totalCount);
    }

    /**
     * Выполнить CREATE по модели
     */
    public function create(Request $request)
    {
        $validated = $request->validate($this->request->rules, $this->request->messages());

        if ($validated) {

            if (gettype($this->created_by_user_column) == 'string') {
                $validated[$this->created_by_user_column] = Auth::user()->id;
            }

            $row = $this->model;
            $row->fill($validated);
            $created = $row->save();

            if ($created) {
                return $this->sendResponse($row, 'Новая запись создана', 201);
            }
        }
    }
}