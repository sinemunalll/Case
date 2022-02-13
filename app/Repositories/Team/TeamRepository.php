<?php


namespace App\Repositories\Team;


use App\Models\Product;
use App\Models\Team;
use App\Repositories\AbstractRepository;
use App\Repositories\Team\TeamRepositoryInterface;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TeamRepository extends AbstractRepository implements TeamRepositoryInterface
{
    public function __construct(Team $model)
    {
        $this->model = $model;
    }

    protected function queryBuilder(array $query = NULL, $pagination = NULL)
    {
        return QueryBuilder::for(Team::class, new Request($query))
            ->allowedFilters([
                'name',
                AllowedFilter::exact('id'),
            ])
            ->defaultSort('-id')
            ->allowedSorts(['id','name']);
    }
}
