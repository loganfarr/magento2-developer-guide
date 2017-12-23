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
    // Simple model, creating new entities, "flavor 1"
    // Implements "Magic Methods"
    $department1 = $this->departmentFactroy->create();
    $department1->setName('Finance')->save();

    // Simple model, "flavor 2"
    $department2 = $this->departmentFactroy->create();
    $department2->setData('name', 'Research')->save();


    // Simple model, "flavor 3"
    $department3 = $this->departmentFactroy->create();
    $department3->setData(['name' => 'Support'])->save();

    // Create employee entities
    // Something to remember: since we set department ID to be not null
    // foreign key, we need to set it or else we will get an error

    // EAV model, "flavor 1"
    // Implements "Magic Methods"
    $employee1 = $this->employeeFactory->create();
    $employee1->setDepartment_id($department1->getId());
    $employee1->setEmail('goran@mail.loc');
    $employee1->setFirstName('Goran');
    $employee1->setLastName('Gorvat');
    $employee1->setServiceYears(3);
    $employee1->setDob('1984-04-18');
    $employee1->setSalary(3800.00);
    $employee1->setVatNumber('123-45-6789');
    $employee1->setNote('Note #1');
    $employee1->save();

    // EAV model, "flavor 2"
    $employee2 = $this->employeeFactory->create();
    $employee2->setData('department_id', $department2->getId());
    $employee2->setData('email', 'marko@mail.loc');
    $employee2->setData('first_name', 'Marko');
    $employee2->setData('last_name', 'Tunukovic');
    $employee2->setData('service_years', 3);
    $employee2->setData('dob', '1984-04-18');
    $employee2->setData('salary', 3800.00);
    $employee2->setData('vat_number', '987-65-4321');
    $employee2->setData('note', 'Note #2');
    $employee2->save();

    // EAV model, "flavor 3"
    $employee3 = $this->employeeFactory->create();
    $employee3->setData([
      'department_id' => $department3->getId(),
      'email' => 'ivan@mail.loc',
      'first_name' => 'Ivan',
      'last_name' => 'Telebar',
      'service_years' => 2,
      'dob' => '1986-08-22',
      'salary' => 2400.00,
      'vat_number' => '456-12-3789',
      'note' => 'Note #3'
    ]);
  }
}