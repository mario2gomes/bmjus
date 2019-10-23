<div class="col-sm-6 b-r"><h3 class="m-t-none m-b">ENVIO DE DOCUMENTO AOS AUTOS DO PROCESSO</h3>

<?php $this->setCurrentStyle(4);?>
<?php
echo $this->Html->css(array('pickadate', 'fineuploader','jquery-ui'), null, array('inline' => false));
echo $this->Html->script(array('pickadate/picker', 'pickadate/picker.date', 
                                'pickadate/picker.time', 'pickadate/legacy', 
                                'jquery.fineuploader', 'jquery-ui'), array('inline' => false));
?>

<?php $this->Html->scriptStart(array('inline' => false)); ?>
$(document).ready(function(){
    $('#upload').fineUploader({
        request: {
            endpoint: "<?=$this->request->base?>/upload/boletim"
        },    
        text: {
            uploadButton: '<div class="upload-section"><span class="glyphicon glyphicon-file"></span> Clique para carregar o arquivo</div>'
        },
        validation: {
            allowedExtensions: ['pdf']
        },
        multiple: false
    }).on('complete', function(boletim, id, fileName, response) {
        $('#filename').val(response.filename);
    });
    
    $(".datepicker").pickadate({
        format: 'dd/mm/yyyy',
        onClose: function() {
            if ( $('#to').val() != '' && ($('#from').val() > $('#to').val()) )
            {
                mooAlert('<?=addslashes(__('To date must be greater than From date'))?>');
                $('#to').val('');
            }
        }
    });
    $(".numeric").keypress(function(e){
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
    return false;
    }
    });     
    
});

<?php $this->Html->scriptEnd(); ?>

<div class="create_form">
<div class="bar-content">
    <div class="content_center">
        <?php
        echo $this->Form->create("Boletim", array(
            'url' => array('controller' => 'processo', 'action' => 'upload')
            )
        );?>
        <div class="box3">  
            <div class="full_content p_m_10">
                <div class="form_content">
                    <ul class="list6 list6sm2">
                        <h1>Enviar Documento</h1>
                            <li>
                                <div class='col-md-2'>
                                <label>Tipo do documento</label>
                                </div>
                                <div class="col-md-10">
                                    <div class='col-xs-3'>
                                        <?php echo $this->Form->text('tipo_documento', array()); ?>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </li>
                            <li>
                                <div class="col-md-10">
                                    <div id="upload" style="margin: 10px 0 0 0px;"></div>
                                    <?php echo $this->Form->hidden('filename', array('id' => 'filename')); ?>
                                </div>
                                <div class="clear"></div>
                            </li>
                    </ul>
                    <?php echo $this->Form->submit('Enviar', array(
                        'class' => 'btn btn-success btn-login',
                        'value' => 'Enviar',
                            )
                    );?>
                </div>
            </div>
        </div>
        <?php echo $this->Form->end();?>        
    </div>
</div>
</div>