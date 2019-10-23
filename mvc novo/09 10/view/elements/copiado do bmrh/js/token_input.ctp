<?php 
    
    /*
     * Elemento que renderiza o inicializador do Plugin TokenInput com as configurações  padrão
     */
    $config_default['theme'] = 'facebook';
    $config_default['method'] = 'POST';
    $config_default['queryParam'] = 'texto';
    $config_default['hintText'] = 'Digite parte do nome do militar...';
    $config_default['noResultsText'] = 'Nenhum registro encontrado';
    $config_default['searchingText'] = 'Procurando...';
    $config_default['preventDuplicates'] = true;
    $config_default['tokenLimit'] = 'null';
    $config_default['prePopulate'] = null;
    
    //Faz o merge das configurações
    if(isset($config)){
        $config_default = array_merge($config_default, $config);
    }
        
?>

$("#<?php echo $id; ?>").tokenInput("<?php echo $this->Html->url(array("controller" => "militares", "action" => "busca_nome"));?>", 
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