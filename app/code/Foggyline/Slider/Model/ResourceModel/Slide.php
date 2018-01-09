<?php

namespace Foggyline\Slider\Model\ResourceModel;

class Slide extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {
  /**
   * Define main table
   *
   * @return void
   */
  protected function _construct() {
    /* _init($tableName, $idFieldName) */
    $this->_init('foggyline_slider_slide', 'slide_id');
  }
}