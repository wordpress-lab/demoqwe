<?php namespace App\Lib;


use App\Models\Recruit\ExpenseSector;

Class Category {



    public function getlist()
    {
     $cat = \App\Models\Document\Category::all();

      return $cat;

    }

    public function ExpenseSector()
    {
        $sec = ExpenseSector::all();

        return $sec;

    }

}