<?php
/**
 * CakePHP Clob Behaviour
 * Preparing and inserting the clob values in the database
 *
 * Authors: Bobby Borisov and Nedko Penev
 */

class BlobBehavior extends ModelBehavior
{
      var $model;
      var $time_end;
      var $time_start;
      var $saved = array(); // array to store clob values
      /*
      * Initialize method
      */
      function setup(&$Model)
      {
            $this->model = $Model;     
      }
     
        
      /*
      * Updates table with saved clob values
      */
      function save_blob(&$Model, $conteudo, $campo)
      {               
                $db =& ConnectionManager::getDataSource($this->model->useDbConfig);               

                $id = $this->model->id;

                $sql = "update ".$this->model->tablePrefix.$this->model->table." set ".$campo." = EMPTY_BLOB() where id = ".$id;
                $sql = $sql." RETURNING $campo INTO :$campo";// die($sql);

                $stmt_arquivo = ociparse($db->connection, $sql);
                $blob_aux = ocinewdescriptor($db->connection, OCI_D_LOB);
                ocibindbyname($stmt_arquivo, ":$campo", $blob_aux, -1, OCI_B_BLOB);
                ociexecute($stmt_arquivo, OCI_DEFAULT);
                $blob_aux->save($conteudo);
                OCICommit($db->connection);        
      }
}
?>