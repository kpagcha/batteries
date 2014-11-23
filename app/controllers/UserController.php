<?php

class UserController extends \BaseController {

	public function index() {
		$pages = 5;
		$users = User::paginate($pages);

		$roles = array();
		$all_roles = Role::all();
		foreach ($all_roles as $value) {
			$roles[$value['name']] = str_replace('_', ' ', ucfirst($value['name']));
		}
		$view = View::make('users.index', compact('users'))->with('roles', $roles)->render();

		return Response::json([
			'view' => $view,
			'empty' => count($users) == 0
		]);
	}

	public function create() {
		$rules = [
			'email' => 'required|email|unique:users',
			'password' => 'required|confirmed|min:8',
			'password_confirmation' => 'required',
			'first_name' => 'required|alpha|min:2',
			'last_name' => 'required|alpha|min:2',
			'city' => 'alpha|min:2',
			'country' => 'alpha|size:2',
			'phone' => 'between:8,12'
		];
		$validator = Validator::make(Input::except('_token'), $rules);

		if ($validator->passes()) {
			$input = Input::except('_token', 'password_confirmation');

			$user = new User();
			$user->email = $input['email'];
			$user->password = Hash::make($input['password']);
			$user->first_name = $input['first_name'];
			$user->last_name = $input['last_name'];
			$user->city = $input['city'];
			$user->country = strtoupper($input['country']);
			$user->phone = $input['phone'];

			$user->save();
			$user->setRole($input['role']);
			
			return Response::json([
				'status' => true,
				'message' => 'The user has been created.'
			]);
		} else {
			return Response::json([
				'status' => false,
				'errors' => implode('', $validator->messages()->all('<li class="alert-warning">:message</li>'))
			]);
		}
	}

	public function destroy($id) {
		if (Auth::user()->id != $id) {
			User::find($id)->delete();
			return Response::json(['status' => true]);
		} else {
			return Response::json(['status' => false, 'message' => 'You cannot delete yourself!']);
		}
	}

	public function login() {
		$view = View::make('users.login')->render();

		return Response::json(['view' => $view]);
	}

	public function signin() {
		$user = [
			'email' => Input::get('email'),
			'password' => Input::get('password')
		];

		if (Auth::attempt($user)) {
			// return Redirect::route('root')->with('flash_notice', 'You are successfully logged in!');
	        return Response::json([
				'status' => true,
				'notice' => 'You are successfully logged in!'
			]);
	    }
	    
	    return Response::json([
	    	'status' => false,
	    	'error' => 'Your email or password combination was incorrect.'
	    ]);
	}

	public function logout() {
		Auth::logout();

		return Response::json([
			'notice' => 'You are successfully logged out'
		]);
		// return Redirect::route('root')->with('flash_notice', 'You are successfully logged out.');
	}

	public function profile() {
		
	}

	public function register() {
		$view = View::make('users.register')->render();

		return Response::json(['view' => $view]);
	}

	public function signup() {
		$rules = [
			'email' => 'required|email|unique:users',
			'password' => 'required|confirmed|min:8',
			'password_confirmation' => 'required',
			'first_name' => 'required|alpha|min:2',
			'last_name' => 'required|alpha|min:2',
			'city' => 'alpha|min:2',
			'country' => 'alpha|size:2',
			'phone' => 'between:8,12'
		];
		$validator = Validator::make(Input::except('_token'), $rules);

		if ($validator->passes()) {
			$input = Input::except('_token', 'password_confirmation');

			$user = new User();
			$user->email = $input['email'];
			$user->password = Hash::make($input['password']);
			$user->first_name = $input['first_name'];
			$user->last_name = $input['last_name'];
			$user->city = $input['city'];
			$user->country = strtoupper($input['country']);
			$user->phone = $input['phone'];

			$user->save();
			$user->setRole('customer');

			Auth::login($user);
			
			return Response::json([
				'status' => true,
				'notice' => 'You have been registered successfully!'
			]);
		} else {
			return Response::json([
				'status' => false,
				'errors' => implode('', $validator->messages()->all('<li class="alert-warning">:message</li>'))
			]);
		}
	}
}