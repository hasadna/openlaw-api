<?php

class Controller_Openlaw_Rss extends Controller_Rss
{
    public function action_index()
    {
        $this->response->body('Rss Index');
        // TODO: List rss links
    }

    public function action_justice()
    {
        // TODO: Make justice's rss more friendly
    }

    public function action_knesset()
    {
        // TODO: Convert the knesset's updates feed
    }
}
