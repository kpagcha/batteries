<?php

class OrderController extends \BaseController {
	public function create() {
		$order = new Order;
		$user_id = Auth::user()->id;
		$current_user_cart = Cart::where('user_id', '=', $user_id)->get();

		$order->setStatus('open');
		$order->save();

		foreach ($current_user_cart as $cart_item) {
			$negotiation = new Negotiation;
			$negotiation->price = $cart_item->battery->price;
			$negotiation->amount = $cart_item->amount;
			$negotiation->user_id = $user_id;
			$negotiation->battery_id = $cart_item->battery->id;
			$negotiation->setStatus('open');
			$negotiation->save();

			$order->negotiations()->save(Negotiation::find($negotiation->id));

			$cart_item->delete();

			$record = new Record;
			$record->battery_id = $cart_item->battery->id;
			$record->price = $cart_item->battery->price;
			$record->amount = $cart_item->amount;
			$record->customer_id = $user_id;
			$record->order_id = $order->id;
			$record->status_id = $negotiation->status_id;
			$record->save();
		}
	}
}