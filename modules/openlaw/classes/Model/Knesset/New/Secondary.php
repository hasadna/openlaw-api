<?php

class Model_Knesset_New_Secondary extends ORM
{
    protected $_table_name = 'knesset_new_secondary';

    protected $_has_many = [
        'knesset_new_primary' => [
            'model' => 'Knesset_New_Primary',
            'through' => 'knesset_new_amendments',
        ],
        'amends' => [
            'model' => 'Knesset_New_Amendment',
            'foreign_key' => 'knesset_new_secondary_id',
        ],
    ];

    public function rules()
    {
        return [
            'knesset_id' => [
                ['not_empty'],
                ['numeric'],
            ],
        ];
    }
}
