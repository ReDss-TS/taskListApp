<?php

class ModelValidateTask extends CoreModel
{
    protected $components = ['Validate'];
    
    protected $validationRules = [
        'user_name' => [
            'notEmpty',
            'isValidText'
        ],
        'user_email' => [
            'notEmpty',
            'isValidEmail'
        ],
        'todo_Text' => [
            'notEmpty',
            'isValidText'
        ],
        'todo_img' => [
            'isImgFile',
            'isError',
            'isValidSize'
        ]
    ];
}
