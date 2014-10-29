<?php

class BatteryController extends \BaseController {

	public function all() {
		$pages = 5;
		$batteries = Battery::paginate($pages);
		$view = View::make('batteries.all', compact('batteries'))->render();
		
		return Response::json([
			'view' => $view,
			'empty' => count($batteries) == 0
		]);
	}

}