<?php
/**
 * Created by PhpStorm.
 * User: Ontik Technology 3
 * Date: 30-07-17
 * Time: 06.09
 */

namespace App\Lib;


use App\Models\Deshboard\Reminder;
use Illuminate\Support\Facades\Auth;

class Deshboard
{
    public function Reminder()
    {
        return Reminder::where('created_by',Auth::id())->orderBy('id', 'DESC')->take(50)->get();
    }
}