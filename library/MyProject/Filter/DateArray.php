<?php
/**
 * Custom filter class for date array
 */
class MyProject_Filter_DateArray implements Zend_Filter_Interface
{
	protected $_dateFormat = 'yyyy-mm-dd';
	
	/**
	 * Initialize the class
	 * 
	 * @param string $format
	 */
	public function __construct($format = null)
	{
		if ($format) {
			$this->setDateFormat($format);
		}
	}
	
	/**
	 * Set date format
	 * 
	 * @param string $format
	 */
	public function setDateFormat($format)
	{
		$this->_dateFormat = $format;
		return $this;
	}
	
	/**
	 * Get date format
	 * 
	 * @return string
	 */
	public function getDateFormat()
	{
		return $this->_dateFormat;
	}
	
	/**
	 * Get date
	 * 
	 * @return string
	 */
	public function getEmptyDate()
	{
		return preg_replace('/[y|m|d]/', '0', $this->getDateFormat());
	}
	
	/**
	 * Filter date
	 * 
	 * @return string
	 */
	public function filter($value)
	{
		if (is_array($value)) {
			$value = MyProject_Form_Element_Date::getDatestring($value, $this->getDateFormat());
		}
		
		if ($value == $this->getEmptyDate()) {
			$value = null;
		}
		
		return $value;
	}
}

?>