<?php
/**
 * Add employee form elements
 */
class Model_Employees_Add_Form extends Zend_Form
{	
	/**
	 * init the form
	 */
    public function init()
    {
		$this->setAttrib('id', 'employeeAddForm');    
		$this->setAttrib('class', 'formInline');    
		
    	$firstName = new Zend_Form_Element_Text('firstName');
    	$firstName->setRequired(true)
    			  ->addFilter('StringTrim')
    			  ->addFilter('StripTags')
    			  ->addValidator('StringLength', false, array(3, 100))
				  ->setLabel('First Name:')
				  ->setAttrib('size', 34);		
		$this->addElement($firstName);		
		
		$lastName = new Zend_Form_Element_Text('lastName');
    	$lastName->setRequired(true)
    			  ->addFilter('StringTrim')
    			  ->addFilter('StripTags')
    			  ->addValidator('StringLength', false, array(3, 100))
				  ->setLabel('Last Name:')
				  ->setAttrib('size', 34);		
		$this->addElement($lastName);	
		
		$certificate = new Zend_Form_Element_Text('certificate');
    	$certificate->setRequired(true)
    			  ->addFilter('StringTrim')
    			  ->addFilter('StripTags')
    			  ->addValidator('StringLength', false, array(11, 11))
    			  ->addValidator(new MyProject_Validate_UniqueCertificate())
    			  ->addValidator('Regex', false, array('pattern' => '/^.{3}-.{3}-.{3}/', 'messages'=>'Certificate does not match against pattern (NNN-NNN-NNN)'))
				  ->setLabel('Certificate #:')
				  ->setAttrib('size', 34)
				  ->setAttrib('maxlength', 11);		
		$this->addElement($certificate);	
		
		$employerName = new Zend_Form_Element_Text('employerName');
    	$employerName->setRequired(true)
    			  ->addFilter('StringTrim')
    			  ->addFilter('StripTags')
    			  ->addValidator('StringLength', false, array(3, 200))
				  ->setLabel('Employer Name:')
				  ->setAttrib('size', 34);		
		$this->addElement($employerName);	
		
		$annualEarning = new Zend_Form_Element_Text('annualEarning');
    	$annualEarning->setRequired(true)
	    			  ->addFilter('StringTrim')
	    			  ->addFilter('StripTags')
	    			  ->addValidator('StringLength', false, array(1, 10))
	    			  ->addValidator('Digits')
					  ->setLabel('Annual Earnings:')
					  ->setAttrib('size', 34)
					  ->setAttrib('maxlength', 10);		
		$this->addElement($annualEarning);	
    			
    	$gender = new Zend_Form_Element_Radio('gender');
    	$gender->setRequired(true)
    	     ->setMultiOptions(array('M' => 'Male', 'F' => 'female'))
    	     ->setSeparator("&nbsp;&nbsp;&nbsp;")
			 ->setLabel('Gender:');
		$this->addElement($gender);	 
		
		$birthDate = new MyProject_Form_Element_Date('birthDate', array('yearStart' => 1920, 'yearEnd' => date('Y')));
    	$birthDate->setRequired(true)
    			  ->addValidator('Date', false, array('format' => 'yyyy-MM-dd'))
    			  ->addFilter(new MyProject_Filter_DateArray())
				  ->setLabel('Date of Birth:');
		$this->addElement($birthDate);
				  
		$lifeInsuranceClass = new Zend_Form_Element_Radio('lifeInsuranceClass');
    	$lifeInsuranceClass->setRequired(true)
	    			 		->setMultiOptions(array('A' => 'A', 'B' => 'B', 'C' => 'C'))
	    			 		->setSeparator("&nbsp;&nbsp;&nbsp;")
			 				->setLabel('Life Insurance Class:');	
		$this->addElement($lifeInsuranceClass);
		
		$beneficiary = new Zend_Form_Element_Text('beneficiary');
    	$beneficiary->setRequired(true)
	    			  ->addFilter('StringTrim')
	    			  ->addFilter('StripTags')
	    			  ->addValidator('StringLength', false, array(3, 200))
					  ->setLabel('Beneficiary:')
					  ->setAttrib('size', 34);		
		$this->addElement($beneficiary);
		
		$employeeId = new Zend_Form_Element_Hidden('employeeId');
		$this->addElement($employeeId);
		
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Submit:')
	   		  ->setValue('Submit');		
		$this->addElement($submit);
    }
}