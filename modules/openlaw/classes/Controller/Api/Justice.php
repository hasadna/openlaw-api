<?php

class Controller_Api_Justice extends Controller_Json
{
    public function action_index()
    {
        $this->template->data = 'Justice';
    }
}
