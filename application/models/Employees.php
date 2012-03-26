<?php
class Model_Employees extends Zend_Db_Table_Abstract
{
    protected $_name	 = 'employees';
	protected $_primary	 = 'employeeId';
	protected $_rowClass = 'Model_Employee';
	
	/**
	 * Fetch all employees
	 * 
	 * @param int|string $page
	 * @return object (Zend_Paginator)
	 */
	public function fetchAllWithPage($page = 1)
	{
		$select = $this->select();
		$select->where('active = ?', 'Y');		
		$select->order('employeeId DESC');
		
		$paginator = Zend_Paginator::factory($select);
		
		if ($page != 'ALL') {
			$paginator->setItemCountPerPage(10)->setCurrentPageNumber($page);
		} else {
			$paginator->setItemCountPerPage(100);
		}
		
		return $paginator;
	}
	
	/**
	 * Fetch an employee
	 * 
	 * @param int $employeeId
	 */
	public function fetch($employeeId)
	{
		$select = $this->select();
		$select->where('employeeId = ?', (int) $employeeId);
		
		return $this->fetchRow($select);
	}
	
	/**
	 * Fetch an employee with certificate
	 * 
	 * @param string $certificate
	 */
	public function fetchByCertificate($certificate)
	{
		$select = $this->select();
		$select->where('certificate = ?', $certificate);
		
		return $this->fetchRow($select);
	}
	
	/**
	 * Add an employee
	 * 
	 * @param array $data
	 * @return int
	 */
	public function add($data)
	{
		$data = array('certificate'        => $data['certificate'],
					  'employerName'       => $data['employerName'],
			          'firstName'          => $data['firstName'],
			          'lastName'           => $data['lastName'],
			          'birthDate'          => $data['birthDate'],
			          'gender'             => $data['gender'],
			          'annualEarning'      => $data['annualEarning'],		
			          'lifeInsuranceClass' => $data['lifeInsuranceClass'],
			          'beneficiary' => $data['beneficiary']);		
		
		return $this->insert($data);	
	}
	
	/**
	 * Insert a new employee
	 * 
	 * @param array $data
	 * @return int
	 */
	public function insert($data) 
	{
		$date = new Zend_Date();
		$data['activeDate'] = $date->toString('yyyy-MM-dd');
		
		return parent::insert($data);
	}
		
	/**
	 * Update an employee
	 * 
	 * @param int $employeeId
	 * @param array $data
	 */
	public function update($employeeId, $data) 
	{
		$where = $this->getAdapter()->quoteInto('employeeId = ?', (int) $employeeId);
				
		return parent::update($data, $where);
	}
	
	/**
	 * Delete an employee
	 * 
	 * @param int $employeeId
	 */
	public function delete($employeeId)
	{
		$where = $this->getAdapter()->quoteInto('employeeId = ?', (int) $employeeId);
		
		parent::delete($where);
	}
}