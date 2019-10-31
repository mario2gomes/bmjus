$(document).ready(function(){

$('input[mask="lat"]').mask("-99.999999");
$('input[mask="long"]').mask("-99.999999");
$('input[mask="cpf"]').mask("999.999.999-99");
$('input[mask="cnpj"]').mask("99999999999999");
$('input[mask="decimal"]').maskMoney({symbol:"",decimal:".",thousands:""});
$('input[mask="dec"]').mask("99.99");
$('input[mask="cep"]').mask("99999-999");
$('input[mask="pa"]').mask("99:99");
$('input[mask="tel"]').mask("(82)9999-9999");
$('input[mask="bgo"]').mask("999");
$('input[mask="data"]').mask("99-99-9999");
		
});
