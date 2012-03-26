<?php
/**
 * Employees controller class contains all functionalities of employees like employee
 * list, add, edit and delete an employee also contains their related methods.
 *
 */
class EmployeesController extends MyProject_Index_Controller
{
    /**
	 * Initialize the controller
	 */
    public function init()
    {
    	parent::init(); 
    }
	
	/**
	 * Landing page; forwards to listAction()
	 */		
    public function indexAction()
    {
		$this->_forward('list');
	}
	
	/**
	 * List employees with page
	 */
	public function listAction()
	{	
		$modelEmployees = new Model_Employees();
		
    	$page = $this->_getParam('page', 1);
    	$params['page'] = $page;
    	$message = $this->_getParam('message');
    	$params['message'] = '';
    	
    	//Fetch all employees with pagination
    	$employees = $modelEmployees->fetchAllWithPage($page);
    	
        $this->view->employees = $employees;
        $this->view->params = $params;
        
        //Info message
        if ($message == 'added') {
			$this->view->infoMessage = 'Employee was added successfully.';
		} elseif ($message == 'edited') {
			$this->view->infoMessage = 'Employee was edited successfully.';
	    } elseif ($message == 'deleted') {
			$this->view->infoMessage = 'Employee was deleted successfully.';
		}
	}
	
    /**
     * Add/edit an employee
     */
	public function addAction()
    {
    	$modelEmployees = new Model_Employees();
    	
    	$employeeId = (int) $this->_getParam('employeeId');
    	
    	$form = $this->getAddForm();
		$populateData = array();
		
		if ($employeeId) {
			$employee = $modelEmployees->fetch($employeeId);
			
			//Check if employee exist
			if ($employee instanceof Model_Employee) {
				$populateData = $employee->toArray();
				
				//Add unique certificate validation
				$element = $form->getElement('certificate');
				$element->addValidator(new MyProject_Validate_UniqueCertificate($populateData['certificate']));
				
			}
		}
		
    	// form was submitted
		$request = $this->getRequest();
				
		if ($request->isPost()) {
			$post = $request->getPost();
			
			//Check form validation
			if ($form->isValid($post)) {			
				$values = $form->getValues();	
				$message = '';
				
	        	if ($employeeId) {
	        		
					//Edit an employee
					$employeeId = $modelEmployees->update($employeeId, $values);
					$message = 'edited';
	        	} else {
					
					//Add an employee
					$employeeId = $modelEmployees->add($values);
					$message = 'added';
				}
				
				//Redirect to the list method
				$this->_helper->redirector('list', 'employees', 'default', array('message' => $message));
			}
		}
		
		//Populate existing data (for edit employee)
		$form->populate($populateData);
		$this->view->form = $form;		  	
    }
	   
    /**
     * Delete an employee
     */
	public function deleteAction()
    {
    	$modelEmployees = new Model_Employees();
    	
    	$employeeId = (int) $this->_getParam('employeeId');
    	
    	//Delete an employee
		$modelEmployees->delete($employeeId);
    	
    	//Redirect to the list method
		$this->_helper->redirector('list', 'employees', 'default', array('message' => 'deleted'));
    }
    
	/**
	 * Form for add an employee
	 */
	private function getAddForm()
	{
		$form = new Model_Employees_Add_Form(array('method' => 'post', 'action' => $this->_helper->url('add', 'employees'),));
		
		return $form;
	}
		       
}