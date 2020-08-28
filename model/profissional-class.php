<?php 
include("pessoa-class.php");
class Profissional extends Pessoa { 
    
    private $_idProfissional;
    private $_idTpProfissional;
    private $_regProfissional;

//--------------------------- FUNÇÃO QUE ALOCA NOVO ID NA TABELA tbprofissionais PÁGINAS INTERNAS
public function set_idProfissional() { 
    include("../cnn/cnn_pdo.php");	
        $ultimoID = $conn->query("SELECT MAX(idProfissional) as Ultimo FROM tbprofissionais"); 
        
       if($ultimoID)
           {
          //percorre os resultados via o laço foreach
          foreach($ultimoID as $UID){
        
         //calcula o valor para o próximo ID
           $newId = $UID['Ultimo']+ 1;
           return $this->_idProfissional = $newId;
            }
             }
    }// FIM DA FUNÇÃO QUE ALOCA NOVO ID NA TABELA PACIENTE


public function get_idProfissional(){
	return $this->_idProfissional;
    }   

public function set_idTpProfissional($idTpProfissional){
        $this->_idTpProfissional = $idTpProfissional;
        }   
    
public function get_idTpProfissional(){
    return $this->_idTpProfissional;
    }   

public function set_regProfissional($regProfissional){
    $this->_regProfissional = $regProfissional;
    }   

public function get_regProfissional(){
    return $this->_regProfissional;
    }   
            
    //--------------------------- FUNÇÃO QUE INSERE PROFISSIONAIS NA TABELA TBPROFISSIONAIS PÁGINAS INTERNAS
public function set_profissional($idProfissional,$idPessoa,$idTpProfissional,$regProfissional){
    include("../cnn/cnn_pdo.php");
    $sql = $conn->query("INSERT INTO tbprofissionais VALUES ($idProfissional,$idPessoa,$idTpProfissional,'$regProfissional')");
}   
//--------------------------- FIM DA FUNÇÃO QUE INSERE PROFISSIONAIS NA TABELA TBPROFISSIONAIS PÁGINAS INTERNAS


//--------------------------- FUNÇÃO QUE ALTERA PROFISSIONAL NA TABELA TBPROFISSIONAIS PÁGINAS INTERNAS
public function update_profissional($idProfissional,$idPessoa, $idTpProfissional, $regProfissional){
    include("../cnn/cnn_pdo.php");
       
    $sql = $conn->query("UPDATE tbprofissionais SET idPessoa=$idPessoa, idTpProfissional=$idTpProfissional, regProfissional='$regProfissional' WHERE idProfissional=$idProfissional");
}   
//--------------------------- FIM DA FUNÇÃO QUE ALTERA PROFISSIONAL NA TABELA TBPROFISSIONAIS PÁGINAS INTERNAS


//--------------------------- FUNÇÃO QUE REMOVE PROFISSIONAL NA TABELA TBPROFISSIONAIS PÁGINAS INTERNAS
   public function remove_profissional($idProfissional) {
    // logica para remover cliente do banco
    include("../cnn/cnn_pdo.php");
    $sql_a = $conn->query("DELETE FROM tbatendimentos WHERE idProfissional = $idProfissional");
    $sql_b = $conn->query("SELECT * FROM tbprofissionais WHERE idProfissional = $idProfissional");
    if($sql_b){ foreach ($sql_b as $ln){ $idPessoa = $ln['idPessoa'];} }
    $sql_c = $conn->query("DELETE FROM tbpessoa WHERE idPessoa = $idPessoa");
    $sql_d = $conn->query("DELETE FROM tbprofissionais WHERE idProfissional = $idProfissional");
    
    }
//--------------------------- FIM DA FUNÇÃO QUE REMOVE PROFISSIONAL NA TABELA TBPROFISSIONAIS PÁGINAS INTERNAS
   
   
//--------------------------- FUNÇÃO QUE LISTA PROFISSIONAIS NA TABELA TBPROFISSIONAIS PÁGINAS INTERNAS
public function listAll_profissionais() {
    // logica para listar todos os clientes do banco
    include("../cnn/cnn_pdo.php");
    $sql = $conn->query("SELECT * FROM tbprofissionais");   
    return $sql;
}
//--------------------------- FIM DA FUNÇÃO QUE LISTA PROFISSIONAIS NA TABELA TBPROFISSIONAIS PÁGINAS INTERNAS


//--------------------------- FUNÇÃO QUE LISTA PROFISSIONAIS POR TIPOPROFISSIONAL INDEX
public function list_prof_por_tipo_index($idTpProfissional) {
    include("cnn/cnn_pdo.php");
    $sql = $conn->query("SELECT * FROM tbprofissionais WHERE idTpProfissional=$idTpProfissional");   
    return $sql;
}
//--------------------------- FIM DA FUNÇÃO QUE LISTA PROFISSIONAIS POR TIPOPROFISSIONAL

//--------------------------- FUNÇÃO QUE LISTA PROFISSIONAIS POR TIPOPROFISSIONAL 
public function list_prof_por_tipo($idTpProfissional) {
    include("../cnn/cnn_pdo.php");
    $sql = $conn->query("SELECT * FROM tbprofissionais WHERE idTpProfissional=$idTpProfissional");   
    return $sql;
}
//--------------------------- FIM DA FUNÇÃO QUE LISTA PROFISSIONAIS POR TIPOPROFISSIONAL


    } // fim da classe Profissional   