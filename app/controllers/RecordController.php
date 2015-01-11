<?php

class RecordController extends \BaseController {
	public function index() {
		$pages = 5;
		$records = Record::orderBy('created_at', 'desc')->paginate($pages);

		$view = View::make('records.index', compact('records'))->render();

		return Response::json([
			'view' => $view
		]);
	}
}