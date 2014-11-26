<?php

class RecordController extends \BaseController {
	public function index() {
		$pages = 5;
		$records = Record::paginate($pages);

		$view = View::make('records.index', compact('records'))->render();

		return Response::json([
			'view' => $view
		]);
	}
}