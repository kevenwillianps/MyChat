<?php

/** Defino o local da classe */
namespace vendor\model;

class Cliente
{

    /** Variaveis da classe */
    private $connection = null;
    private $sql = null;
    private $stmt = null;

    private $cliente_id = null;
    private $name = null;
    private $email = null;
    private $password = null;


    /** Construtor da classe */
    public function __construct()
    {

        /** Instânciamento da classe */
        $this->connection = new Firebird();

    }

    /** Listo todos os registros */
    public function all()
    {

        /** SQL de busca */
        $this->sql = 'SELECT * FROM CLIENTE';

        /** Preparo o SQL para exceução */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Execução do SQL */
        $this->stmt->execute();

        /** Retorno do resultado */
        return $this->stmt->fetchAll(\PDO::FETCH_OBJ);

    }

    /** Método para salvar um registro */
    public function save($cliente_id, $name, $email, $password)
    {

        /** Parâmetros de entrada */
        $this->cliente_id = $cliente_id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;

        /** Verifico se é cadastro ou atualização */
        if ($this->cliente_id == 0)
        {

            /** SQL para inserção */
            $this->sql = 'INSERT INTO CLIENTE(CLIENTE_ID, NAME, EMAIL, PASSWORD) VALUES((SELECT GEN_ID(CLIENTE_GEN_ID,1) AS ID FROM RDB$DATABASE), :name, :email, :password)';

        }
        else{

            /** SQL para atualização */
            $this->sql = 'UPDATE CLIENTE SET NAME = :name, EMAIL = :email, PASSWORD = :password WHERE CLIENTE_ID = :cliente_id';

        }

        /** Preparo o SQL para exceução */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os valores do sql */
        $this->stmt->bindParam(':cliente_id', $this->cliente_id);
        $this->stmt->bindParam(':name', $this->name);
        $this->stmt->bindParam(':email', $this->email);
        $this->stmt->bindParam(':password', $this->password);

        /** Execução do SQL */
        return $this->stmt->execute();

    }

    public function delete($cliente_id)
    {

        /** Parâmetros de entrada */
        $this->cliente_id = $cliente_id;

        /** SQL de exclusão */
        $this->sql = 'DELETE FROM CLIENTE WHERE CLIENTE_ID = :cliente_id';

        /** Preparo o sql */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetro do sql */
        $this->stmt->bindParam(':cliente_id', $this->cliente_id);

        /** Retorno a execução */
        return $this->stmt->execute();

    }

    public function get($cliente_id)
    {

        /** Parâmetros de entrada */
        $this->cliente_id = $cliente_id;

        /** SQL de busca */
        $this->sql = 'SELECT * FROM CLIENTE WHERE CLIENTE_ID = :cliente_id';

        /** Preparo o sql */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetro do sql */
        $this->stmt->bindParam(':cliente_id', $this->cliente_id);

        /** Retorno a execução */
        $this->stmt->execute();

        /** Retorno o resultado*/
        return $this->stmt->fetchObject();

    }

    /** Acesso de usuário */
    public function access($email, $password)
    {

        /** Parâmetros de entrada */
        $this->email = $email;
        $this->password = $password;

        /** Montagem do SQL */
        $this->sql = 'SELECT FIRST 1 * FROM CLIENTE WHERE EMAIL = :email AND PASSWORD = :password';

        /** Preparo o Sql para execução */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Adiciono os valores */
        $this->stmt->bindParam(':email', $this->email);
        $this->stmt->bindParam(':password', $this->password);

        /** Executo o SQL */
        $this->stmt->execute();

        /** Retorno o resultado */
        return $this->stmt->fetchObject();

    }

    /** Destrutor da classe */
    public function __destruct()
    {

        /** Instanciamento da classe */
        $this->connection = null;

    }


}