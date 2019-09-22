<? echo $this->Form->create('Militar'); ?>
<? echo $this->Form->input('id', array('type' => 'hidden'));?>
<? echo $this->Form->input('situacao_id', array('type' => 'hidden'));?>
<? echo $this->Form->input('status_id', array('type' => 'hidden'));?>
<? echo $this->Form->input('funcao_id', array('type' => 'hidden'));?>
<? echo $this->Form->input('obm_id', array('type' => 'hidden'));?>
<? echo $this->Form->input('comportamento_id', array('type' => 'hidden'));?>
<div class="span5">
    <? echo $this->Form->input('num_matricula', array('id' => 'num_matricula', 'label' => 'Matrícula', 'class' => 'span2', 'numeric' => 'true', 'maxlength' => '6')); ?>
	<? echo $this->Form->input('cargo_id', array('label' => 'Cargo', 'options' => $cargos, 'empty' => '---', 'class' => 'span4')); ?>
    <? echo $this->Form->input('nom_completo', array('label' => 'Nome completo', 'class' => 'span11', 'upper' => 'true')); ?>
    <? echo $this->Form->input('nom_guerra', array('label' => 'Nome de guerra', 'class' => 'span8', 'upper' => 'true')); ?>
    <? echo $this->Form->input('cod_sexo', array('label' => 'Sexo', 'options' => array('F' => 'FEMININO', 'M' => 'MASCULINO'), 'empty' => '---', 'class' => 'span3')); ?>
    <? echo $this->Form->input('dat_nasc', array('label' => 'Data de nascimento', 'class' => 'span3', 'empty' => '---', 'dateFormat' => 'DMY', 'minYear' => date('Y') - 100, 'maxYear' => date('Y'))); ?>
    <? echo $this->Form->input('tip_sangue', array('label' => 'Tipo sanguíneo', 'options' => $tipo_sangue, 'empty' => '---')); ?>
    <? echo $this->Form->input('dsc_naturalidade', array('label' => 'Naturalidade', 'class' => 'span8', 'upper' => 'true')); ?>
    <? echo $this->Form->input('dsc_naturalidade_uf', array('label' => 'UF Naturalidade', 'options' => $ufs, 'empty' => '---')); ?>
    <? echo $this->Form->input('nom_pai', array('label' => 'Nome pai', 'class' => 'span11', 'upper' => 'true')); ?>
    <? echo $this->Form->input('nom_mae', array('label' => 'Nome mãe', 'class' => 'span11', 'upper' => 'true')); ?>
    <? echo $this->Form->input('estado_civil_id', array('label' => 'Estado civil', 'empty' => '---')); ?>
    <? echo $this->Form->input('nom_conjuge', array('label' => 'Nome cônjuge', 'class' => 'span11', 'upper' => 'true')); ?>
    <? echo $this->Form->input('religiao_id', array('label' => 'Religião', 'empty' => '---')); ?>
</div>
<div class="span5">
    <? echo $this->Form->input('dat_admissao', array('label' => 'Data de admissão', 'class' => 'span3', 'empty' => '---', 'dateFormat' => 'DMY', 'minYear' => date('Y') - 100, 'maxYear' => date('Y'))); ?>
    <? echo $this->Form->input('dat_reinclusao', array('label' => 'Data de reinclusão', 'class' => 'span3', 'empty' => '---', 'dateFormat' => 'DMY', 'minYear' => date('Y') - 100, 'maxYear' => date('Y'))); ?>
    <? echo $this->Form->input('num_doe', array('label' => 'Número DOE', 'class' => 'span6', 'numeric' => 'true')); ?>
    <? echo $this->Form->input('quadro_id', array('label' => 'Quadro', 'empty' => '---')); ?>
    <? echo $this->Form->input('pos_hierarquica', array('label' => 'Posição hierárquica', 'class' => 'span2', 'numeric' => 'true', 'upper' => 'true')); ?>
    <? echo $this->Form->input('escolaridade_id', array('label' => 'Escolaridade', 'empty' => '---')); ?>
    <? echo $this->Form->input('num_altura', array('label' => 'Altura (cm)', 'class' => 'span2', 'numeric' => 'true', 'upper' => 'true')); ?>
    <? echo $this->Form->input('dsc_sinal_part', array('label' => 'Sinal particular', 'class' => 'span8', 'upper' => 'true')); ?>
    <? echo $this->Form->input('cod_doador', array('label' => 'Doador', 'options' => array('S' => 'Sim', 'N' => 'Não'), 'empty' => '---')); ?>
    <? echo $this->Form->input('num_telefone', array('label' => 'Telefone 1', 'class' => 'span3', 'mask'=>'telefone', 'numeric' => 'true')); ?>
    <? echo $this->Form->input('num_telefone2', array('label' => 'Telefone 2', 'class' => 'span3', 'mask'=>'telefone', 'numeric' => 'true')); ?>
    <? echo $this->Form->input('email', array('label' => 'E-mail', 'class' => 'span8')); ?>
	<? echo $this->Form->input('comportamento_id', array('label' => 'Comportamento', 'empty' => '---')); ?>	
	<? echo $this->Form->input('num_ordem', array('label' => 'Número de Ordem', 'class' => 'span3', 'numeric' => 'true', 'maxlength' => 10)); ?>
	<? echo $this->Form->input('cor_id', array('label' => 'Cor', 'options' => $cor, 'empty' => '---')); ?>	
	</div>