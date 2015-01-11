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
			'price' => 'required|numeric|min:0'
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

	public function edit($id) {
		$battery = Battery::find($id);
		$view = View::make('batteries.edit', compact('battery'))->render();
		
		return Response::json(['view' => $view]);
	}

	public function update($id) {
		$battery = Battery::find($id);

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
			$battery->name = $input['name'];
			$battery->category = $input['category'];
			$battery->technology = $input['technology'];
			$battery->voltage = $input['voltage'];
			$battery->capacity = $input['capacity'];
			$battery->height = $input['height'];
			$battery->diameter = $input['diameter'];
			$battery->price = $input['price'];
			if (count($battery->getDirty()) > 0) {
				$battery->save();
			}
			$data['status'] = true;
			$data['message'] = 'The battery has been updated!';
		} else {
			$errors = $validator->messages();
			$data['errors'] = implode('', $errors->all('<li class="text-warning">:message</li>'));
			$data['status'] = false;
		}

		return Response::json($data);
	}

	public function destroy($id) {
		Battery::find($id)->delete();
	}

	public function show($id) {
		$battery = Battery::find($id);

		$view = View::make('batteries.show', compact('battery'))->render();

		return Response::json([
			'view' => $view
		]);
	}

}