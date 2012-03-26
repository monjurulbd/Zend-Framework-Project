<?php
/**
 * Index link
 *
 */
class MyProject_View_Helper_IndexUrl extends Zend_View_Helper_Url
{
	/**
	 * Generate index url
	 *
	 * @param string $action
	 * @param string $controller
	 * @param array $args
	 * @return string (generate index url with 'action' and controller)
	 */
    public function indexUrl($action = 'index', $controller = 'index', $args = array())
    {
		$args = array_merge($args, array('action'     => $action,
			                             'controller' => $controller));
			
		return $this->url($args, null, true);
    }
}