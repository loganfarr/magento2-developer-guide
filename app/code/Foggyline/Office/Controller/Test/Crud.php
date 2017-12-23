<?php

namespace Foggyline\Office\Controller\Test;

class Crud extends \Foggyline\Office\Controller\Test {
  protected $employeeFactory;
  protected $departmentFactroy;

  public function __construct(
    \Magento\Framework\App\Action\Context $context,
    \Foggyline\Office\Model\EmployeeFactory $employeeFactory,
    \Foggyline\Office\Model\DepartmentFactory $departmentFactroy) {
    $this->employeeFactory = $employeeFactory;
    $this->departmentFactroy = $departmentFactroy;
    return parent::__construct($context);
  }

  public function execute() {
    /* CRUD fns go here */
  }
}