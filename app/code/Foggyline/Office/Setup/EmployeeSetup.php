<?php

namespace Foggyline\Office\Setup;
use Magento\Eav\Setup\EavSetup;

// We extend EavSetup and tell Magento we are about to create our own entity
class EmployeeSetup extends EavSetup {
  // Returns an array of entities we want to register with Magento
  public function getDefaultEntities() {
    $employeeEntity = \Foggyline\Office\Model\Employee::ENTITY;

    // This is what actually creates attributes and a new entity type
    $entities = [
      $employeeEntity => [ // This becomes an entry in the eav_entity table
        'entity_model' => 'Foggyline\Office\Model\ResourceModel\Employee', // Required 
        'table' => $employeeEntity . '_entity', 
        'attributes' => [
          'department_id' => [
            'type' => 'static'
          ],
          'email' => [
            'type' => 'static'
          ],
          'first_name' => [
            'type' => 'static'
          ],
          'last_name' => [
            'type' => 'static'
          ]
        ]
      ]
    ];

    return $entities;
  }
}