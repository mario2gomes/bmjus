<?php

class PdfTools {
    
    protected $pdftools;
    
    /**
     * Construtor do ToolsPdf
     */
    public function __construct() {
    
        $this->pdftools = new Java('br.gov.al.cbm.pdf.ToolsPdf');
    }
    
    /**
     * Processa o arquivo Pdf e realiza a padronização de versão - v. 1.4
     * 
     * @param String $in Path do Arquivo de Estrada
     * @param String $out Path do Arquivo de Saída
     * 
     * @return boolean Resultado do Processamento
     * 
     */   
    public function process($in, $out){
        
       $result = $this->pdftools->process($in, $out);
       return $result;
    }  
    
    /**
     * Setter o criador do documento
     * @param String $creator
     */
    public function setPdfCreator($creator){
        
        $this->pdftools->setPdfCreator($creator);
    }
    /**
     * Setter o assundo do documento
     * @param String $subject
     */
    public function setPdfSubject($subject){
        
        $this->pdftools->setPdfSubject($subject);
    }
    /**
     * Setter o autor do documento
     * @param String $author
     */
    public function setPdfAuthor($author){
        
        $this->pdftools->setPdfAuthor($author);
    }
    
    /**
     * Calcula o total de páginas
     * 
     * @param string $in Path do Arquivo pdf
     * @return int Total de Páginas
     */
    public function getNumberPages($in){
        
        return $this->pdftools->getNumberPages($in);
    }
    
    /**
     * Divide o arquivo pdf conforme os parâmetros passados
     * 
     * Padrão dos arquivos gerados: nome original + o número de ordem da divisão
     * Ex: original-1.pdf
     * 
     * @param string $in Path do arquivo de estrada
     * @param string $out Path do diretório de destino
     * @param int $inter Intervalo de divisão do arquivo
     * @param int $start Página inicial
     * @param int $end Página final
     * 
     * @return int Número de arquivos gerados
     */
    public function split($in, $out, $inter, $start, $end){
        
        return $this->pdftools->split($in, $out, $inter,$start, $end);
    }
    
    /**
     * Setter
     * @param string | array $in Setter os arquivos para concatenar
     */
    public function setFileConcat($in){        
        
        if(is_array($in)){
            foreach ($in as $file){
                
                $this->pdftools->setFileConcat($file);
        
            }
        } else {
                $this->pdftools->setFileConcat($in);
        }       
        
    }
    
    /**
     * Concatena arquivos pdfs
     * 
     * É necessário informar os arquivos antes com a function setFileConcat()
     * @param string $out Nome do arquivo resultante da concatenação
     * @return boolean Resultado da concatenação
     */
    public function concat($out){
        
        return $this->pdftools->concat($out);
    }
    
    /**
     * Adiciona um código QRcode no arquivo Pdf com texto informado
     * Limitação: 
     * Numérica - máx. 7089 caracteres
     * Alfanumérica - máx. 4296 caracteres
     * Binário (8 bits) - máx. 2953 bytes
     * 
     * @param String $in Path do arquivo de entrada
     * @param String $out Path do arquivo de saída
     * @param String $text Texto codificado
     * @return boolean
     */
    public function addQRCode($in, $out, $text){
        
        return $this->pdftools->addQRCode($in, $out, $text);
    }
    
}
?>
