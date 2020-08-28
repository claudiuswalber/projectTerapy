<?php 
class Documentos { 
    private $_idDocumentos;
    private $_rg;
    private $_cpf;

    
//--------------------------- FUNÇÃO QUE ALOCA NOVO ID NA TABELA TBDOCUMENTOS PÁGINAS INTERNAS
public function set_idDocumentos() { 
    include("../cnn/cnn_pdo.php");	
        $ultimoID = $conn->query("SELECT MAX(idDocumentos) as Ultimo FROM tbdocumentos"); 
        
       if($ultimoID)
           {
          //percorre os resultados via o laço foreach
          foreach($ultimoID as $UID){
        
         //calcula o valor para o próximo ID
           $newId = $UID['Ultimo']+ 1;
           return $this->_idDocumentos = $newId;
            }
             }
    }// FIM DA FUNÇÃO QUE ALOCA NOVO ID NA TABELA TBDOCUMENTOS

    public function get_idDocumentos() {
        return $this->_idDocumentos;
        }

    public function set_rg($rg){
        $this->_rg = $rg;
        }   
    public function get_rg(){
        return $this->_rg;
        }
    
    public function set_cpf($cpf){
        $this->_cpf = $cpf;
        }   
    public function get_cpf(){
        return $this->_cpf;
        }
//--------------------------- FUNÇÃO QUE DOCUMENTOS NA TABELA TBDOCUMENTOS NO INDEX
public function set_documentosIndex($idDocumentos,$idPessoa,$rg,$cpf)
{ 
    include("cnn/cnn_pdo.php");
    $sql = $conn->query("INSERT INTO tbdocumentos VALUES ($idDocumentos,$idPessoa,'$rg','$cpf')");
}   
//--------------------------- FIM DA FUNÇÃO QUE DOCUMENTOS NA TABELA TBDOCUMENTOS NO INDEX

//--------------------------- FUNÇÃO QUE INSERE DOCUMENTOS NA TABELA TBDOCUMENTOS PÁGINAS INTERNAS
public function set_documentos($idDocumentos,$idPessoa,$rg,$cpf)
{ 
    include("../cnn/cnn_pdo.php");
    $sql = $conn->query("INSERT INTO tbdocumentos VALUES ($idDocumentos,$idPessoa,'$rg','$cpf')");
}   
//--------------------------- FIM DA FUNÇÃO QUE DOCUMENTOS NA TABELA TBDOCUMENTOSPÁGINAS INTERNAS

//--------------------------- FUNÇÃO QUE RESGATA DOCUMENTOS DE UMA PESSOA DA TABELA TBDOCUMENTOS NO INDEX
public function get_documentosIndex($idPessoa)
{ 
    include("cnn/cnn_pdo.php");
    $sql = $conn->query("SELECT * FROM tbdocumentos WHERE idPessoa = $idPessoa");
    if($sql){          
        foreach($sql as $intanciaDocumentos){
            echo $this->_idPessoa       = $intanciaDocumentos['idPessoa'];
            echo " | ".$this->_rg       = $intanciaDocumentos['rg'];
           // echo " | ".$this->_cpf      = $intanciaDocumentos['cpf']);
            echo "<br>";
        }
    }
    
}
// FIM DA FUNÇÃO QUE RESGATA DOCUMENTOS DE UMA PESSOA DA TABELA TBDOCUMENTOS NO INDEX

//--------------------------- FUNÇÃO QUE ALOCA NOVO ID NA TABELA TBDOCUMENTOS NO INDEX
function set_idDocumentosIndex() { 
    include("cnn/cnn_pdo.php");	
        $ultimoID = $conn->query("SELECT MAX(idDocumentos) as Ultimo FROM tbdocumentos"); 
        
       if($ultimoID)
           {
          //percorre os resultados via o laço foreach
          foreach($ultimoID as $UID){
        
         //calcula o valor para o próximo ID
          return $newId = $UID['Ultimo']+ 1;
            }
             }
    }// FIM DA FUNÇÃO QUE ALOCA NOVO ID NA TABELA TBDOCUMENTOS


    } // fim da classe Documentos