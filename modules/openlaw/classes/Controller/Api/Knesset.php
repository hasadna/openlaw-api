<?php

class Controller_Api_Knesset extends Controller_Json
{
    public function action_index()
    {
        $this->template->data = 'Knesset';
    }
}
