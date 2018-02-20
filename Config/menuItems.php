<?php

/**
* @return array With menu items
*/
return [
    'Main' => [
        'controller' => 'task',
        'action' => 'index'
    ],
    'Create' => [
        'controller' => 'task',
        'action' => 'add'
    ],
    'Register' => [
        'controller' => 'user',
        'action' => 'register'
    ],
    'Login' => [
        'controller' => 'user',
        'action' => 'login'
    ],
    'Logout' => [
        'controller' => 'user',
        'action' => 'logout'
    ]
];
