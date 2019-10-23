<script>
       $(document).ready(function(){
            var url = '<?php echo $url; ?>';
            $('#<?php echo $target_div; ?>').html('<p><i class="icon-refresh"></i> Atualizando...</p>');               
            $.get(url, function(data){                    
                    $('#<?php echo $target_div; ?>').html(data);               
                }
            );
       });
</script>