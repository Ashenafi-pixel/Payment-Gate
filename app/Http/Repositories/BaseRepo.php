<?php
namespace App\Http\Repositories;

use App\Http\Contracts\IRepo;

/**
 * @var BaseRepo
 * @author farhan.akram@xintsolutions.com>
 */

abstract class BaseRepo implements IRepo
{
    /**
     * @var object
     */
    public $model;

    /**
     * BaseRepo constructor.
     *
     * @param $model
     */
    public function __construct($model)
    {
        $this->model = new $model;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Count All Records
     *
     * @return mixed
     */
    public function count()
    {
        return $this->model->count();
    }

    /**
     * @param int $paginate
     *
     * @return mixed
     */
    public function paginate(int $paginate)
    {
        return $this->model->latest()->paginate($paginate);
    }

    /**
     * @param array $data
     *
     * @return object
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function insert(array $data)
    {
        return $this->model->insert($data);
    }

    /**
     * @param int $id
     *
     * @return object
     */
    public function findById(int $id): object
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param int $id
     *
     * @return object
     */
    public function find(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * Records order by pending status
     * @return mixed
     */
    public function orderByRaw()
    {
        return $this->model->latest();
    }

    /**
     * @param int $id
     * @param array $data
     *
     * @return bool
     */
    public function update($id, $data)
    {
        return $this->model->where('id', $id)->update($data);
    }

    /**
     * @param array $clause
     * @param array $data
     *
     * @return bool
     */
    public function updateByClause(array $clause, array $data): bool
    {
        return $this->model->where($clause)->update($data);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->model->where('id', $id)->delete();
    }

    /**
     * @return mixed
     */
    public function first()
    {
        return $this->model->first();
    }

    /**
     * @param array $clause
     *
     * @return mixed
     */
    public function findByClause(array $clause)
    {
        return $this->model->where($clause)->latest();

    }

    /**
     * @param array $clause
     *
     * @return bool
     */
    public function deleteByClause(array $clause): bool
    {
        return $this->model->where($clause)->delete();
    }

    /**
     * @return object
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * @param array $clause
     * @return mixed
     */
    public function findByWhereClause(array $clause): mixed
    {
        return $this->model->where($clause)->first();
    }

}
