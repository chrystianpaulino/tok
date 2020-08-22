<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{
    /** @var Model */
    protected $model;


    /** @var Builder */
    protected $query;


    /** @var int */
    protected $take;


    /** @var array */
    protected $with = [];


    /** @var array */
    protected $wheres = [];


    /** @var array */
    protected $whereIns = [];


    /** @var array */
    protected $orderBys = [];


    /** @var array */
    protected $scopes = [];

    public function all(): Collection
    {
        $this->newQuery()->eagerLoad();

        $models = $this->query->get();

        $this->unsetClauses();

        return $models;
    }

    public function count(): int
    {
        return $this->get()->count();
    }

    public function create(array $data): Model
    {
        $this->unsetClauses();

        return $this->model->create($data);
    }

    public function createMultiple(array $data): Collection
    {
        $models = new Collection();

        foreach ($data as $d) {
            $models->push($this->create($d));
        }

        return $models;
    }

    public function delete()
    {
        $this->newQuery()->setClauses()->setScopes();

        $result = $this->query->delete();

        $this->unsetClauses();

        return $result;
    }

    public function deleteById($id): ?bool
    {
        $this->unsetClauses();

        return $this->getById($id)->delete();
    }

    public function deleteMultipleById(array $ids): int
    {
        return $this->model->destroy($ids);
    }

    public function first(): Model
    {
        $this->newQuery()->eagerLoad()->setClauses()->setScopes();

        $model = $this->query->firstOrFail();

        $this->unsetClauses();

        return $model;
    }

    public function get(): Collection
    {
        $this->newQuery()->eagerLoad()->setClauses()->setScopes();

        $models = $this->query->get();

        $this->unsetClauses();

        return $models;
    }

    public function getById($id): Model
    {
        $this->unsetClauses();

        $this->newQuery()->eagerLoad();

        return $this->query->findOrFail($id);
    }

    public function limit(int $limit): BaseRepository
    {
        $this->take = $limit;

        return $this;
    }

    public function orderBy(string $column, string $direction = 'asc'): BaseRepository
    {
        $this->orderBys[] = compact('column', 'direction');

        return $this;
    }

    public function updateById($id, array $data): Model
    {
        $this->unsetClauses();

        $model = $this->getById($id);

        $model->update($data);

        return $model;
    }

    public function where(string $column, string $value, string $operator = '='): BaseRepository
    {
        $this->wheres[] = compact('column', 'value', 'operator');

        return $this;
    }

    public function whereIn(string $column, $values): BaseRepository
    {
        $values = is_array($values) ? $values : [$values];

        $this->whereIns[] = compact('column', 'values');

        return $this;
    }

    public function with($relations): BaseRepository
    {
        if (is_string($relations)) {
            $relations = func_get_args();
        }

        $this->with = $relations;

        return $this;
    }

    protected function newQuery(): BaseRepository
    {
        $this->query = $this->model->newQuery();

        return $this;
    }

    protected function eagerLoad(): BaseRepository
    {
        foreach ($this->with as $relation) {
            $this->query->with($relation);
        }

        return $this;
    }

    protected function setClauses(): BaseRepository
    {
        foreach ($this->wheres as $where) {
            $this->query->where($where['column'], $where['operator'], $where['value']);
        }

        foreach ($this->whereIns as $whereIn) {
            $this->query->whereIn($whereIn['column'], $whereIn['values']);
        }

        foreach ($this->orderBys as $orders) {
            $this->query->orderBy($orders['column'], $orders['direction']);
        }

        if (isset($this->take) and !is_null($this->take)) {
            $this->query->take($this->take);
        }

        return $this;
    }

    protected function setScopes(): BaseRepository
    {
        foreach ($this->scopes as $method => $args) {
            $this->query->$method(implode(', ', $args));
        }

        return $this;
    }

    protected function unsetClauses(): BaseRepository
    {
        $this->wheres   = [];
        $this->whereIns = [];
        $this->scopes   = [];
        $this->take     = null;

        return $this;
    }
}
