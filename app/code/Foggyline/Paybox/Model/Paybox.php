<?php

namespace Foggyline\Paybox\Model;

class Paybox extends \Magento\Payment\Model\Method\AbstractMethod
{
    const PAYMENT_METHOD_PAYBOX_CODE = 'paybox';
    protected $_code = self::PAYMENT_METHOD_PAYBOX_CODE;

    protected $_isOffline = true;

    public function getPayableTo() {
        return $this->configData('payable_to');
    }

    public function getMailingAddress() {
        return $this->getConfigData('mailing_address');
    }
}