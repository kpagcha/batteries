<?php

class CartController extends \BaseController {
	public function index() {
		$cart_batteries = Auth::user()->getCartItems();
		$view = View::make('cart.index', compact('cart_batteries'))->render();
		return Response::json(['view' => $view]);
	}

	public function add() {
		$battery_id = Input::get('battery-id');
		$user_id = Auth::user()->id;

		$cart = Cart::where('battery_id', '=', $battery_id)->where('user_id', '=', $user_id)->first();

		$json = [];
		if ($cart) {
			$cart->amount = $cart->amount + 1;
			$json['message'] = 'Item already existed in your cart. Amount increased by one (' . $cart->amount . ' units).';
		} else {
			$cart = new Cart;
			$cart->battery_id = $battery_id;
			$cart->user_id = $user_id;
			$json['message'] = 'Item added to your cart.';
		}
		$cart->save();

		return Response::json($json);
	}

	public function destroy($id) {
		Cart::where('battery_id', '=', $id)->where('user_id', '=', Auth::user()->id)->first()->delete();

		return Response::json(['count' => DB::table('carts')->count()]);
	}

	public function changeAmount() {
		$battery_id = Input::get('battery-id');
		$user_id = Auth::user()->id;
		$amount = Input::get('amount');

		$cart = Cart::where('battery_id', '=', $battery_id)->where('user_id', '=', $user_id)->first();
		if ($amount > 0 || ($amount < 0 && $cart->amount > 1)) {
			$cart->amount = $cart->amount + $amount;
			$cart->save();
		}

		return Response::json(['amount' => $cart->amount]);
	}
}