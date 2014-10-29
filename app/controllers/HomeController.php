<?php

class HomeController extends \BaseController {

	public function index() {
		$view = View::make('home.index')->render();
		return Response::json(['view' => $view]);
	}

	public function main() {
		$view = View::make('home.main')->render();
		return Response::json(['view' => $view]);
	}

}
