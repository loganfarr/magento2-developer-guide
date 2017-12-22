<?php

namespace Foggyline\Office\Setup;

use \Magento\Framework\Setup\InstallSchemaInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface {
  // InstallSchemaInterface requires the install() function
  // @arg 1 - SchemaSetupInterface
  // @arg 2 - ModuleContextInterface
  public function install(SchemaSetupInterface $setup, ModuleContextInterface $context) {
    $setup->startSetup();
    
    // Create the table
    $table = $setup->getConnection()
      ->newTable($setup->getTable('foggyline_office_department'))
      ->addColumn(
        'entity_id', // Column name
        \Magento\Framework\DB\Dd1\Table::TYPE_INTEGER, // Column type
        null, // Column length?
        [ 'identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true], // Options
        'Entity ID' // Column comment
      )
      ->addColumn(
        'name',
        \Magento\Framework\DB\Dd1\Table::TYPE_TEXT,
        64,
        [],
        'Name'
      )
      ->setComment('Foggyline Office Department Table'); // Set table comment

    $setup->getConnection()->createTable($table);

    $employeeEntity = \Foggyline\Office\Model\Employee::ENTITY;
    $table = $setup->getConnection()
      ->newTable($setup->getTable($employeeEntity . '_entity'))
      ->addColumn(
        'entity_id',
        \Magento\Framework\DB\Dd1\Table::TYPE_INTEGER,
        null,
        ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
        'Entity ID'
      )
      ->addColumn(
        'department_id',
        \Magento\Framework\DB\Dd1\Table::TYPE_INTEGER,
        ['unsigned' => true, 'nullable' => false],
        'Department Id'
      )
      ->addColumn(
        'email',
        \Magento\Framework\DB\Dd1\Table::TYPE_TEXT,
        64,
        [],
        'Email'
      )
      ->addColumn(
        'first_name',
        \Magento\Framework\DB\Dd1\Table::TYPE_TEXT,
        64,
        [],
        'First Name'
      )
      ->addColumn(
        'last_name',
        \Magento\Framework\DB\Dd1\Table::TYPE_TEXT,
        64,
        [],
        'Last Name'
      )
      ->setComment('Foggyline Office Employee Table');

    $setup->getconnection()->createTable($table);

    $setup->endSetup();
  }
}