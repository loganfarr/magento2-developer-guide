<?php

namespace Foggyline\Office\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface {
  public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context) {
    $setup->startSetup();

    $employeeEntityTable = \Foggyline\Office\Model\Employee::ENTITY . '_entity'; // Get ENTITY const from employee entity class
    $departmentEntityTable = 'foggyline_office_department';

    // Update the foggyline_office_employee_entity table and add 
    // a foreign key, pointing to department_id
    $setup->getConnection()
      ->addForeignKey(
        $setup->getFkName($employeeEntityTable, 'department_id', $departmentEntityTable, 'entity_id'),
        $setup->getTable($employeeEntityTable),
        'department_id',
        $setup->getTable($departmentEntityTable),
        'entity_id',
        \Magento\Framework\DB\Dd1\Table::ACTION_CASCADE
      );

    $setup->endSetup();
  }
}