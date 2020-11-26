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
     * Processa o arquivo Pdf e realiza a padroniza��o de vers�o - v. 1.4
     * 
     * @param String $in Path do Arquivo de Estrada
     * @param String $out Path do Arquivo de Sa�da
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
     * Calcula o total de p�ginas
     * 
     * @param string $in Path do Arquivo pdf
     * @return int Total de P�ginas
     */
    public function getNumberPages($in){
        
        return $this->pdftools->getNumberPages($in);
    }
    
    /**
     * Divide o arquivo pdf conforme os par�metros passados
     * 
     * Padr�o dos arquivos gerados: nome original + o n�mero de ordem da divis�o
     * Ex: original-1.pdf
     * 
     * @param string $in Path do arquivo de estrada
     * @param string $out Path do diret�rio de destino
     * @param int $inter Intervalo de divis�o do arquivo
     * @param int $start P�gina inicial
     * @param int $end P�gina final
     * 
     * @return int N�mero de arquivos gerados
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
     * � necess�rio informar os arquivos antes com a function setFileConcat()
     * @param string $out Nome do arquivo resultante da concatena��o
     * @return boolean Resultado da concatena��o
     */
    public function concat($out){
        
        return $this->pdftools->concat($out);
    }
    
    /**
     * Adiciona um c�digo QRcode no arquivo Pdf com texto informado
     * Limita��o: 
     * Num�rica - m�x. 7089 caracteres
     * Alfanum�rica - m�x. 4296 caracteres
     * Bin�rio (8 bits) - m�x. 2953 bytes
     * 
     * @param String $in Path do arquivo de entrada
     * @param String $out Path do arquivo de sa�da
     * @param String $text Texto codificado
     * @return boolean
     */
    public function addQRCode($in, $out, $text){
        
        return $this->pdftools->addQRCode($in, $out, $text);
    }
    
}
?>
