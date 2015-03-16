<?php defined('SYSPATH') or die('No direct script access.');

class Task_User_Create extends Minion_Task
{
    protected $_options = [
        'username' => '',
        'password' => '',
        'email'    => '',
    ];

    public function _execute(array $params)
    {
        $params['password_confirm'] = $params['password'];
        /** @var Model_User $user_model */
        $user_model = ORM::factory('User');
        /** @var ORM $user */
        $user = $user_model->create_user($params, ['username', 'password', 'email']);
        Minion_CLI::write($user->id ? 'User created with id: ' . $user->id : 'Failed creating user');
    }
}
