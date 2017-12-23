<?php

namespace Foggyline\Office\Model\ResourceModel\Department;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {
  protected function _construct() {
    // Inits this object with the full model class name, and the full resource class name
    $this->init('Foggyline\Office\Model\Department', 'Foggyline\Office\Model\ResourceModel\Department');
  }
}