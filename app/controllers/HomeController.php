<?php

class HomeController extends \BaseController {

	public function index() {
		$batteries = Battery::all();
    	return View::make('home.index', compact('batteries'));
		return Response::json(['view' => $view]);
	}

	public function main() {
		$batteries = Battery::all();
		$view = View::make('home.main', compact('batteries'))->render();
		return Response::json(['view' => $view]);
	}

}
