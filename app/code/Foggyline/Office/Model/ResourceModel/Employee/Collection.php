<?php

namespace Foggyline\Office\Model\ResourceModel\Employee;

class Collection extends \Magento\Eav\Model\Entity\Collection\AbstractCollection {
  protected function _construct() {
    // Inits the object with our full model class name and our full resource class name.
    $this->_init('Foggyline\Office\Model\Employee', 'Foggyline\Office\Model\ResourceModel\Employee');
  }
}