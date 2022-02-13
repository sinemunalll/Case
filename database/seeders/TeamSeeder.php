<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->dummyData() as $key){
            Team::updateOrCreate([
                'name' => $key['name']
            ]);
        }
    }

    /**
     *
     * @return array
     */
    public function dummyData():array
    {
        return [
            1 => [
                'name'  => 'Liverpool',
            ] ,
            2 => [
                'name'  => 'Manchester City',
            ] ,
            3 => [
                'name'  => 'Chelsea',
            ] ,
            4 => [
                'name'  => 'Arsenal',
            ] ,
        ];
    }
}
