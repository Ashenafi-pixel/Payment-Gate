<?php

namespace App\Http\Contracts;

interface IRepo
{
    /**
     * @return mixed
     */
    public function model();

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data);

    /**
     * @param array $clause
     * @param array $data
     * @return bool
     */
    public function updateByClause(array $clause, array $data): bool;

    /**
     * @param array $clause
     * @return mixed
     */
    public function deleteByClause(array $clause): bool;

    /**
     * @param int $id
     * @return object
     */
    public function findById(int $id);

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id);
}
