<?php

namespace Mastering\SampleModule\Block;

use Magento\Framework\View\Element\Template;
use Mastering\SampleModule\Model\ResourceModel\Collection;
use Mastering\SampleModule\Model\ResourceModel\CollectionFactory;

class Hello extends Template {
  private $collectionFactory;

  public function __construct(
    Template\Context $context, 
    CollectionFactory $CollectionFactory,
    array $data = []
  ) {
    $this->collectionFactory = $CollectionFactory;
    parent::__construct($context, $data);
  }

  /** 
   * @return \Mastering\SampleModule\Model\Item[]
   */
  public function getItems() {
    return $this->collectionFactory->create()->getItems();
  }
}