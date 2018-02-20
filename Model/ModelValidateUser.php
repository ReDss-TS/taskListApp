<?php

class ModelValidateUser extends CoreModel
{
    protected $components = ['Validate'];
    
    protected $validationRules = [
        'user_login' => [
            'notEmpty',
            'isValidLogin'
        ],
        'user_pass' => [
            'notEmpty',
            'isValidPass'
        ]
    ];

    public function isBusyLogin($login)
    {
        $ModelUser = new ModelUser;
        $selectedLogin = $ModelUser->selectPasswordByLogin($login);
        if (is_object($selectedLogin)) {
            return false;
        } else {
            return true;
        }
    }
}
