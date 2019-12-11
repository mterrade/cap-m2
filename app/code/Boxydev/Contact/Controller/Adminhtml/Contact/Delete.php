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

use Boxydev\Contact\Model\Contact;
use Boxydev\Contact\Model\ContactFactory;
use Boxydev\Contact\Model\ResourceModel\ContactFactory as ResourceContactFactory;
use Boxydev\Contact\Model\ResourceModel\Contact as ResourceContact;
use Magento\Backend\App\Action;

class Delete extends Action
{
    const ADMIN_RESOURCE = 'Boxydev_Contact::contact_delete';

    /**
     * @var Contact
     */
    private $contact;

    /**
     * @var ResourceContact
     */
    private $resourceContact;

    public function __construct(Action\Context $context, ContactFactory $contactFactory, ResourceContactFactory $resourceContactFactory)
    {
        parent::__construct($context);
        $this->contact = $contactFactory->create();
        $this->resourceContact = $resourceContactFactory->create();
    }

    public function execute()
    {
        // When delete a contact
        if ($id = $this->getRequest()->getParam('id')) {
            $this->resourceContact->load($this->contact, $id);
            $this->resourceContact->delete($this->contact);
        }

        $this->messageManager->addSuccessMessage(__('Contact deleted'));

        return $this->resultRedirectFactory->create()->setPath('*/*/');
    }
}
