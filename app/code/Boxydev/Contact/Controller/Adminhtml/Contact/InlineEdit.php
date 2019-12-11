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
use Boxydev\Contact\Model\ContactFactory;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class InlineEdit extends Action
{
    const ADMIN_RESOURCE = 'Boxydev_Contact::contact_save';

    /**
     * @var ResourceContact
     */
    private $resourceContact;

    /**
     * @var ContactFactory
     */
    private $contactFactory;

    public function __construct(
        Action\Context $context,
        ResourceContactFactory $resourceContactFactory,
        ContactFactory $contactFactory
    ) {
        parent::__construct($context);
        $this->resourceContact = $resourceContactFactory->create();
        $this->contactFactory = $contactFactory;
    }
    public function execute()
    {
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $items = $this->getRequest()->getParam('items');

        foreach ($items as $item) {
            $contact = $this->contactFactory->create();
            $this->resourceContact->load($contact, $item['id']);
            $contact->addData($item);
            $this->resourceContact->save($contact);
        }

        return $resultJson->setData([
            'error' => false
        ]);
    }
}
