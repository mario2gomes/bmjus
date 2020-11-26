<?php 
    
    /*
     * Elemento que renderiza o inicializador do Plugin TokenInput com as configurações  padrão
     */
    $config_default['theme'] = 'facebook';
    $config_default['method'] = 'POST';
    $config_default['queryParam'] = 'texto';
    $config_default['hintText'] = 'Digite o nome de guerra do militar...';
    $config_default['noResultsText'] = 'Nenhum registro encontrado';
    $config_default['searchingText'] = 'Procurando...';
    $config_default['preventDuplicates'] = true;
    $config_default['tokenLimit'] = 'null';
    $config_default['prePopulate'] = null;
    $config_default['url'] = array("controller" => "usuarios", "action" => "busca", "plugin"=>false);
    //Faz o merge das configurações
    if(isset($config)){
        $config_default = array_merge($config_default, $config);
    }
        
?>

$("#<?php echo $id; ?>").tokenInput("<?php echo $this->Html->url($config_default['url']);?>", 
    {
        theme: "<?php echo $config_default['theme']; ?>",
        method: "<?php echo $config_default['method']; ?>",
        queryParam: "<?php echo $config_default['queryParam']; ?>",
        hintText: "<?php echo $config_default['hintText']; ?>",
        noResultsText: "<?php echo $config_default['noResultsText']; ?>",
        searchingText: "<?php echo $config_default['searchingText']; ?>",
        preventDuplicates: <?php echo $config_default['preventDuplicates']; ?>,
        tokenLimit: <?php echo $config_default['tokenLimit']; ?>,
        prePopulate: <?php if(!empty($config_default['prePopulate'])){echo $config_default['prePopulate'];}else{echo 'null';};?>
    }
);