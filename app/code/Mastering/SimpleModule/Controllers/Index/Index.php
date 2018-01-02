<?php

namespace Mastering\SampleModule\Controller\Index;

use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\Framework\App\Action\Action {
  // This class must return a result interface or a response interface
  public function execute() {
    /**
     *  @var \Magento\Framework\Controller\Result\Raw $result
     */
    return $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
  }
}