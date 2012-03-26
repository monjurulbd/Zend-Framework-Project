<?php
/**
 * Unique certificate validation class which ensure that not more 
 * than one employee have the same certificate
 *
 */	
class MyProject_Validate_UniqueCertificate extends Zend_Validate_Abstract
{
	const INVALID_CERTIFICATE = 'taken';
	
	protected $_messageTemplates = array(
		self::INVALID_CERTIFICATE => "Certificate is already taken",
	);		
	
	/**
	 * Initialize with existing value
	 *
	 * @param string $excludeValue
	 */	
	public function __construct($excludeValue = null)
	{
		$this->excludeValue = $excludeValue;
	}		
	
	/**
	 * Check if a certificate is free for a new employee
	 *
	 * @param string $value
	 * @return bool
	 */	
	public function isValid($value)
	{
		//Existing certificate is always allowed (when edit an employee)
		if ($value == $this->excludeValue) {
			return true;
		}
		
		$modelEmployees = new Model_Employees();
		
		$employee = $modelEmployees->fetchByCertificate($value);
		
		//Check exist employee who have same certificate
		if ($employee instanceof Model_Employee) {	
			$this->_error(self::INVALID_CERTIFICATE);
			return false;
		}
		
		return true;
	}
}