<?php 
class Pessoa { 
    
    private $_idPessoa;
    private $_nome;
    private $_idSexo;
    private $_dataNascimento;
    
/*public function set_idPessoa($newId){
//    include("func/funcoespessoa.php");
    $this->_idPessoa = $newId; // função que retorna o próximo idPessoa da tabela tbpessoa
    }   
*/
public function get_idPessoa(){
	return $this->_idPessoa;
    }   

public function set_nome($nome){
	$this->_nome = $nome;
    }   

public function get_nome(){
	return $this->_nome;
    }   

public function set_idSexo($idSexo){
	$this->_idSexo = $idSexo;
    }   

public function get_idSexo(){
    return $this->_idSexo;
    }   

public function set_dataNascimento($dataNascimento){
	$this->_dataNascimento = $dataNascimento;
    }   

public function get_dataNascimento(){
    return $this->_dataNascimento;
    }   

public function mostraSexoIndex ($var) {
        include("cnn/cnn_pdo.php");
        //executa a instrução de consulta
        $result = $conn->query("SELECT * FROM tbsexo WHERE idSexo = $var");
         if($result)
        {//percorre os resultados via o laço foreach
            foreach($result as $linha){
            //exibe o resultado	
            return $linha['sexo'];}}}
    
//--------------------------- FUNÇÃO QUE INSERE PESSOAS NA TABELA TBPESSOA NO INDEX
public function set_pessoaIndex($newId,$nome,$idSexo,$dataNascimento,$idade)
{ 
    include("cnn/cnn_pdo.php");
    $sql = $conn->query("INSERT INTO tbpessoa VALUES ($newId,'$nome',$idSexo,'$dataNascimento',$idade)");
}   
//--------------------------- FIM DA FUNÇÃO QUE INSERE PESSOAS NA TABELA TBPESSOA NO INDEX

//--------------------------- FUNÇÃO QUE INSERE PESSOAS NA TABELA TBPESSOA PÁGINAS INTERNAS
public function set_pessoa($newId,$nome,$idSexo,$dataNascimento,$idade)
{ 
    include("../cnn/cnn_pdo.php");
    $sql = $conn->query("INSERT INTO tbpessoa VALUES ($newId,'$nome',$idSexo,'$dataNascimento',$idade)");
}   
//--------------------------- FIM DA FUNÇÃO QUE INSERE PESSOAS NA TABELA TBPESSOA PÁGINAS INTERNAS

//--------------------------- FUNÇÃO QUE RESGATA PESSOAS DA TABELA TB PESSOA NO INDEX
public function get_pessoas($id)
{ 
    include("cnn/cnn_pdo.php");
    $sql = $conn->query("SELECT * FROM tbpessoa WHERE idPessoa = $id");
    if($sql){          
        foreach($sql as $intanciaPessoa){
            echo $this->_idPessoa       = $intanciaPessoa['idPessoa'];
            echo " | ".$this->_nome           = $intanciaPessoa['nome'];
                       $this->_idSexo         = mostraSexoIndex($intanciaPessoa['idSexo']);
            echo " | ".$this->_idSexo;
            echo " | ".$this->_dataNascimento = $intanciaPessoa['dataNascimento'];
            echo " | ".$this->_idade          = $intanciaPessoa['idade'];
            echo "<br>";
        }
    }
    
}
// FIM DA FUNÇÃO QUE RESGATA PESSOAS CADASTRADAS NA TABELA TBPESSOA

//--------------------------- FUNÇÃO QUE ALOCA NOVO ID NA TABELA PESSOA NO INDEX
public function set_idPessoaIndex() { 
    include("cnn/cnn_pdo.php");	
        $ultimoID = $conn->query("SELECT MAX(idPessoa) as Ultimo FROM tbpessoa"); 
        
       if($ultimoID)
           {
          //percorre os resultados via o laço foreach
          foreach($ultimoID as $UID){
        
         //calcula o valor para o próximo ID
          return $newId = $UID['Ultimo']+ 1;
            }
             }
    }// FIM DA FUNÇÃO QUE ALOCA NOVO ID NA TABELA PESSOA

//--------------------------- FUNÇÃO QUE ALOCA NOVO ID NA TABELA PESSOA PÁGINAS INTERNAS
public function set_idPessoa() { 
    include("../cnn/cnn_pdo.php");	
        $ultimoID = $conn->query("SELECT MAX(idPessoa) as Ultimo FROM tbpessoa"); 
        
       if($ultimoID)
           {
          //percorre os resultados via o laço foreach
          foreach($ultimoID as $UID){
        
         //calcula o valor para o próximo ID
           $newId = $UID['Ultimo']+ 1;
           return $this->_idPessoa = $newId;
            }
             }
    }// FIM DA FUNÇÃO QUE ALOCA NOVO ID NA TABELA PESSOA

//--------------------------- FUNÇÃO QUE CALCULA IDADE
public function get_idade($dataNascimento){
       
     //Data atual
        $dia = date('d');
        $mes = date('m');
        $ano = date('Y');
        
    //Data do aniversário
        /*$nascimento = explode('/', $dataNascimento);
        $dianasc = ($nascimento[0]);
        $mesnasc = ($nascimento[1]);
        $anonasc = ($nascimento[2]);
    */
        // se for formato do banco, use esse código em vez do de cima!
        
        $nascimento = explode('-', $dataNascimento);
        $dianasc = ($nascimento[2]);
        $mesnasc = ($nascimento[1]);
        $anonasc = ($nascimento[0]);
         
    
       //Calculando sua idade
        $idade = $ano - $anonasc; // simples, ano- nascimento!
        if ($mes < $mesnasc) // se o mes é menor, só subtrair da idade
        {
            $idade--;
            return $idade;
        }
        elseif ($mes == $mesnasc && $dia < $dianasc) // se esta no mes do aniversario mas não passou ou chegou a data, subtrai da idade
        {
            $idade--;
            return $idade;
        }
        else // ja fez aniversario no ano, tudo certo!
        {
            return $idade;
        }
    } // FIM DA FUNÇÃO QUE CALCULA IDADE

//--------------------------- FUNÇÃO QUE ALTERA PESSOA NA TABELA TBPESSOA PÁGINAS INTERNAS
 public function update_pessoa($idPessoa, $nome, $idSexo, $dataNascimento, $idade){
    include("../cnn/cnn_pdo.php");
       
    $sql = $conn->query("UPDATE tbpessoa SET nome='$nome', idSexo=$idSexo, dataNascimento='$dataNascimento', idade=$idade WHERE idPessoa=$idPessoa");
}   
//--------------------------- FIM DA FUNÇÃO QUE ALTERA PESSOA NA TABELA TBPESSOA PÁGINAS INTERNAS


//--------------------------- FUNÇÃO QUE REMOVE PESSOA NA TABELA TBPESSOA PÁGINAS INTERNAS
   public function remove_pessoa($idPessoa) {
    // logica para remover cliente do banco
    include("../cnn/cnn_pdo.php");
    $sql = $conn->query("DELETE FROM tbpessoa WHERE idPessoa = $idPessoa");
    }
//--------------------------- FIM DA FUNÇÃO QUE REMOVE PESSOA NA TABELA TBPESSOA PÁGINAS INTERNAS
   
   
//--------------------------- FUNÇÃO QUE LISTA PESSOAS NA TABELA TBPESSOAS PÁGINAS INTERNAS
public function listAll_pessoas() {
    // logica para listar todos os clientes do banco
    include("../cnn/cnn_pdo.php");
    $sql = $conn->query("SELECT * FROM tbpessoa");   
    return $sql;
}
//--------------------------- FIM DA FUNÇÃO QUE LISTA PESSOAS NA TABELA TBPESSOA PÁGINAS INTERNAS




    } // fim da classe Pessoa   