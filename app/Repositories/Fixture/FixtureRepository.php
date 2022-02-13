<?php


namespace App\Repositories\Fixture;


use App\Models\Fixture;
use App\Repositories\AbstractRepository;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class FixtureRepository extends AbstractRepository
{
    public function __construct(Fixture $model)
    {
        $this->model = $model;
    }

    protected function queryBuilder(array $query = NULL, $pagination = NULL)
    {
        return QueryBuilder::for(Fixture::class, new Request($query))
            ->allowedFilters([
                'week',
                'team1',
                'team2',
            ])
            ->defaultSort('-id')
            ->allowedIncludes('firstTeam','secondTeam')
            ->allowedSorts(['id','week']);
    }

    public function count(){
        return Fixture::all()->count();
    }


}
