<?php

class NegotiationController extends \BaseController {
	public function index() {

		if (Auth::user()->hasRole('customer')) {

			$items = Negotiation::getCustomerNegotiatingItems();

			$orders = [];
			if (count($items)) {
				foreach ($items as $item) {
					$order_id = $item['order_id'];
					if (isset($orders[$order_id])) array_push($orders[$order_id], $item);
					else $orders[$order_id] = [ $order_id => $item ]; 
				}
			}

			$view = View::make('negotiations.index', compact('orders'))->render();
			return Response::json([
				'view' => $view
			]);

		} else if (Auth::user()->hasRole('account_manager')) {

			$unattended_items = Negotiation::getUnattendedNegotiatingItems();

			$unattended_orders = [];
			if (count($unattended_items)) {
				foreach ($unattended_items as $item) {
					$order_id = $item['order_id'];
					if (isset($unattended_orders[$order_id])) array_push($unattended_orders[$order_id], $item);
					else $unattended_orders[$order_id] = [ $order_id => $item ]; 
				}
			}

			$active_items = Negotiation::getActiveNegotiatingItems();

			$active_orders = [];
			if (count($active_items)) {
				foreach ($active_items as $item) {
					$order_id = $item['order_id'];
					if (isset($active_orders[$order_id])) array_push($active_orders[$order_id], $item);
					else $active_orders[$order_id] = [ $order_id => $item ]; 
				}
			}
			error_log(json_encode($unattended_orders, JSON_PRETTY_PRINT));

			$view = View::make('negotiations.manager_index')
						->with('unattended_orders', $unattended_orders)
						->with('active_orders', $active_orders)
						->render();

			return Response::json([
				'view' => $view
			]);
		}
	}
}