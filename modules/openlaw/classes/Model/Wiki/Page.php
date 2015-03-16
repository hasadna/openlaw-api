<?php defined('SYSPATH') or die('No direct script access.');

class Model_Wiki_Page extends ORM
{
    protected $_belongs_to = [
        'knesset_new_primary' => [
            'model' => 'Knesset_New_Primary',
        ],
    ];
}
