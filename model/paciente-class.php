<?php 
include("pessoa-class.php");
class Paciente extends Pessoa { 
    
    private $_idPaciente;

//--------------------------- FUNÇÃO QUE ALOCA NOVO ID NA TABELA PACIENTE PÁGINAS INTERNAS
public function set_idPaciente() { 
    include("../cnn/cnn_pdo.php");	
        $ultimoID = $conn->query("SELECT MAX(idPaciente) as Ultimo FROM tbpacientes"); 
        
       if($ultimoID)
           {
          //percorre os resultados via o laço foreach
          foreach($ultimoID as $UID){
        
         //calcula o valor para o próximo ID
           $newId = $UID['Ultimo']+ 1;
           return $this->_idPaciente = $newId;
            }
             }
    }// FIM DA FUNÇÃO QUE ALOCA NOVO ID NA TABELA PACIENTE


public function get_idPaciente(){
	return $this->_idPaciente;
    }   

    //--------------------------- FUNÇÃO QUE INSERE PACIENTES NA TABELA TBPACIENTES PÁGINAS INTERNAS
public function set_paciente($idPaciente,$idPessoa){
    include("../cnn/cnn_pdo.php");
    $sql = $conn->query("INSERT INTO tbpacientes VALUES ($idPaciente,$idPessoa)");
}   
//--------------------------- FIM DA FUNÇÃO QUE INSERE PACIENTES NA TABELA TBPACIENTES PÁGINAS INTERNAS


//--------------------------- FUNÇÃO QUE ALTERA PACIENTE NA TABELA TBPACIENTES PÁGINAS INTERNAS
public function update_paciente($idPaciente, $idPessoa){
    include("../cnn/cnn_pdo.php");
       
    $sql = $conn->query("UPDATE tbpacientes SET idPessoa=$idPessoa WHERE idPaciente=$idPaciente");
}   
//--------------------------- FIM DA FUNÇÃO QUE ALTERA PACIENTE NA TABELA TBPACIENTES PÁGINAS INTERNAS


//--------------------------- FUNÇÃO QUE REMOVE PACIENTE NA TABELA TBPACIENTES PÁGINAS INTERNAS
   public function remove_paciente($idPaciente) {
    include("../cnn/cnn_pdo.php");
    $sql_a = $conn->query("DELETE FROM tbatendimentos WHERE idPaciente = $idPaciente");
    $sql_b = $conn->query("SELECT * FROM tbpacientes WHERE idPaciente = $idPaciente");
    if($sql_b){ foreach ($sql_b as $ln){ $idPessoa = $ln['idPessoa'];} }
    $sql_c = $conn->query("DELETE FROM tbpessoa WHERE idPessoa = $idPessoa");
    $sql = $conn->query("DELETE FROM tbpacientes WHERE idPaciente = $idPaciente");
    }
//--------------------------- FIM DA FUNÇÃO QUE REMOVE PACIENTE NA TABELA TBPACIENTES PÁGINAS INTERNAS

   
//--------------------------- FUNÇÃO QUE LISTA PACIENTES NA TABELA TBPACIENTES PÁGINAS INTERNAS
public function listAll_pacientes() {
    // logica para listar todos os clientes do banco
    include("../cnn/cnn_pdo.php");
    $sql = $conn->query("SELECT * FROM tbpacientes");   
    return $sql;
}
//--------------------------- FIM DA FUNÇÃO QUE LISTA PACIENTES NA TABELA TBPACIENTE PÁGINAS INTERNAS
   
//--------------------------- FUNÇÃO QUE LISTA PACIENTES NA TABELA TBPACIENTES INDEX
public function listAll_pacientes_index() {
    // logica para listar todos os clientes do banco
    include("cnn/cnn_pdo.php");
    $sql = $conn->query("SELECT * FROM tbpacientes");   
    return $sql;
}
//--------------------------- FIM DA FUNÇÃO QUE LISTA PACIENTES NA TABELA TBPACIENTE INDEX

    } // fim da classe Paciente   