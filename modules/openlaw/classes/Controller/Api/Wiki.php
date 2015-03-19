<?php

class Controller_Api_Wiki extends Controller_Json
{
    public function action_index()
    {
        $this->template->data = 'Wiki';
    }
}
