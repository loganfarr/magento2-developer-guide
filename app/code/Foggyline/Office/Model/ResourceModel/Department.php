<?php

namespace Foggyline\Office\Model\ResourceModel;

class Department extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {
// AbstractDb further extends \Magento\Framework\Model\ResourceModel\AbstractResource

  protected function _construct() {
    // Init this resource class with two parameters: table name, and primary column name
    $this->_init('foggyline_office_department', 'entity_id');
  }
}