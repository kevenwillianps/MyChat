<?php

/** Defino o local da classe */
namespace vendor\model;

class Usuario
{

    /** Variaveis da classe */
    private $connection = null;
    private $sql = null;
    private $stmt = null;

    private $usuario_id = null;
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
        $this->sql = 'SELECT * FROM USUARIO';

        /** Preparo o SQL para exceução */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Execução do SQL */
        $this->stmt->execute();

        /** Retorno do resultado */
        return $this->stmt->fetchAll(\PDO::FETCH_OBJ);

    }

    /** Método para salvar um registro */
    public function save($usuario_id, $name, $email, $password)
    {

        /** Parâmetros de entrada */
        $this->usuario_id = $usuario_id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;

        /** Verifico se é cadastro ou atualização */
        if ($this->usuario_id == 0)
        {

            /** SQL para inserção */
            $this->sql = 'INSERT INTO USUARIO(USUARIO_ID, NAME, EMAIL, PASSWORD) VALUES((SELECT GEN_ID(USUARIO_GEN_ID,1) AS ID FROM RDB$DATABASE), :name, :email, :password)';

        }
        else{

            /** SQL para atualização */
            $this->sql = 'UPDATE USUARIO SET NAME = :name, EMAIL = :email, PASSWORD = :password WHERE USUARIO_ID = :usuario_id';

        }

        /** Preparo o SQL para exceução */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os valores do sql */
        $this->stmt->bindParam(':usuario_id', $this->usuario_id);
        $this->stmt->bindParam(':name', $this->name);
        $this->stmt->bindParam(':email', $this->email);
        $this->stmt->bindParam(':password', $this->password);

        /** Execução do SQL */
        return $this->stmt->execute();

    }

    public function delete($usuario_id)
    {

        /** Parâmetros de entrada */
        $this->usuario_id = $usuario_id;

        /** SQL de exclusão */
        $this->sql = 'DELETE FROM USUARIO WHERE USUARIO_ID = :usuario_id';

        /** Preparo o sql */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetro do sql */
        $this->stmt->bindParam(':usuario_id', $this->usuario_id);

        /** Retorno a execução */
        return $this->stmt->execute();

    }

    public function get($usuario_id)
    {

        /** Parâmetros de entrada */
        $this->usuario_id = $usuario_id;

        /** SQL de busca */
        $this->sql = 'SELECT * FROM USUARIO WHERE USUARIO_ID = :usuario_id';

        /** Preparo o sql */
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetro do sql */
        $this->stmt->bindParam(':usuario_id', $this->usuario_id);

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
        $this->sql = 'SELECT FIRST 1 * FROM USUARIO WHERE EMAIL = :email AND PASSWORD = :password';

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
