<?php

namespace Foggyline\Office\Model\ResourceModel;

class Employee extends \Magento\Eav\Model\Entity\AbstractEntity {
  protected function _construct() {
    // Sets _read and _write properties in constructor
    // These need to be named or else Magento products 
    // an error when using our entities
    $this->_read = 'foggyline_office_employee_read';
    $this->_write = 'foggyline_office_employee_write';
  }

  // This return value is what is stored in the entity_type_code
  // column in the eav_entity_table. 
  public function getEntityType() {
    if(empty($this->_type)) {
      $this->setType(\Foggyline\Office\Model\Employee::ENTITY);
    }

    return parent::getEntityType();
  }
}