<?php 
class Atendimento { 
const VALOR_HORA=70.00;
private $_idAtendimento;
private $_dataAtendimento;
private $_horaInicialAtendimento;
private $_horaFinalAtendimento;
private $_tempoAtendimentoDiario;
private $_tempoAtendimentoProf;
private $_tempoAtendimentoMesQqr;
private $_tempoAtendimentoMesQqrPersonalizado;
private $_valorHoraAtendimento;
private $_valorDiaAtendimento;
private $_valorTotalAtendimento;
private $_valorMesQqrAtendimento;
private $_valorMesQqrAtendimentoPersonalizado;


//--------------------------- FUNÇÃO QUE ALOCA NOVO ID NA TABELA TBATENDIMENTO PÁGINAS INTERNAS
public function set_idAtendimento() { 
    include("../cnn/cnn_pdo.php");	
        $ultimoID = $conn->query("SELECT MAX(idAtendimento) as Ultimo FROM tbatendimento"); 
        
       if($ultimoID)
           {
          //percorre os resultados via o laço foreach
          foreach($ultimoID as $UID){
        
         //calcula o valor para o próximo ID
           $newId = $UID['Ultimo']+ 1;
           return $this->_idAtendimento = $newId;
            }
             }
    }// FIM DA FUNÇÃO QUE ALOCA NOVO ID NA TABELA TBATENDIMENTO
public function get_idAtendimento() {
        return $this->_idAtendimento;
    }


public function set_dataAtendimento($dataAtendimento) {
    $this->_dataAtendimento = $dataAtendimento;
    }
public function get_dataAtendimento() {
    return $this->_dataAtendimento;
    }


public function set_valorHoraAtendimento($vh){
    $this->_valorHoraAtendimento = $vh;
    }   
public function get_valorHoraAtendimento(){
    return $this->_valorHoraAtendimento;
    }


public function set_horaInicialAtendimento($horaIni){
    $this->_horaInicialAtendimento = $horaIni;
    }   
public function get_horaInicialAtendimento(){
    return $this->_horaInicialAtendimento;
    }
    

public function set_horaFinalAtendimento($horaFim){
    $this->_horaFinalAtendimento = $horaFim;
    }   
public function get_horaFinalAtendimento(){
    return $this->_horaFinalAtendimento;
    }


public function set_valorDiaAtendimento($horaInicioAtend, $horaFimAtend, $valorHoraAtend){
        $horaIni = explode(":",$horaInicioAtend);
        $horaFim = explode(":",$horaFimAtend);
        $hora1segundos = ($horaIni[0] * 3600) + ($horaIni[1] * 60) + $horaIni[2];
        $hora2segundos = ($horaFim[0] * 3600) + ($horaFim[1] * 60) + $horaFim[2];
        $resultado = $hora2segundos - $hora1segundos;
        $tempoAtendimento = ($resultado/3600);
        $valorDiaAtendimento = $tempoAtendimento * $valorHoraAtend;
        $this->_valorDiaAtendimento = $valorDiaAtendimento;
    }
public function get_valorDiaAtendimento(){
        return $this->_valorDiaAtendimento;
        }
    

public function set_tempoAtendimentoDiario($horaInicioAtend, $horaFimAtend){
        $horaIni = explode(":",$horaInicioAtend);
        $horaFim = explode(":",$horaFimAtend);
        $hora1segundos = ($horaIni[0] * 3600) + ($horaIni[1] * 60) + $horaIni[2];
        $hora2segundos = ($horaFim[0] * 3600) + ($horaFim[1] * 60) + $horaFim[2];
        $resultado = $hora2segundos - $hora1segundos;
        $totalHoras = floor($resultado / 3600);
        $resultado = $resultado - ($totalHoras * 3600);
        $min_ponto = floor($resultado / 60);
        $resultado = $resultado - ($min_ponto * 60);
        $secs_ponto = $resultado;
        //Grava na variável resultado final
        $tempo = str_pad($totalHoras, 2, '0', STR_PAD_LEFT).":".str_pad($min_ponto, 2  , '0', STR_PAD_LEFT).":00";
        $this->_tempoAtendimentoDiario = $tempo;
}       
public function get_tempoAtendimentoDiario(){
    return $this->_tempoAtendimentoDiario;
    }

//-------------------------FUNÇÃO PARA CALCULAR TEMPO DE ATENDIMENTO TOTAL DE UM PACIENTE POR PROFISSIONAL 
public function set_tempoAtendimentoProf($idPaciente,$idProfAtendimento){
        include("../cnn/cnn_pdo.php");
        $soma=0;
        $sql = $conn->query("SELECT tempoAtendimentoDiario FROM tbatendimento WHERE ((idPaciente=$idPaciente) AND (idProfAtendimento=$idProfAtendimento))");
        if ($sql) {
            foreach ($sql as $linha) {
                $hora = explode(":", $linha['tempoAtendimentoDiario']);
                $horaseg = ($hora[0] * 3600) + ($hora[1] * 60) + $hora[2];
                $soma = $soma + $horaseg;
            }
        }
        $horas = floor($soma / 3600);
        $soma = $soma - ($horas * 3600);
        $min = floor($soma / 60);
        $soma = $soma - ($min * 60);
        $secs = $soma;
        //Grava na variável resultado final
        //$tempo = str_pad($horas, 2, '0', STR_PAD_LEFT).":".str_pad($min, 2  , '0', STR_PAD_LEFT);
        $tempo = $horas." <b>hs</b> e ".$min." <b>mins</b>";
        $this->_tempoAtendimentoProf = $tempo;
    }
public function get_tempoAtendimentoProf(){
    return $this->_tempoAtendimentoProf;
    }

//-------------------FUNÇÃO PARA MOSTRAR O TEMPO ACUMULADO EM UM DETERMINADO MES QQR
public function set_tempoAtendimentoMesQqr($inicioMes,$fimMes){
    include("../cnn/cnn_pdo.php");
    $soma=0;
    $sql = $conn->query("SELECT tempoAtendimentoDiario FROM tbatendimento WHERE (dataAtendimento BETWEEN '$inicioMes' and '$fimMes') ");
    if ($sql) {
        foreach ($sql as $linha) {
            $hora = explode(":", $linha['tempoAtendimentoDiario']);
            $horaseg = ($hora[0] * 3600) + ($hora[1] * 60) + $hora[2];
            $soma = $soma + $horaseg;
        }
    }
    $horas = floor($soma / 3600);
    $soma = $soma - ($horas * 3600);
    $min = floor($soma / 60);
    $soma = $soma - ($min * 60);
    $secs = $soma;
    //Grava na variável resultado final
    $tempo = str_pad($horas, 2, '0', STR_PAD_LEFT).":".str_pad($min, 2  , '0', STR_PAD_LEFT).":00";
    
    $this->_tempoAtendimentoMesQqr = $tempo;
}
public function get_tempoAtendimentoMesQqr(){
return $this->_tempoAtendimentoMesQqr;
}


//-------------------FUNÇÃO PARA MOSTRAR O TEMPO ACUMULADO EM UM DETERMINADO MES QQR, PAC QQR E PROF QQR
public function set_tempoAtendimentoMesQqrPersonalizado($idPaciente,$idProfAtendimento,$inicioMes,$fimMes){
    include("../cnn/cnn_pdo.php");
    $soma=0;
    $sql = $conn->query("SELECT tempoAtendimentoDiario FROM tbatendimento WHERE ((idPaciente=$idPaciente) AND (idProfAtendimento=$idProfAtendimento) AND(dataAtendimento BETWEEN '$inicioMes' and '$fimMes'))");
    if ($sql) {
        foreach ($sql as $linha) {
            $hora = explode(":", $linha['tempoAtendimentoDiario']);
            $horaseg = ($hora[0] * 3600) + ($hora[1] * 60) + $hora[2];
            $soma = $soma + $horaseg;
        }
    }
    $horas = floor($soma / 3600);
    $soma = $soma - ($horas * 3600);
    $min = floor($soma / 60);
    $soma = $soma - ($min * 60);
    $secs = $soma;
    //Grava na variável resultado final
    $tempo = str_pad($horas, 2, '0', STR_PAD_LEFT).":".str_pad($min, 2  , '0', STR_PAD_LEFT).":00";
    
    $this->_tempoAtendimentoMesQqrPersonalizado = $tempo;
}
public function get_tempoAtendimentoMesQqrPersonalizado(){
    return $this->_tempoAtendimentoMesQqrPersonalizado;
    }

    
//-------------------------FUNÇÃO PARA CALCULAR O VALOR ACUMULADO (TOTAL) DE ATENDIMENTOS DE UM PACIENTE POR PROFISSIONAL 
public function set_valorTotalAtendimento($idPaciente,$idProfAtendimento){
    include("../cnn/cnn_pdo.php");
    $soma=0;
    $sql = $conn->query("SELECT SUM(valorDiaAtendimento) AS valorTotalAtendimento FROM tbatendimento WHERE ((idPaciente=$idPaciente) AND (idProfAtendimento=$idProfAtendimento))");
    if ($sql) {
        foreach ($sql as $linha) {
            $valor = $linha['valorTotalAtendimento'];
         }
      }
    $this->_valorTotalAtendimento = $valor;
   }
public function get_valorTotalAtendimento(){
    return $this->_valorTotalAtendimento;
    }

//---------------------------- FUNÇÃO CONSULTA VALORES ACUMULADOS DE UM MES QUALQUER
public function set_valorMesQqrAtendimento($inicioMes,$fimMes){
    include("../cnn/cnn_pdo.php");
    $soma=0;
    $sql = $conn->query("SELECT SUM(valorDiaAtendimento) AS valorMesAtendimento FROM tbatendimento WHERE (dataAtendimento BETWEEN '$inicioMes' and '$fimMes')");
    if ($sql) {
        foreach ($sql as $linha) {
            $valor = $linha['valorMesAtendimento'];
         }
      }
    $this->_valorMesQqrAtendimento = $valor;
   }
public function get_valorMesQqrAtendimento(){
    return $this->_valorMesQqrAtendimento;
    }   
     
//---------------------------- FUNÇÃO CONSULTA VALORES ACUMULADOS DE UM MES QUALQUER, PAC QQR, PROF QQR
public function set_valorMesQqrAtendimentoPersonalizado($idPaciente, $idProfAtendimento, $inicioMes,$fimMes){
    include("../cnn/cnn_pdo.php");
    $soma=0;
    $sql = $conn->query("SELECT SUM(valorDiaAtendimento) AS valorMesAtendimento FROM tbatendimento WHERE ((idPaciente=$idPaciente) AND (idProfAtendimento=$idProfAtendimento) AND(dataAtendimento BETWEEN '$inicioMes' and '$fimMes'))");
    if ($sql) {
        foreach ($sql as $linha) {
            $valor = $linha['valorMesAtendimento'];
         }
      }
    $this->_valorMesQqrAtendimentoPersonalizado = $valor;
   }
public function get_valorMesQqrAtendimentoPersonalizado(){
    return $this->_valorMesQqrAtendimentoPersonalizado;
    }   

     

//--------------------------- FUNÇÃO QUE INSERE ATENDIMENTO NA TABELA TBATENDIMENTO PÁGINAS INTERNAS
public function set_atendimento($idAtendimento, $idPaciente, $idProfAtendimento, $dataAtendimento,
 $horaInicialAtendimento, $horaFinalAtendimento, $tempoAtendimentoDiario, $tempoAtendimentoMes, 
 $valorHoraAtendimento, $valorDiaAtendimento, $valorMesAtendimento, $idProfSup)
{ 
    include("../cnn/cnn_pdo.php");
    $sql = $conn->query("INSERT INTO tbatendimento VALUES ($idAtendimento, $idPaciente, 
    $idProfAtendimento, '$dataAtendimento', '$horaInicialAtendimento', '$horaFinalAtendimento', 
    '$tempoAtendimentoDiario', '$tempoAtendimentoMes', $valorHoraAtendimento, $valorDiaAtendimento, 
    $valorMesAtendimento, $idProfSup)");
}   
//--------------------------- FIM DA FUNÇÃO QUE ATENDIMENTO NA TABELA TBATENDIMENTO PÁGINAS INTERNAS

//--------------------------- FUNÇÃO QUE RESGATA ATENDIMENTO DE UMA PESSOA DA TABELA TBATENDIMENTO NO INDEX
public function get_atendimentoIndex($idPaciente,$idProfAtendimento,$dataAtendimento){
    include("cnn/cnn_pdo.php");
    $sql = $conn->query("SELECT * FROM tbatendimento WHERE ((idPaciente = $idPaciente) and 
    (idProfAtendimento = $idProfAtendimento) and (dataAtendimento = $dataAtendimento))");
    return $sql;
}

//--------------------------- FUNÇÃO QUE RESGATA ATENDIMENTO DE UMA PESSOA DA TABELA TBATENDIMENTO PÁGINAS INTERNAS
public function get_atendimento($idPaciente,$idProfAtendimento,$dataAtendimento){
    include("cnn/cnn_pdo.php");
    $sql = $conn->query("SELECT * FROM tbatendimento WHERE ((idPaciente = $idPaciente) and 
    (idProfAtendimento = $idProfAtendimento) and (dataAtendimento = $dataAtendimento))");
    return $sql;
}


//--------------------------- FUNÇÃO QUE ALTERA ATENDIMENTO NA TABELA TBATENDIMENTO PÁGINAS INTERNAS
public function update_atendimento($idPaciente, $idProfAtendimento, $dataAtendimento,
$horaInicialAtendimento, $horaFinalAtendimento, $tempoAtendimentoDiario, $tempoAtendimentoMes, 
$valorHoraAtendimento, $valorDiaAtendimento, $valorMesAtendimento, $idProfSup){
    include("../cnn/cnn_pdo.php");
       
    $sql = $conn->query("UPDATE tbatendimento SET 
     idPaciente             = $idPaciente,                 
     idProfAtendimento      = $idProfAtendimento,          
     dataAtendimento        = '$dataAtendimento',           
     horaInicialAtendimento = '$horaInicialAtendimento',     
     horaFinalAtendimento   = '$horaFinalAtendimento',       
     tempoAtendimentoDiario = '$tempoAtendimentoDiario',     
     tempoAtendimentoMes    = '$tempoAtendimentoMes',        
     valorHoraAtendimento   = $valorHoraAtendimento,       
     valorDiaAtendimento    = $valorDiaAtendimento,        
     valorMesAtendimento    = $valorMesAtendimento,        
     idProfSup              = $idProfSup                 
     WHERE 
     idAtendimento=$idAtendimento");
}   
//--------------------------- FIM DA FUNÇÃO QUE ALTERA ATENDIMENTO NA TABELA TBATENDIMENTO PÁGINAS INTERNAS


//--------------------------- FUNÇÃO QUE REMOVE ATENDIMENTO NA TABELA TBATENDIMENTO PÁGINAS INTERNAS
   public function remove_atendimento($idAtendimento) {
    include("../cnn/cnn_pdo.php");
    $sql = $conn->query("DELETE FROM tbatendimentos WHERE idAtendimento = $idAtendimento");
    }
//--------------------------- FIM DA FUNÇÃO QUE REMOVE ATENDIMENTO NA TABELA TBATENDIMENTO PÁGINAS INTERNAS

   
//--------------------------- FUNÇÃO QUE LISTA ATENDIMENTO NA TABELA TBATENDIMENTO PÁGINAS INTERNAS
public function listAll_atendimento() {
    include("../cnn/cnn_pdo.php");
    $sql = $conn->query("SELECT * FROM tbatendimento ORDER BY dataAtendimento");   
    return $sql;
}
//--------------------------- FIM DA FUNÇÃO QUE LISTA ATENDIMENTO NA TABELA TBATENDIMENTO PÁGINAS INTERNAS
   

//--------------------------- FUNÇÃO QUE LISTA ATENDIMENTO NA TABELA TBATENDIMENTO INDEX
public function listAll_atendimento_index() {
    include("cnn/cnn_pdo.php");
    $sql = $conn->query("SELECT * FROM tbatendimento ORDER BY dataAtendimento");      
    return $sql;
}
//--------------------------- FIM DA FUNÇÃO QUE LISTA ATENDIMENTO NA TABELA TBATENDIMENTO INDEX

//--------------------------- FUNÇÃO QUE LISTA ATENDIMENTO PERSONALIZADO PG INTERNA
public function list_atendimento_personalizado($idPaciente, $idProfAtendimento,$inicioMes,$fimMes) {
    include("../cnn/cnn_pdo.php");
    $sql = $conn->query("SELECT * FROM tbatendimento WHERE ((idPaciente = $idPaciente) AND (idProfAtendimento = $idProfAtendimento)  AND (dataAtendimento BETWEEN '$inicioMes' and '$fimMes')) ORDER BY dataAtendimento");      
    return $sql;
}
//--------------------------- FIM DA FUNÇÃO QUE LISTA ATENDIMENTO NA TABELA TBATENDIMENTO INDEX

/**
 * FALTA FUNÇÃO PARA ATULIZAR VALOR ACUMULADO DOS ATENDIMENTOS TODA VEZ QUE LER A TABELA ATENDIMENTO
 * FALTA FUNÇÃO PARA ATULIZAR TEMPO DE ATENDIMENTO ACUMULADO DOS ATENDIMENTOS TODA VEZ QUE LER A TABELA ATENDIMENTO
 * FALTA FUNÇÃO PARA CALCULAR DATAS DE INICIO E FIM DE CADA MÊS
 */

} // fim da classe Atendimento