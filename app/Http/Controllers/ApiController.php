<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

abstract class ApiController extends Controller
{
    protected Model $model;

    static function attachFilters(Builder $queryBuilder, array $filters)
    {
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

    public function get(Request $request)
    {
        $queryBuilder = clone $this->model->newQuery();

        $queryBuilder = ApiController::attachPagination($request, $queryBuilder);
        $queryBuilder = ApiController::attachFilters($queryBuilder, $request->filters);

        $totalCount = $queryBuilder->count();
        $data = $queryBuilder->get();

        $this->sendResponse($data, 'Данные успешно загружены', 200, $totalCount);
    }
}