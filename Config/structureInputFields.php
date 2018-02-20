<?php

/**
* @return array With data about forms and their input fields
*/
return [
    'register' => [
    	[
            'name'  => 'user_login',
            'label' => 'Login',
            'type'  => 'text'
        ],
        [
            'name'  => 'user_pass',
            'label' => 'Password',
            'type'  => 'Password'
        ]
    ],
    'login' => [
        [
            'name'  => 'user_login',
            'label' => 'Login',
            'type'  => 'text'
        ],
        [
            'name'  => 'user_pass',
            'label' => 'Password',
            'type'  => 'Password'
        ]
    ],
    'taskAdd' => [
        [
            'name'  => 'user_name',
            'label' => 'Name',
            'type'  => 'text'
        ],
        [
            'name'  => 'user_email',
            'label' => 'Email',
            'type'  => 'text'
        ],
        [
            'name'  => 'todo_Text',
            'label' => 'Text',
            'type'  => 'textarea'
        ],
        [
            'name'  => 'todo_img',
            'label' => 'Image',
            'type'  => 'file'
        ]
    ]
];
