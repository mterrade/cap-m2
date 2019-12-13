<?php

namespace Boxydev\CustomerJob\Block;

use Boxydev\CustomerJob\Model\Attribute\Source\Job;
use Magento\Customer\Model\Session;
use Magento\Framework\Api\SearchCriteriaBuilder;
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

    /**
     * @var \Magento\Customer\Model\ResourceModel\Customer\Collection
     */
    private $customerCollection;

    /**
     * @var \Magento\Customer\Api\CustomerRepositoryInterface
     */
    private $customerRepository;
    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    public function __construct(
        Context $context,
        Session $customerSession,
        Job $job,
        \Magento\Customer\Model\ResourceModel\Customer\Collection $customerCollection,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->customerSession = $customerSession;
        $this->job = $job;
        $this->customerCollection = $customerCollection;
        $this->customerRepository = $customerRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    public function getCustomer()
    {
        return $this->customerSession->getCustomer();
    }

    public function getCustomerCollection()
    {
        return $this->customerCollection;
    }

    public function getCustomerListByRepository()
    {
        return $this->customerRepository->getList(
            $this->searchCriteriaBuilder->create()
        );
    }

    public function getJobs()
    {
        return $this->job->getAllOptions();
    }
}
