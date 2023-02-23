<?php

namespace App\Repositories;

use App\Events\CreateModelEvent;
use App\Events\Regions\RegionCreateEvent;
use App\Repositories\Contracts\BaseRepositoryContract;
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
    abstract public function model();

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
}
