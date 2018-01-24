<?php
/**
 * Created by PhpStorm.
 * User: Ontik Technology 3
 * Date: 20-07-17
 * Time: 17.55
 */

namespace App\Lib;

use App\Models\ModuleDelete\ModuleDelete;

class RouteOption
{
	public function ticket()
	{
		return ModuleDelete::find(1);
	}

	public function manPower()
	{
		return ModuleDelete::find(2);
	}

	public function recruit()
	{
		return ModuleDelete::find(3);
	}

	public function hazz()
	{
		return ModuleDelete::find(4);
	}

	public function umrah()
	{
		return ModuleDelete::find(5);
	}

	public function hrm()
	{
		return ModuleDelete::find(6);
	}

	public function pms()
	{
		return ModuleDelete::find(7);
	}

}