<?php

class HomeController extends \BaseController {

	public function index() {
		$pages = 5;
		$batteries = Battery::paginate($pages);

		if (Auth::check()){
			$cart_batteries = Auth::user()->getCartItems();
			return View::make('home.index', compact('batteries'))->with('cart_batteries', $cart_batteries);
		}
    	return View::make('home.index', compact('batteries'));
	}

	public function main() {
		$pages = 5;
		$batteries = Battery::paginate($pages);
		$view = View::make('home.main', compact('batteries'))->render();
		return Response::json(['view' => $view]);
	}

}
