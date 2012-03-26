<?php

class IndexController extends MyProject_Index_Controller
{

    public function init()
    {
    	parent::init();
    }

    public function indexAction()
    {
        return $this->_forward('index', 'employees', 'index');
    }
}