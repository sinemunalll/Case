<?php


namespace App\Repositories\Score;


use App\Models\Score;

use App\Repositories\AbstractRepository;
use App\Repositories\Team\TeamRepositoryInterface;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ScoreRepository extends AbstractRepository implements TeamRepositoryInterface
{
    public function __construct(Score $model)
    {
        $this->model = $model;
    }

    protected function queryBuilder(array $query = NULL, $pagination = NULL)
    {
        return QueryBuilder::for(Score::class, new Request($query))
            ->allowedFilters([
                'point',
                'win',
                'lose',
                'draw',
                'gol_diff',

                AllowedFilter::exact('id'),
            ])
            ->defaultSort('-id')
            ->allowedSorts(['id','point','win','lose','draw','gol_diff']);
    }

    public function pointTotal($team)
    {
        return Score::where('team','=',$team)->sum('point');
    }
    public function pointWin($team)
    {
        return Score::where('team','=',$team)->sum('win');
    }
    public function pointLose($team)
    {
        return Score::where('team','=',$team)->sum('lose');
    }
    public function pointDraw($team)
    {
        return Score::where('team','=',$team)->sum('draw');
    }
    public function golDiff($team)
    {
        return Score::where('team','=',$team)->sum('gol_diff');
    }
}
