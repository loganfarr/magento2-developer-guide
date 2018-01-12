<?php

namespace Foggyline\Shipbox\Model\Carrier;

use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Shipping\Model\Carrier\AbstractCarrier;
use Magento\Shipping\Model\Carrier\CarrierInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory;
use Magento\Shipping\Model\Rate\ResultFactory;
Use Magento\Quote\Model\Quote\Address\RateResult\MethodFactory as RateMethodFactory;
use Psr\Log\Log\LoggerInterface;

class Shipbox extends AbstractCarrier implements CarrierInterface {
    protected $_code = 'shipbox';
    protected $_isFixed = true;
    protected $_rateResultFactory;
    protected $_rateMethodFactory;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        ErrorFactory $rateErrorFactory,
        LoggerInterface $logger,
        ResultFactory $rateResultFactory,
        RateMethodFactory $rateMethodFactory,
        array $data = []
    ) {
        $this->_rateResultFactory = $rateResultFactory;
        $this->_rateMethodFactory = $rateMethodFactory;
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);
    }

    public function collectRates(RateRequest $request) {
        if (!$this->getConfigFlag('active')) {
            return false;
        }

        // Do some filtering of items in the cart
        if ($request->getAllItems()) {
            foreach ($request->getAllItems() as $item) {
                // $item->getQty()
                // $item->getFreeShipping()
                // $item->isShipSeparately()
                // $item->getHasChildren()
                // $item->getProduct()->isVirtual()
                // ...
            }
        }

        // After filtering, start forming final price
        // Final price does not have to be fixed like below
        $shippingPrice = $this->getConfigData('price');
        $result =  $this->_rateResultFactory->create();

        $method = $this->_rateMethodFactory->create();

        $method->setCarrier('shipbox');
        $method->setCarrierTitle($this->getConfigData('title'));

        $method->setMethod('shipbox');
        $method->setMethodTitle($this->getConfigData('name'));

        $method->setPrice($shippingPrice);
        $method->setCost($shippingPrice);

        $result->append($method);

        return $result;
    }

    public function getAllowedMethods() {
        return ['shipbox' => $this->getConfigData('name')];
    }
}