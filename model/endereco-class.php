<?php
class Endereco
{
    private $_idEndereco;
    private $_logradouro;
    private $_numero;
    private $_complemento;
    private $_bairro;
    private $_cidade;
    private $_idEstado;
    private $_cep;
    private $_fone;
    private $_celular;
    private $_whatsapp;
    private $_email;

    //--------------------------- FUNÇÃO QUE ALOCA NOVO ID NA TABELA TBENDERECO PÁGINAS INTERNAS
    public function set_idEndereco()
    {
        include("../cnn/cnn_pdo.php");
        $ultimoID = $conn->query("SELECT MAX(idEndereco) as Ultimo FROM tbendereco");
        if ($ultimoID) {
            foreach ($ultimoID as $UID) {
                $newId = $UID['Ultimo']+ 1;
                return $this->_idEndereco = $newId;
            }
        }
    }
    // FIM DA FUNÇÃO QUE ALOCA NOVO ID NA TABELA TBDOCUMENTOS

    public function get_idEndereco()
    {
        return $this->_idEndereco;
    }
    
    public function set_logradouro($logradouro)
    {
        $this->_logradouro = $logradouro;
    }

    public function get_logradouro()
    {
        return $this->_logradouro;
    }

    public function set_numero($numero)
    {
        $this->_numero = $numero;
    }
    
    public function get_numero()
    {
        return $this->_numero;
    }
    
    public function get_complemento()
    {
        return $this->_complemento;
    }

    public function set_complemento($complemento)
    {
        $this->_complemento = $complemento;
    }
    
    public function set_bairro($bairro)
    {
        $this->_bairro = $bairro;
    }

    public function get_bairro()
    {
        return $this->_bairro;
    }

    public function set_cidade($cidade)
    {
        $this->_cidade = $cidade;
    }

    public function get_cidade()
    {
        return $this->_cidade;
    }
 
    public function set_idEstado($idEstado)
    {
        $this->_idEstado = $idEstado;
    }

    public function get_idEstado()
    {
        return $this->_idEstado;
    }

    public function set_cep($cep)
    {
        $this->_cep = $cep;
    }

    public function get_cep()
    {
        return $this->_cep;
    }

    public function set_fone($fone)
    {
        $this->_fone = $fone;
    }
    public function get_fone()
    {
        return $this->_fone;
    }
    public function set_celular($celular)
    {
        $this->_celular = $celular;
    }
    public function get_celular()
    {
        return $this->_celular;
    }
    public function set_whatsapp($whatsapp)
    {
        $this->_whatsapp = $whatsapp;
    }
    public function get_whatsapp()
    {
        return $this->_whatsapp;
    }
    public function set_email($email)
    {
        $this->_email = $email;
    }
    public function get_email()
    {
        return $this->_email;
    }

    //--------------------------- FUNÇÃO QUE INSERE ENDEREÇO NA TABELA TBENDERECO PÁGINAS INTERNAS
    public function set_endereco($idEndereco, $idPessoa, $logradouro, $numero, $complemento, $bairro, $cidade, $idEstado, $cep, $fone, $celular, $whatsapp, $email)
    {
        include("../cnn/cnn_pdo.php");
        $sql = $conn->query("INSERT INTO tbendereco VALUES ($idEndereco,$idPessoa,'$logradouro', '$numero','$complemento', '$bairro', '$cidade', $idEstado, '$cep', '$fone', '$celular', '$whatsapp', '$email')");
    }
    //--------------------------- FIM DA FUNÇÃO QUE DOCUMENTOS NA TABELA TBDOCUMENTOSPÁGINAS INTERNAS
}