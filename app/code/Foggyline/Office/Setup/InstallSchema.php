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
    
    // Create the department table
    // Columns - 
    //   entity_id - primary ID, unsigned int, not nullable 
    //   name - 64-character string 
    $table = $setup->getConnection()
      ->newTable($setup->getTable('foggyline_office_department'))
      ->addColumn(
        'entity_id', // Column name
        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, // Column type
        null, // Column length?
        [ 'identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true], // Options
        'Entity ID' // Column comment
      )
      ->addColumn(
        'name',
        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
        64,
        [],
        'Name'
      )
      ->setComment('Foggyline Office Department Table'); // Set table comment

    $setup->getConnection()->createTable($table);

    // Load ENTITY const from \Foggyline\Office\Model - As of now, it is 'foggyline_office_employee'
    $employeeEntity = \Foggyline\Office\Model\Employee::ENTITY;

    // Create entity table - foggyline_office_employee_entity
    // This creates base entity table
    // Columns-
    //   entity_id - primary ID, unsigned int, not null
    //   department_id - unsigned int, not nullable
    //   email - 64 character text
    //   first_name - 64 character text
    //   last_name - 64 character text
    $table = $setup->getConnection()
      ->newTable($setup->getTable($employeeEntity . '_entity'))
      ->addColumn(
        'entity_id',
        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
        null,
        ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
        'Entity ID'
      )
      ->addColumn(
        'department_id',
        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
        null,
        ['unsigned' => true, 'nullable' => false],
        'Department Id'
      )
      // Email, 
      ->addColumn(
        'email',
        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
        64,
        [],
        'Email'
      )
      ->addColumn(
        'first_name',
        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
        64,
        [],
        'First Name'
      )
      ->addColumn(
        'last_name',
        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
        64,
        [],
        'Last Name'
      )
      ->setComment('Foggyline Office Employee Table');

    $setup->getconnection()->createTable($table);

    // Create the employee salary table - foggyline_office_employee_entity_decimal
    // Columns-
    //   value_id - primary integer, not nullable
    //   attribute_id - unsigned smallint, default 0, not nullable
    //     Foreign key referencing 
    //   store_id - Unsigned smallint, default 0, not nullable
    //     Foreign key referencing Magento store IDs
    //   entity_id - unsigned int, default 0, not nullable
    //     Foreign key referencing foggyline_office_employee_entity table created above
    //   value - decimal, size 12.4 
    $table = $setup->getConnection() 
      ->newTable($setp->getTable($employeeEntity . '_entity_decimal'))
      ->addColumn(
        'value_id',
        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
        null,
        ['identity' => true, 'nullable' => false, 'primary' => true],
        'Value ID'
      )
      ->addColumn(
        'attribute_id',
        \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
        null,
        ['unsigned' => true, 'nullable' => false, 'default' => '0'],
        'Attribute ID'
      )
      ->addColumn(
        'store_id',
        \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
        null,
        ['unsigned' => true, 'nullable' => false, 'default' => '0'],
        'Store ID'
      )
      ->addColumn(
        'entity_id',
        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
        null,
        ['unsigned' => true, 'nullable' => false, 'default' => '0'],
        'Entity ID'
      )
      ->addColumn(
        'value',
        \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
        '12.4',
        [],
        'Value'
      )
      // Adding 3 indexs to foggyline_office_employee_entity_decimal table
      ->addIndex(
        $setup->getIdxName(
          $employeeEntity . '_entity_decimal',
          ['entity_id', 'attribute_id', 'store_id'],
          \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
        ),
        ['entity_id', 'attribute_id', 'store_id'],
        ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
      )
      ->addIndex(
        $setup->getIdxName($employeeEntity . '_entity_decimal', ['store_id']),
        ['store_id']
      )
      ->addIndex(
        $setup->getIdxName($employeeEntity . '_entity_decimal', ['attribute_id']),
        ['attribute_id']
      )
      ->setForeignKey(
        $setup->getFkName($employeeEntity . '_entity_decimal', 'attribute_id', 'eav_attribute', 'attribute_id'),
        'attribute_id',
        $setup->getTable('eav_attribute'),
        'attribute_id',
        \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
      )
      // Set foreign key referencing foggyline_office_employee_entity_decimal table, entity_id column 
      ->addForeignKey(
        $setup->getFkName($employeeEntity . '_entity_decimal', 'entity_id', $employeeEntity . '_entity', 'entity_id'),
        'entity_id',
        $setup->getTable($employeeEntity . '_entity'),
        'entity_id',
        \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
      )
      // Set foreign key referencing foggyline_office_employee_entity_decimal table, store_id column 
      // It's a good idea to keep track of store_id in case of a possible multi-store setup
      ->addForeignKey(
        $setup->getFkName($employeeEntity . '_entity_decimal', 'store_id', 'store', 'store_id'),
        'store_id', 
        $setup->getTable($employeeEntity . '_entity'),
        'entity_id',
        \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
      )
      ->setComment('Employee Decimal Attribute Backend Table');

    $setup->getConnection()->createTable($table);

    $setup->endSetup();
  }
}