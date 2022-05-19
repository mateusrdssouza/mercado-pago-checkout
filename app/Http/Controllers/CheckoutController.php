<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
	{}

/*
	MercadoPago\SDK::setAccessToken("YOUR_ACCESS_TOKEN");

	$payment = new MercadoPago\Payment();
	$payment->transaction_amount = (float)$_POST['transactionAmount'];
	$payment->token = $_POST['token'];
	$payment->description = $_POST['description'];
	$payment->installments = (int)$_POST['installments'];
	$payment->payment_method_id = $_POST['paymentMethodId'];
	$payment->issuer_id = (int)$_POST['issuer'];

	$payer = new MercadoPago\Payer();
	$payer->email = $_POST['cardholderEmail'];
	$payer->identification = array(
		"type" => $_POST['identificationType'],
		"number" => $_POST['identificationNumber']
	);
	$payer->first_name = $_POST['cardholderName'];
	$payment->payer = $payer;

	$payment->save();

	$response = array(
		'status' => $payment->status,
		'status_detail' => $payment->status_detail,
		'id' => $payment->id
	);

	echo json_encode($response);
*/
}
