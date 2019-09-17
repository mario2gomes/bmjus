    <div class="row">
        <script>
            $(document).ready(function() {
<? echo $this->element('js/token_input', array('id' => 'militar_id', 'config' => array('tokenLimit' => 1, 'url' => array('controller' => 'usuarios', 'action' => 'busca_nome', Configure::read('status_ativo'), 'plugin' => false)))); ?>
            });
        </script>
        <?php echo $this->Form->create('Usuario'); ?>    

        <div class="form-group">
            <?php echo $this->Form->input('mat_busca', array('label' => 'Buscar militar', 'id' => 'militar_id', 'numeric' => "true", 'type' => 'text', 'class' => 'form-control', 'div' => 'col-xs-6', 'maxlength' => 6)); ?>	
        </div>
        <div class="form-group">
            <hr>
            <?php
            echo $this->Ajax->submit('Buscar', array(
                'class' => 'btn btn-primary col-xs-2',
                'url' => array('controller' => 'usuarios', 'action' => 'buscar_usuario', 'plugin' => false),
                'update' => 'modal_edit_perfil_usuario_body',
                'before' => '$(this).unbind(); $(this).val("Buscando...");'
            ));
            ?>
        </div>
        <?php echo $this->Form->end(); ?>    

        <? if (isset($usuario) && !empty($usuario)): ?>
            <? if (!empty($usuario)): ?>
                <?php echo $this->Form->create('Usuario'); ?>                    
                <div class="form-group">
                    <?php echo $this->Form->hidden('mat_usuario', array('label' => 'Matrícula', 'type' => 'text', 'value' => $usuario['Usuario']['mat_usuario'])); ?>
					<?php echo $this->Form->hidden('cpf', array('label' => 'CPF', 'type' => 'text', 'value' => $usuario['Usuario']['cpf'])); ?>
                </div>
                <div class="form-group">
                    <hr>
                    <h3 class="text-navy"><?php echo $viewMilitar->getCargoNome($usuario['Usuario']['mat_usuario']); ?></h3>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('grupo_sgo', array('label' => 'Perfil', 'options' => $perfis, 'class' => 'form-control', 'div' => 'col-xs-6', 'value' => $usuario['Usuario']['grupo_sgo'])); ?>		
                </div>
                <hr>
                <div class="form-group">
                    <hr>
                    <?php
                    echo $this->Ajax->submit('Salvar', array(
                        'class' => 'btn btn-success col-xs-2',
                        'url' => array('controller' => 'usuarios', 'action' => 'edit_perfil', 'plugin' => false),
                        'update' => 'modal_edit_perfil_usuario_body',
                        'before' => '$(this).unbind(); $(this).val("Salvando...");'
                    ));
                    ?>
                </div>
                <?php echo $this->Form->end(); ?>    
            <? endif; ?>
        <? endif; ?>
    </div>
