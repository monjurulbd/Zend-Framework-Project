<?php
/**
 * Custom index controller which contains all common functionalities and properties
 * which will extend in every controller of index module
 */
class MyProject_Index_Controller extends Zend_Controller_Action
{
	/**
	 * Initialize the controller
	 */
	public function init()
	{
		parent::init();
		
		//Index module URL
		$helper = new MyProject_View_Helper_IndexUrl();
		$this->view->registerHelper($helper, 'indexUrl');
		
		//Form date helper
		$helper = new MyProject_View_Helper_FormDate();
		$this->view->registerHelper($helper, 'formDate');
	}
}