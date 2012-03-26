<?php
/**
 * Custom index controller which contains all common functionalities and properties
 */
class MyProject_Form_Element_Date extends Zend_Form_Element_Xhtml
{
	public $helper = 'formDate';
	
	/**
	 * Initialize the class
	 */
    public function __construct($spec, $options = null)
    {
    	// construct the thing
    	parent::__construct($spec, $options);
    }
	
	/**
	 * Set today date as a value
	 */
	public function setValueToToday()
	{
		return $this->setValue(date('Y-n-j'));
	}
	
	/**
	 * Get date string
	 */
	static function getDatestring($value, $format = 'yyyy-mm-dd')
	{		
		if (is_array($value)) {
			$search = array('yyyy', 'yy', 'mm', 'dd');
			$replace = array(
				@$value['y'] ? $value['y'] : '0000', // yyyy
				@$value['y'] ? $value['y'] : '0000', // yy
				@$value['m'] ? sprintf('%02d', $value['m']) : '00', // mm
				@$value['d'] ? sprintf('%02d', $value['d']) : '00', // dd
			);
			
			$value = str_replace($search, $replace, $format);
		}
		
		return is_string($value) ? $value : '';
	}
}

?>