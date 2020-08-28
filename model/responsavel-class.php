<?php
include("pessoa-class.php");
class Responsavel extends Pessoa { 
    
    private $_idResponsavel;
    private $_idGrauParentesco;

//--------------------------- FUNÇÃO QUE ALOCA NOVO ID NA TABELA TBRESPONSAVEL PÁGINAS INTERNAS
public function set_idResponsavel() { 
    include("../cnn/cnn_pdo.php");	
        $ultimoID = $conn->query("SELECT MAX(idResponsavel) as Ultimo FROM tbresponsavel"); 
        
       if($ultimoID)
           {
          //percorre os resultados via o laço foreach
          foreach($ultimoID as $UID){
        
         //calcula o valor para o próximo ID
           $newId = $UID['Ultimo']+ 1;
           return $this->_idResponsavel = $newId;
            }
             }
    }// FIM DA FUNÇÃO QUE ALOCA NOVO ID NA TABELA RESPONSAVEL


public function get_idResponsavel(){
	return $this->_idResponsavel;
    }   


public function set_idGrauParentesco($idGrauParentesco) {
   $this->_idGrauParentesco = $idGrauParentesco;
    }

public function get_idGrauParentesco(){
        return $this->_idGrauParentesco;
    }


//--------------------------- FUNÇÃO QUE INSERE RESPONSAVEL NA TABELA TBRESPONSAVEL PÁGINAS INTERNAS
public function save_responsavel($idResponsavel,$idPaciente,$idGrauParentesco){
    include("../cnn/cnn_pdo.php");
    $sql = $conn->query("INSERT INTO tbresponsavel VALUES ($idResponsavel,$idPaciente,$idGrauParentesco)");
}   
//--------------------------- FIM DA FUNÇÃO QUE INSERE RESPONSAVEL NA TABELA TBRESPONSAVEL PÁGINAS INTERNAS


//--------------------------- FUNÇÃO QUE ALTERA RESPONSAVEL NA TABELA TBRESPONSAVEL PÁGINAS INTERNAS
    public function update_responsavel($idResponsavel,$idPaciente,$idGrauParentesco){
    include("../cnn/cnn_pdo.php");
    $sql = $conn->query("UPDATE tbresponsavel SET idPaciente=$idPaciente, idGrauParentesco=$idGrauParentesco WHERE idResponsavel = $idResponsavel");
}   
//--------------------------- FIM DA FUNÇÃO QUE ALTERA RESPONSAVEL NA TABELA TBRESPONSAVEL PÁGINAS INTERNAS


//--------------------------- FUNÇÃO QUE REMOVE RESPONSAVEL NA TABELA TBRESPONSAVEL PÁGINAS INTERNAS
   public function remove_responsavel($idResponsavel) {
    // logica para remover cliente do banco
    include("../cnn/cnn_pdo.php");
    $sql = $conn->query("DELETE FROM tbresponsavel WHERE idResponsavel = $idResponsavel");
    }
//--------------------------- FIM DA FUNÇÃO QUE REMOVE RESPONSAVEL NA TABELA TBRESPONSAVEL PÁGINAS INTERNAS
   

//--------------------------- FUNÇÃO QUE LISTA RESPONSAVEIS NA TABELA TBRESPONSAVEL PÁGINAS INTERNAS
    public function listAll_responsavel() {
    // logica para listar toodos os clientes do banco
    include("../cnn/cnn_pdo.php");
    $sql = $conn->query("SELECT * FROM tbresponsavel");
    return $sql;
    }
//--------------------------- FIM DA FUNÇÃO QUE LISTA RESPONSAVEIS NA TABELA TBRESPONSAVEL PÁGINAS INTERNAS

} // fim da classe Responsavel   