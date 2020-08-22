<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function all(): Collection;

    public function count(): int;

    public function create(array $data): Model;

    public function createMultiple(array $data): Collection;

    public function delete();

    public function deleteById($id): ?bool;

    public function deleteMultipleById(array $ids): int;

    public function first(): Model;

    public function get(): Collection;

    public function getById($id): Model;

    public function limit(int $limit): BaseRepository;

    public function orderBy(string $column, string $direction = 'asc'): BaseRepository;

    public function updateById($id, array $data): Model;

    public function where(string $column, string $value, string $operator = '='): BaseRepository;

    public function whereIn(string $column, $values): BaseRepository;

    public function with($relations): BaseRepository;
}
