<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Checkout\Model\Carrier;

use Magento\Customer\Model\Session;
use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Quote\Model\Quote\Address\RateResult\Method;
use Magento\Quote\Model\Quote\Address\RateResult\MethodFactory;
use Magento\Shipping\Model\Carrier\AbstractCarrier;
use Magento\Shipping\Model\Carrier\CarrierInterface;
use Magento\Shipping\Model\Rate\Result;
use Magento\Shipping\Model\Rate\ResultFactory;

class BoxydevShipping extends AbstractCarrier implements CarrierInterface
{
    protected $_code = 'boxydevshipping';

    /**
     * @var ResultFactory
     */
    private $rateResultFactory;

    /**
     * @var MethodFactory
     */
    private $rateMethodFactory;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory,
        \Psr\Log\LoggerInterface $logger,
        ResultFactory $rateResultFactory,
        MethodFactory $rateMethodFactory,
        array $data = []
    ) {
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);

        $this->rateResultFactory = $rateResultFactory;
        $this->rateMethodFactory = $rateMethodFactory;
    }

    public function collectRates(RateRequest $request)
    {
        if (!$this->getConfigData('active')) {
            return false;
        }

        /** @var Result $result */
        $result = $this->rateResultFactory->create();

        /** @var Method $method */
        $method = $this->rateMethodFactory->create();

        $method->setCarrier($this->_code);
        $method->setCarrierTitle($this->getConfigData('title'));

        $method->setMethod($this->_code);
        $method->setMethodTitle($this->getConfigData('name'));

        // $shippingCost = (float) $this->getConfigData('shipping_cost');
        $postCode = (float) $this->getConfigData('shipping_cost') / 2;

        if (!empty($request->getDestPostcode())) {
            $postCode = (int) substr($request->getDestPostcode(), 0, 2);
        }

        $shippingCost = (float) $postCode * 2;

        $method->setPrice($shippingCost);
        $method->setCost($shippingCost);

        $result->append($method);

        // Deuxième méthode de paiement 2 fois plus chère
        $method = $this->rateMethodFactory->create();
        $method->setCarrier($this->_code);
        $method->setCarrierTitle($this->getConfigData('title'));
        $method->setMethod($this->_code . '-2');
        $method->setMethodTitle($this->getConfigData('name') . ' 2');
        $method->setPrice($shippingCost * 2);
        $method->setCost($shippingCost * 2);
        $result->append($method);

        return $result;
    }

    public function getAllowedMethods()
    {
        return [
            $this->_code => $this->getConfigData('name'),
        ];
    }
}
