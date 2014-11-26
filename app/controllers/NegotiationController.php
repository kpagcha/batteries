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

			$unattended_orders = $this->getUnattendedOrders();

			$active_orders = $this->getActiveOrders();

			$view = View::make('negotiations.manager_index')
						->with('unattended_orders', $unattended_orders)
						->with('active_orders', $active_orders)
						->render();

			return Response::json([
				'view' => $view
			]);
		}
	}

	/* Assigns the negotiation to the manager */
	public function take() {
		$manager_id = Auth::user()->id;
		$negotiation = Negotiation::find(Input::get('negotiation-id'));
		$negotiation->manager_id = $manager_id;
		$negotiation->setStatus('in_process');
		$negotiation->turn = $negotiation->user_id;
		$negotiation->save();

		$this->saveRecord($negotiation);

		$status_id = Status::where('name', '=', 'in_process')->first()->id;
		$is_first_negotiation = count(Negotiation::where('manager_id', '=', 'manager_id')
														->where('status_id', '=', $status_id)) == 1;

		$status_id = Status::where('name', '=', 'open')->first()->id;
		$no_more_waiting_negotiations = count(Negotiation::where('status_id', '=', $status_id)->get()) == 0;

		$view = null;

		if ($is_first_negotiation) {
			$active_orders = $this->getActiveOrders();
			$view = View::make('negotiations.active_negotiations_list', compact('active_orders'))->render();
		} else {
			$view = View::make('negotiations.active_negotiation')->with('item', end($this->getActiveOrders()))->render();
		}

		return Response::json([
			'status' => true,
			'first' => $is_first_negotiation,
			'view' => $view,
			'no_more_waiting_negotiations' => $no_more_waiting_negotiations
		]);
	}

	/* Open negotiation process */
	public function negotiate() {
		$negotiation = Negotiation::find(Input::get('negotiation-id'));

		$view = View::make('negotiations.negotiate', compact('negotiation'))->render();

		return Response::json([
			'view' => $view
		]);
	}

	/* Returns the counter-offer form view */
	public function counterOfferForm() {
		$negotiation_id = Input::get('negotiation-id');
		$form = View::make('negotiations.counter_offer_form', compact('negotiation_id'))->render();

		return Response::json(['form' => $form, 'negotiation_id' => $negotiation_id]);
	}

	/* -------------------------------------------------------------------------------------------------------------*/
	/* Private functions */

	private function getUnattendedOrders() {
		$unattended_items = Negotiation::getUnattendedNegotiatingItems();

		$unattended_orders = [];
		if (count($unattended_items)) {
			foreach ($unattended_items as $item) {
				$order_id = $item['order_id'];
				if (isset($unattended_orders[$order_id])) array_push($unattended_orders[$order_id], $item);
				else $unattended_orders[$order_id] = [ $order_id => $item ]; 
			}
		}

		return $unattended_orders;
	}

	private function getActiveOrders() {
		$active_items = Negotiation::getActiveNegotiatingItems();

		$active_orders = [];
		if (count($active_items)) {
			foreach ($active_items as $item) {
				$order_id = $item['order_id'];
				if (isset($active_orders[$order_id])) array_push($active_orders[$order_id], $item);
				else $active_orders[$order_id] = [ $order_id => $item ]; 
			}
		}

		return $active_orders;
	}

	private function saveRecord($negotiation) {
		$record = new Record;
		$record->battery_id = $negotiation->battery_id;
		$record->price = $negotiation->price;
		$record->amount = $negotiation->amount;
		$record->customer_id = $negotiation->user_id;
		$record->manager_id = $negotiation->manager_id;
		$record->status_id = $negotiation->status_id;
		$record->save();
	}
}