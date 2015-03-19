<?php defined('SYSPATH') or die('No direct script access.');

abstract class Kohana_Controller_Json extends Controller_Template
{
    /**
     * @var  View  page template
     */
    public $template = 'serialize/json';
}
