<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Contact\Controller\Adminhtml\Contact;

use Boxydev\Contact\Model\ResourceModel\Contact as ResourceContact;
use Boxydev\Contact\Model\ResourceModel\ContactFactory as ResourceContactFactory;
use Boxydev\Contact\Model\ResourceModel\Contact\Collection;
use Boxydev\Contact\Model\ResourceModel\Contact\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Ui\Component\MassAction\Filter;

class MassDelete extends Action
{
    /**
     * @var Filter
     */
    private $filter;

    /**
     * @var Collection
     */
    private $collection;

    /**
     * @var ResourceContact
     */
    private $resourceContact;

    public function __construct(
        Action\Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        ResourceContactFactory $resourceContactFactory
    ) {
        parent::__construct($context);
        $this->filter = $filter;
        $this->collection = $collectionFactory->create();
        $this->resourceContact = $resourceContactFactory->create();
    }

    public function execute()
    {
        $collection = $this->filter->getCollection($this->collection);

        foreach ($collection as $contact) {
            $this->resourceContact->delete($contact);
        }

        $this->messageManager->addSuccessMessage(__('Contact deleted'));

        return $this->resultRedirectFactory->create()->setPath('*/*/');
    }
}
