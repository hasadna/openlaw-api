<?php

class Model_Knesset_New_Primary extends ORM
{
    protected $_table_name = 'knesset_new_primary';

    protected $_has_many = [
        'knesset_new_secondary' => [
            'model' => 'Knesset_New_Secondary',
            'through' => 'knesset_new_amendments',
        ],
        'amended_by' => [
            'model' => 'Knesset_New_Amendment',
            'foreign_key' => 'knesset_new_primary_id',
        ],
    ];

    protected $_has_one = [
        'wiki_page' => [
            'model' => 'Wiki_Page',
            'foreign_key' => 'knesset_new_primary_id',
        ],
    ];
}
