<?php

require __DIR__ . '/../PreConfig.php';

function example()
{
    $argument = array(
        'credentials' => array(
            'admin' => array(
                'read'  => true,
                'write' => true
            ),
            'reader' => array(
                'read' => true,
                'write' => false
            )
        ),
        'users' => array(
            'someImportantDude' => array(
                'username'      => 'him',
                'password'      => '...',
                'credentials'   => '{{ credentials.admin }}'
            )
        )
    );

    $configs = new \Namshi\PreConfig\PreConfig($argument);

    return $configs->get('users');
}

print_r(example());

/* The Output:
 [
    'someImportantDude' => [
        'username'      => 'him',
        'password'      => '...',
        'credentials'   => '{{ credentials.admin }}'
    ]
]
*/


function exampleMultiLevel()
{
    $argument = array(
        'credentials' => array(
            'admin' => array(
                'read'  => true,
                'write' => true
            ),
            'reader' => array(
                'read' => true,
                'write' => false
            )
        ),
        'users' => array(
            'someImportantDude' => array(
                'username'      => 'him',
                'password'      => '...',
                'credentials'   => '{{ credentials.admin }}'
            )
        )
    );

    $configs = new \Namshi\PreConfig\PreConfig($argument);

    return $configs->get('users.someImportantDude');
}

print_r(exampleMultiLevel());

/* The Output:
 [
    'username'      => 'him',
    'password'      => '...',
    'credentials'   => '{{ credentials.admin }}'
]

*/


function exampleWithParams()
{
    $argument = array(
        'hi' => 'Hello, :name'
    );

    $configs = new \Namshi\PreConfig\PreConfig($argument);

    return $configs->get('hi', array('name' => 'Ayham'));
}

print_r(exampleWithParams());

/* The Output:
 Hello, Ayham

*/

function exampleWithReference()
{
    $argument = array(
        'credentials' => array(
            'admin' => array(
                'read'  => true,
                'write' => true
            ),
            'reader' => array(
                'read' => true,
                'write' => false
            )
        ),
        'users' => array(
            'someImportantDude' => array(
                'username'      => 'him',
                'password'      => '...',
                'credentials'   => '{{ credentials.admin }}'
            )
        )
    );

    $configs = new \Namshi\PreConfig\PreConfig($argument);

    return $configs->get('users.someImportantDude.credentials');
}

print_r(exampleWithReference());
/* The Output:
[
    'read'  => true,
    'write' => true
]
*/