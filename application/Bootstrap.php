<?php
/**
 * Application bootstrap class (initialize all resources)
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	/**
	 * Initialize autoload nad register project namespace
	 */
	protected function _initAutoload()
	{
		$autoloader = new Zend_Application_Module_Autoloader(array(
            'namespace' => '',
            'basePath'  => dirname(__FILE__),
		));
		
		//Project namespace
		$autoloader = Zend_Loader_Autoloader::getInstance()->registerNamespace('MyProject_');

		return $autoloader;
	}

	/**
	 * Initialize application configuration file
	 */
	protected function _initConfig()
	{
		$config = new Zend_Config($this->getOptions());
		Zend_Registry::set('config', $config);

		$resource = $this->getPluginResource('db');
		$db = $resource->getDbAdapter();
		Zend_Db_Table_Abstract::setDefaultAdapter($db);	
	}
	
	/**
	 * Initialize Doc type
	 */
	protected function _initDoctype()
	{
		$this->bootstrap('layout');
		$this->bootstrap('view');
		
		//Get view instances
		$view	= $this->getResource('view');

		//Set doctype, content type
		$view->doctype('XHTML1_TRANSITIONAL');
		$view->headMeta()->appendHttpEquiv('Content-Type', 'text/html;charset=utf-8');
	}

	/**
	 * Initialize the sections of the system (index, admin)
	 */
	protected function _initModules()
	{
		$frontController = Zend_Controller_Front::getInstance();
		
		//Set index module as default module
		$frontController->setControllerDirectory(array('default' => APPLICATION_PATH . '/modules/index/controllers'));
		
		//Add admin module
		$frontController->addControllerDirectory(APPLICATION_PATH . '/modules/admin/controllers', 'admin');
		
		$layout = Zend_Layout::startMvc();
	}
	
	/**
	 * Initialize custom helper class
	 */
	protected function _initHelpers()
	{
		Zend_Controller_Action_HelperBroker::addPrefix('MyProject_Controller_Helper');
	}
}
