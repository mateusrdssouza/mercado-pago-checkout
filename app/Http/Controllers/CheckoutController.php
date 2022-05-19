<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

class CheckoutController extends Controller
{
	private $public_key;
	private $access_token;

	public function __construct()
	{
		$this->public_key = env('MERCADO_PAGO_PUBLIC_KEY');
		$this->access_token = env('MERCADO_PAGO_ACCESS_TOKEN');
	}

	public function setAccessToken()
	{
		try
		{
			\MercadoPago\SDK::setAccessToken($this->access_token);
		}
		catch(Exception $e)
		{
			die('<h2>Não foi possível estabelecer conexão</h2><p>Verifique se as chaves pública e privada foram inseridas corretamente no arquivo de configuração</p>');
		}
	}

	public function index()
	{
		$this->setAccessToken();
		return view('index', ['publicKey' => $this->public_key]);
	}

	public function process(Request $request)
	{
		switch($request->form_type)
		{
			/**
			 * 1: Pagamento com cartão de crédito
			 */
			case 1:
				return $this->processCard($request);

			/**
			 * 2: Pagamento com boleto bancário
			 */
			case 2:
				return $this->processBoleto($request);
		}
	}

	public function processCard($request)
	{
		try
		{
			$this->setAccessToken();

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

	public function processBoleto($request)
	{
		try
		{
			$this->setAccessToken();

			$payment = new \MercadoPago\Payment();
			$payment->transaction_amount = (float)$request->transactionAmount;
			$payment->description = $request->productDescription;
			$payment->payment_method_id = $request->paymentMethod;

			$payment->payer = array(
				'email' => $request->payerEmail,
				'first_name' => $request->payerFirstName,
				'last_name' => $request->payerLastName,
				'identification' => array(
					'type' => $request->docType,
					'number' => $request->docNumber
				),
				'address' =>  array(
					'zip_code' => '06233200',
					'street_name' => 'Av. das Nações Unidas',
					'street_number' => '3003',
					'neighborhood' => 'Bonfim',
					'city' => 'Osasco',
					'federal_unit' => 'SP'
				)
			);

			$payment->save();

			$response = array(
				'status' => $payment->status,
				'status_detail' => $payment->status_detail,
				'id' => $payment->id,
				'transaction_details' => $payment->transaction_details->external_resource_url
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
