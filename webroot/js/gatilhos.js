$(document).ready(function(){

	//Faz os campos com o attr upper sendo true sejam colocados em Caixa Alta
	$('input[upper="true"]').focusout(function(){
		$(this).val($(this).val().toUpperCase());
	});
	
	//Faz os campos com o attr upper_keyup sendo true sejam colocados em Caixa Alta
	$('input[upper_keyup="true"]').keyup(function(){
		$(this).val($(this).val().toUpperCase());
	});
	
	$('textarea[upper="true"]').focusout(function(){
		$(this).val($(this).val().toUpperCase());
	});
	
	/* Função responsável por fazer o Ajax  de combobox
	 *sendo somente necessário setar os atributos url(controller/action), e o Id do elemento que receberá o retorno destinoid.
	 *onde o valor a ser passado para a função no controller será o próprio valor do combobox
	 */
	$('select[ajax="true"]').change(function(){

		var base = "/sistemas/docbm/";//base da aplicação
		var url = $(this).attr('url');//controller/action
		var destinoid = $(this).attr('destinoid');//id do elemento que receberá os dados
		var valor = $(this).val();//valor do combobox
		url = base+url+valor;// monta a url  final
		$('#'+destinoid).html('');//limpa a opção
		$('#'+destinoid).html('<option>Carregando...</option>');//exibe no destino 'Carregando...'
		
		$.get(url, function (data){
						$('#'+destinoid).html('');
						$('#'+destinoid).html(data);
						});
		
	});
	
	//Abre o modal quando se d´foco a um input com a marcação modal=true
	$('input[modal="true"]').focus(function(){
	
		var url = $(this).attr('url');
		var base = "/docbm/bmlog/";
		url = base+url;
		$(this).colorbox({speed:500, width:"70%", height:"70%", href:url});
	
	});
	
	//Toltip maior - bootstrap
	$("a[rel=popover]")
      .popover({placement:'left'})
      .click(function(e) {
        e.preventDefault()
	  });
	
	//Carrega conteúdo em modal
	$('a[modal_target]').unbind();
	$('a[modal_target]').click(function() {
		var url = $(this).attr('url');
		var modal_id = $(this).attr('modal_target');
		$('#' + modal_id).modal('show');
		$('#' + modal_id).children('.modal-body').html('Carregando...');
		$.get(url, function(data) {
			$('#' + modal_id).children('.modal-body').html(data);
		});
	});	
			
});
