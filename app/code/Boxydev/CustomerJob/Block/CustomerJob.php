<?php

namespace Boxydev\CustomerJob\Block;

use Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class CustomerJob extends Template
{
    /**
     * @var Session
     */
    private $customerSession;

    public function __construct(
        Context $context,
        Session $customerSession,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->customerSession = $customerSession;
    }

    public function getCustomer()
    {
        return $this->customerSession->getCustomer();
    }
}
