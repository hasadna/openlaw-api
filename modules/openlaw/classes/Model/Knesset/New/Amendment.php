<?php

class Model_Knesset_New_Amendment extends ORM
{
    public function rules()
    {
        return [
            'knesset_new_primary_id' => [
                ['not_empty'],
                ['numeric'],
            ],
            'knesset_new_secondary_id' => [
                ['not_empty'],
                ['numeric'],
            ],
        ];
    }
}
