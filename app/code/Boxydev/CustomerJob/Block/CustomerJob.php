<?php

namespace Boxydev\CustomerJob\Block;

use Boxydev\CustomerJob\Model\Attribute\Source\Job;
use Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class CustomerJob extends Template
{
    /**
     * @var Session
     */
    private $customerSession;

    /**
     * @var Job
     */
    private $job;

    public function __construct(
        Context $context,
        Session $customerSession,
        Job $job,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->customerSession = $customerSession;
        $this->job = $job;
    }

    public function getCustomer()
    {
        return $this->customerSession->getCustomer();
    }

    public function getJobs()
    {
        return $this->job->getAllOptions();
    }
}
