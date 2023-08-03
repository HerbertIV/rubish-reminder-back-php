<?php

namespace App\Repositories;

use App\Dtos\Filters\Contracts\FiltersDtoContract;
use App\Repositories\Contracts\BaseRepositoryContract;
use App\Repositories\Criterion\Contracts\CriterionContract;
use Exception;
use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryContract
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Application
     */
    protected $app;

    /**
     * @param Application $app
     *
     * @throws Exception
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Configure the Model
     *
     * @return string
     */
    abstract public function model(): string;

    /**
     * Make Model instance
     *
     * @return Model
     *
     * @throws Exception
     */
    public function makeModel(): Model
    {
        $model = $this->app->make($this->model());
        if (! $model instanceof Model) {
            throw new Exception(
                "Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model"
            );
        }

        return $this->model = $model;
    }

    public function query(): Builder
    {
        return $this->model->newQuery();
    }

    public function where(array $params): Builder
    {
        return $this->query()->where($params);
    }

    public function whereIn(string $column, array $values): Builder
    {
        return $this->query()->whereIn($column, $values);
    }

    public function queryWithCriteria(?FiltersDtoContract $filtersDto = null): Builder
    {
        if ($filtersDto) {
            return $this->applyCriteria($this->query(), ($filtersDto->getCriteria() ?? []));
        }

        return $this->query();
    }

    public function applyCriteria(Builder $query, array $criteria): Builder
    {
        foreach ($criteria as $criterion) {
            if ($criterion instanceof CriterionContract) {
                $query = $criterion->apply($query);
            }
        }

        return $query;
    }

}
