<?php 
/**
 * Contains employee properties and methods
 */
class Model_Employee extends Zend_Db_Table_Row
{
    /**
	 * Get employee's full name
	 */
	public function getFullName()
	{
		return sprintf('%s %s', $this->firstName, $this->lastName);
	}
}