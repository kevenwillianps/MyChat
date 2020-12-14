<?php
/**
 * Created by MyCode
 * user: KEVEN
 * Date: 01/06/2020
 * Time: 13:20
 *
 */

/** Defino o local onde a classe esta localizada **/
namespace vendor\model;

class Host
{

    /** Pego a localização do banco de dados **/
    public function getDsn()
    {
        return $dsn = (string)"firebird:dbname=127.0.0.1:D:\Bases\CHAT.FDB";
    }

    /** Pego o usuário de acesso **/
    public function getUser()
    {
        return $user = (string)"SYSDBA";
    }

    /** Pego a senha de acesso **/
    public function getPassword()
    {
        return $password = (string)"302b3c";
    }

    /** Pego o charset de acesso **/
    public function getCharset()
    {
        return $charset = (string)"charset=utf8";
    }

}
