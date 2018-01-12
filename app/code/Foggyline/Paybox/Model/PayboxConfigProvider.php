<?php

namespace Foggyline\Paybox\Model;

class PayboxConfigProvider implements \Magento\Checkout\Model\ConfigProviderInterface 
{
    protected $methodCode = \Foggyline\Paybox\Model\Paybox::PAYMENT_METHOD_PAYBOX_CODE;
    protected $method;
    protected $escaper;

    public function __construct(\Magento\Payment\Helper\Data $paymentHelper) {
        $this->method = $paymentHelper->getMethodInstance($this->methodCode);
    }

    public function getConfig() {
        return $this->method->isAvailable() ? [
            'payment' => [
                'paybox' => [
                    'mailingaddress' => $this->getMailingAddress(),
                    'payableTo' => $this->getPayableTo(),
                ]
            ]
        ] : [];
    }

    protected function getMailingAddress() {
        $this->method->getMailingAddress();
    }

    protected function getPayableTo() {
        return $this->method->getPayableTo();
    }
}