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

	public function checkoutForm() {
		$order = Order::find(Input::get('order-id'));

		$view = View::make('orders.checkout_form')->with('order', $order)->render();

		return Response::json([
    		'view' => $view
		]);
	}

	public function deliveryDate($address) {
		
		$origin = 'Grunwaldzka 69, Wrocław, Polska';

		$url = "http://maps.googleapis.com/maps/api/directions/json?origin=" . $origin . "&destination=" . $address . "&sensor=false&language=en";

		$json = json_decode(file_get_contents(str_replace(" ", "%20", $url)), true);

		if ($json['status'] == 'OK') {
			try {
				$delivery_duration = intval($json['routes'][0]['legs'][0]['duration']['value']);

				$distribution_time = 5*60*60;

				$date = new DateTime();
				$date_in_secs = strtotime($date->format('Y-m-d H:i:s'));
				$new_date = $date_in_secs + $delivery_duration + $distribution_time;

				if (intval(date('H', $new_date)) > 21 || intval(date('H', $new_date)) < 8) {
				    $date->setTime(8, 0, 0);
				    $date->add(new DateInterval('P1D'));
				}

				$date = $date->format('l d F H:i Y');

				return Response::json([
					'date' => $date
				]);
			} catch(Exception $e){
				error_log($e->getMessage());
			}
		}
	}

	public function destroy($id) {
		try{
		$order = Order::find($id);

		$negotiations = $order->negotiations;
		foreach ($negotiations as $negotiation) {
			$negotiation->setStatus('rejected');
			$negotiation->save();
			$this->saveRecord($negotiation);
		}
		
		$order->delete();

		$view = View::make('orders.delete')->render();

		return Response::json(['view' => $view]);
	}catch(Exception $e){error_log($e->getMessage());}
	}

	private function saveRecord($negotiation) {
		$record = new Record;
		$record->battery_id = $negotiation->battery_id;
		$record->price = $negotiation->price;
		$record->amount = $negotiation->amount;
		$record->customer_id = $negotiation->user_id;
		$record->manager_id = $negotiation->manager_id;
		$record->status_id = $negotiation->status_id;
		$record->order_id = $negotiation->order_id;
		$record->save();
	}
}