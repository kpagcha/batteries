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

	public function create() {
		$input = Input::except('_token');

		$validator = Validator::make($input, [
			'id' => 'unique',
			'name' => 'required',
			'category' => 'required',
			'voltage' => 'required|numeric|min:0',
			'capacity' => 'integer',
			'height' => 'numeric|min:0',
			'diameter' => 'numeric|min:0',
			'price' => 'numeric|min:0'
		]);

		$data = [
			'status' => null,
			'message' => null,
			'errors' => null
		];

		if ($validator->passes()) {
			$battery = new Battery($input);
			$battery->save();
			$data['status'] = true;
			$data['message'] = 'A new battery has been created!';
		} else {
			$data['status'] = false;
			$errors = $validator->messages();
			$data['errors'] = implode('', $errors->all('<li class="alert-warning">:message</li>'));
		}

		return Response::json($data);
	}

}