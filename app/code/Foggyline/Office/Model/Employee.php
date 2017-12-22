<?php

namespace Foggyline\Office\Model;

class Employee extends \Magento\Framework\Model\AbstractModel {
  const ENTITY = 'foggyline_office_employee';

  public function _construct() {
    $this->init('Foggyline\Office\Model\ResourceModel\Employee');
  }
}