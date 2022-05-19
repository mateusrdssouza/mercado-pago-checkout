<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

class CheckoutController extends Controller
{
	private $public_key;

	public function __construct()
	{
		$this->public_key = env('MERCADO_PAGO_PUBLIC_KEY');
		$this->access_token = env('MERCADO_PAGO_ACCESS_TOKEN');
		\MercadoPago\SDK::setAccessToken($this->access_token);
	}

	public function index()
	{
		return view('index', ['publicKey' => $this->public_key]);
	}

	public function process(Request $request)
	{
		switch($request->form_type)
		{
			case 1:
				return $this->processCard($request);
		}
	}

	public function processCard($request)
	{
		try
		{
			$payment = new \MercadoPago\Payment();
			$payment->transaction_amount = (float)$request->transaction_amount;
			$payment->token = $request->token;
			$payment->description = $request->description;
			$payment->installments = (int)$request->installments;
			$payment->payment_method_id = $request->payment_method_id;
			$payment->issuer_id = (int)$request->issuer_id;

			$payer = new \MercadoPago\Payer();
			$payer->email = $request->payer['email'];
			$payer->identification = array(
				'type' => $request->payer['identification']['type'],
				'number' => $request->payer['identification']['number']
			);

			$payment->payer = $payer;

			$payment->save();

			$response = array(
				'status' => $payment->status,
				'status_detail' => $payment->status_detail,
				'id' => $payment->id
			);

			return response()->json($response, 201);
		}
		catch(Exception $e)
		{
			$response = array(
				'error_message' => $e->getMessage()
			);

			return response()->json($response, 400);
		}
	}
}
