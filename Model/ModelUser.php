<?php

class ModelUser extends CoreModel
{
    protected $components = ['Validate'];
    
    public function selectPasswordByLogin($login)
    {
        $dataForEscape['login'] = $login;
        $escapedData = CoreDB::getInstance()->escapeData($dataForEscape);
        $selectQuery = "SELECT * FROM users where login = '" . $escapedData['login'] . "'";
        $resultSelect = CoreDB::getInstance()->selectFromDB($selectQuery);
        return $resultSelect;
    }

    public function insertUserIntoDB($values)
    {
        $escapedData = CoreDB::getInstance()->escapeData($values);
        $insertUserQuery = "INSERT INTO users (login, pass) 
                                VALUES ('" . $escapedData['user_login'] . "',
                                        '" . $escapedData['user_pass'] . "');";

        $resultInsert = CoreDB::getInstance()->insertToDB($insertUserQuery);
        return $resultInsert;
    }
}
