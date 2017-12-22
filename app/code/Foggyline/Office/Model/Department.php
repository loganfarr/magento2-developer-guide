<?php

namespace Foggyline\Office\Model;

class Department extends \Magento\Framework\Model\AbstractModel {
  protected function _construct() {
    // Init this object with the Resource Class
    $this->_init('Foggyline\Office\Model\ResourceModel\Department');
  }
}