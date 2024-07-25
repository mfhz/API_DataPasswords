<?php

namespace App\Traits;

trait ApiResponse{

	protected function successResponse($data, $message = null, $code = 200)
	{
		return response([
			'status'=> 'Success',
			'message' => $message,
			'data' => $data,
            'errors' => null,
            'code' => $code
		])->setStatusCode($code);
	}

	protected function infoResponse($errorMessages, $errors)
	{
		return response([
			'status'   => 'Error',
			'message'   => 'The given data was invalid',
			'data'      => $errorMessages,
			'errors'      => $errors
		]);
	}

	protected function errorResponse($errorMessages, $errors = [], $code = 404, $trace = [])
	{
		return response()->json([
			'status'=>'Error',
			'message' => $errorMessages,
			'data' => null,
			'errors' => $errors,
			'code' => $code,
			'trace' => $trace
		], $code);
	}

}
