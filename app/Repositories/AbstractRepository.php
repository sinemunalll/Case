<?php


namespace App\Repositories;


use App\Exceptions\CustomException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;


abstract class AbstractRepository
{
    protected $model;
    protected $allowedSorts;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        $result = $this->model->create($data);

        return $result;
    }

    public function update(array $query, array $data)
    {
        $queryBuilder=$this->queryBuilder($this->checkFilter($query));

        $result = $queryBuilder->update($data);

        return $result;
    }


    public function first(array $query)
    {
        $queryBuilder=$this->queryBuilder($this->checkFilter($query));


        return $queryBuilder->first();
    }


    public function get(array $query)
    {
        $queryBuilder=$this->queryBuilder($this->checkFilter($query));


        return $queryBuilder->get();
    }


    public function filter(array $query)
    {
        $queryBuilder=$this->queryBuilder($this->checkFilter($query));

        return $queryBuilder
            ->paginate($query['limit'] ?? config("pagination.limit"), ["*"], "page", $query["page"] ?? 1);
    }


    protected function queryBuilder()
    {
        throw  new CustomException('QUERY_BUILDER_FUNCTION_NOT_IMPLEMENTED_FOR_THE_REPO_ABOUT'.get_class($this));
    }

    public function delete(array $query)
    {
        try {
            $queryBuilder=$this->queryBuilder($query);



            $result = $queryBuilder->delete();


            return $result;

        }catch (QueryException $e){

                throw new CustomException('DELETE_ERROR');
        }

    }

    protected function checkFilter($data)
    {
        //Querybuilder sort çalışabilmesi için;

        return $data;
    }





}
