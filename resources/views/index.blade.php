<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
		<meta name="generator" content="Hugo 0.98.0">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>Checkout Transparente</title>
		<script src="https://sdk.mercadopago.com/js/v2"></script>
		<script src="{{ asset('js/jquery.min.js') }}"></script>
		<script src="{{ asset('js/jquery.mask.js') }}"></script>
		<link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/checkout/">
		<link href="https://getbootstrap.com/docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://getbootstrap.com/docs/5.2/examples/checkout/form-validation.css" rel="stylesheet">
	</head>
	<body class="bg-light">
		<div class="container">
			<main>

				<div class="py-4 text-center">
					<img class="d-block mx-auto mt-3 mb-3" src="{{ asset('img/logo.png') }}" alt="" height="60">
				</div>

				<div id="productDetails">

					<div class="card">
						<div class="row card-body">
							<div class="col-md-6">
								<h4>Produto</h4>
								<p class="mb-0">Fone de Ouvido Bluetooth</p>
							</div>
							<div class="col-md-6">
								<h4>Valor</h4>
								<p class="mb-0">R$ 100,00</p>
							</div>
						</div>
					</div>

					<br>

					<h4 class="mt-2 mb-3 mx-1">Selecione o método de pagamento</h4>

				</div>

				<div class="accordion mb-5" id="accordionExample">
					<div class="accordion-item">
						<h2 class="accordion-header" id="headingOne">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
								<h5>Cartão de Crédito</h5>
							</button>
						</h2>
						<div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
							<div class="accordion-body">
								<div class="row g-12">
									<div class="col-lg-10 offset-lg-1">

										<form id="form-checkout-card">
											@csrf

											<div class="row g-3 mt-3">

												<h4 class="mb-3">Dados do Comprador</h4>

												<div class="col-md-6">
													<label for="cardholderName" class="form-label">Nome Completo</label>
													<input type="text" class="form-control" id="form-checkout__cardholderName" name="cardholderName">
												</div>

												<div class="col-md-6">
													<label for="cardholderEmail" class="form-label">E-mail</label>
													<input type="email" class="form-control" id="form-checkout__cardholderEmail" name="cardholderEmail">
												</div>

												<div class="col-md-6">
													<label for="identificationType" class="form-label">Tipo de Documento</label>
													<select class="form-select" id="form-checkout__identificationType" name="identificationType"></select>
												</div>

												<div class="col-md-6">
													<label for="identificationNumber" class="form-label">Número do documento</label>
													<input type="text" class="form-control" id="form-checkout__identificationNumber" name="identificationNumber">
												</div>

											</div>

											<div class="row g-3 mt-4">

												<h4 class="mb-3">Dados de Pagamento</h4>

												<div class="col-md-6">
													<label for="cardNumber" class="form-label">Número do Cartão</label>
													<input type="text" class="form-control" name="cardNumber" id="form-checkout__cardNumber">
												</div>

												<div class="col-md-6">
													<label for="expirationDate" class="form-label">Data de Vencimento</label>
													<input type="text" class="form-control" name="expirationDate" id="form-checkout__expirationDate">
												</div>

												<div class="col-md-6">
													<label for="securityCode" class="form-label">Código de Segurança</label>
													<input type="text" class="form-control" name="securityCode" id="form-checkout__securityCode">
												</div>

												<div class="col-md-6">
													<label for="issuer" class="form-label">Operadora</label>
													<select class="form-select" name="issuer" id="form-checkout__issuer"></select>
												</div>

												<div class="col-12">
													<label for="installments" class="form-label">Parcelas</label>
													<select class="form-select" name="installments" id="form-checkout__installments"></select>
												</div>

											</div>

											<button class="w-100 btn btn-primary btn-lg my-5"ctype="submit" id="form-checkout__submit">Finalizar pagamento</button>

										</form>

									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="accordion-item">
						<h2 class="accordion-header" id="headingTwo">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								<h5>Boleto Bancário</h5>
							</button>
						</h2>
						<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
							<div class="accordion-body">
								<div class="row g-12">
									<div class="col-lg-10 offset-lg-1">

										<form id="form-checkout-boleto">
											<input type="hidden" name="form_type" value="2">
											<input type="hidden" name="transactionAmount" value="100">
											<input type="hidden" name="productDescription" value="Fone de Ouvido Bluetooth">
											@csrf

											<div class="row g-3 mt-3">

												<h4 class="mb-3">Pagamento</h4>

												<div class="col-12">
													<label for="paymentMethod" class="form-label">Método de Pagamento</label>
													<select class="form-select" name="paymentMethod" id="paymentMethod">
														<option value="bolbradesco">Boleto</option>
													</select>
												</div>

											</div>

											<div class="row g-3 mt-4">

												<h4 class="mb-3">Dados do Comprador</h4>

												<div class="col-md-6">
													<label for="payerFirstName" class="form-label">Nome</label>
													<input type="text" class="form-control" id="payerFirstName" name="payerFirstName" required>
												</div>

												<div class="col-md-6">
													<label for="payerLastName" class="form-label">Sobrenome</label>
													<input type="text" class="form-control" id="payerLastName" name="payerLastName" required>
												</div>

												<div class="col-md-12">
													<label for="payerEmail" class="form-label">E-mail</label>
													<input type="email" class="form-control" id="payerEmail" name="payerEmail" required>
												</div>

												<div class="col-md-6">
													<label for="docType" class="form-label">Tipo de Documento</label>
													<select class="form-select" id="docType" name="docType" required>
														<option value="CPF">CPF</option>
														<option value="CNPJ">CNPJ</option></select>
													</select>
												</div>

												<div class="col-md-6">
													<label for="docNumber" class="form-label">Número do documento</label>
													<input type="text" class="form-control" id="docNumber" name="docNumber" required>
												</div>

											</div>

											<button class="w-100 btn btn-primary btn-lg my-5" type="submit" id="btnBoleto">Finalizar pagamento</button>

										</form>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div id="finalCard" style="display:none">
					<h1 class="display-4 mt-5 fw-normal text-center">Obrigado!</h1>
					<h3 class="text-center mt-3 fw-light">Você receberá os detalhes da sua compra no seu e-mail.</h3>
				</div>

				<div id="finalBoleto" style="display:none">
					<h1 class="display-4 mt-5 fw-normal text-center">Obrigado!</h1>
					<h3 class="text-center mt-3 fw-light">Você receberá os detalhes da sua compra no seu e-mail.</h3>
					<a href="" id="linkBoleto" class="w-100 btn btn-primary btn-lg my-4" target="_blank">Imprimir boleto</a>
				</div>

			</main>
		</div>

		<script src="https://getbootstrap.com/docs/5.2/dist/js/bootstrap.bundle.min.js"></script>
		<script src="https://getbootstrap.com/docs/5.2/examples/checkout/form-validation.js"></script>

		<script>

			const mp = new MercadoPago('{{ $publicKey }}');

			const cardForm = mp.cardForm({
				amount: "100",
				autoMount: true,
				form: {
					id: "form-checkout-card",
					cardholderName: {
						id: "form-checkout__cardholderName",
						placeholder: "Digite seu nome completo"
					},
					cardholderEmail: {
						id: "form-checkout__cardholderEmail",
						placeholder: "Digite seu e-mail"
					},
					identificationType: {
						id: "form-checkout__identificationType",
						placeholder: "Selecione um tipo de documento"
					},
					identificationNumber: {
						id: "form-checkout__identificationNumber",
						placeholder: "Digite o número do seu documento"
					},
					cardNumber: {
						id: "form-checkout__cardNumber",
						placeholder: "Digite o número do seu cartão"
					},
					expirationDate: {
						id: "form-checkout__expirationDate",
						placeholder: "MM/YY"
					},
					securityCode: {
						id: "form-checkout__securityCode",
						placeholder: "Digite o código de segurança"
					},
					issuer: {
						id: "form-checkout__issuer",
						placeholder: "Selecione uma operadora"
					},
					installments: {
						id: "form-checkout__installments",
						placeholder: "Selecione a quantidade de parcelas"
					},
				},
				callbacks: {
					onFormMounted: error => {
						if (error) return console.warn("Form Mounted handling error: ", error);
						console.log("Form mounted");
					},
					onSubmit: event => {

						event.preventDefault();

						const {
							paymentMethodId: payment_method_id,
							issuerId: issuer_id,
							cardholderEmail: email,
							amount,
							token,
							installments,
							identificationNumber,
							identificationType,
						} = cardForm.getCardFormData();

						fetch("/process", {
							method: "POST",
							headers: {
								"Content-Type": "application/json",
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
							body: JSON.stringify({
								form_type: Number(1),
								token,
								issuer_id,
								payment_method_id,
								transaction_amount: Number(amount),
								installments: Number(installments),
								description: "Fone de Ouvido Bluetooth",
								payer: {
									email,
									identification: {
										type: identificationType,
										number: identificationNumber,
									},
								},
							}),
						})
						.then(response => {
							return response.json();
						})
						.then(result => {
							if(!result.hasOwnProperty('error_message') && result.id != null) {
								$('#productDetails, #accordionExample').hide('slow');
								$('#finalCard').show('slow');
							}
							else {
								alert("Ocorreu um erro ao efetuar o pagamento.");
							}
						})
						.catch(error => {
							alert("Ocorreu um erro ao efetuar o pagamento.");
						});
					},
					onFetching: (resource) => {
						console.log("Fetching resource: ", resource);
					}
				},
			});

		</script>

		<script>

			$('#form-checkout-boleto').submit(function(e) {

				e.preventDefault();

				var form = $(this);
				var actionUrl = form.attr('action');

				$.ajax({
					type: 'POST',
					url: '/process',
					data: form.serialize(),
					beforeSend: function() {
						$('#btnBoleto').addClass('disabled');
					},
					success: function(result) {
						if(!result.hasOwnProperty('error_message') && result.id != null) {
							$('#linkBoleto').prop('href', result.transaction_details);
							$('#productDetails, #accordionExample').hide('slow');
							$('#finalBoleto').show('slow');
						}
						else {
							alert("Ocorreu um erro ao efetuar o pagamento.");
						}
					},
					error: function(e) {
						alert("Ocorreu um erro ao efetuar o pagamento.");
					},
					complete: function() {
						$('#btnBoleto').removeClass('disabled');
					}
				});
			});

		</script>

		<script>
			$(document).ready(function(){
				$('#form-checkout__cardNumber').mask('0000 0000 0000 0000');
				$('#form-checkout__expirationDate').mask('00/00');
				$('#form-checkout__securityCode').mask('000');
			});
		</script>

	</body>
</html>