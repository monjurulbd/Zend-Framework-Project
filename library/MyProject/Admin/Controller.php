<?php
/**
 * Custom admin controller which contains all common functionalities and properties
 * which will extend in every controller of admin module
 */
class MyProject_Admin_Controller extends Zend_Controller_Action
{
	/**
	 * Initialize the controller
	 */
	public function init()
	{
		parent::init();	
		
		//Here will stay all common properties when added new features in future
	}
}