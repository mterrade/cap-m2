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
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\Controller\ResultFactory;

class Edit extends Action
{
    const ADMIN_RESOURCE = 'Boxydev_Contact::contact_save';

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
        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Boxydev_Slider::head');

        $contactData = $this->getRequest()->getPostValue();

        if ($contactData) {
            // When edit a contact
            if ($id = $this->getRequest()->getParam('id')) {
                $this->resourceContact->load($this->contact, $id);
            }

            $this->contact->addData([
                'name' => $contactData['name'],
                'image' => $contactData['image']
            ]);
            $this->resourceContact->save($this->contact);

            $this->messageManager->addSuccessMessage(__('Success'));

            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }

        return $resultPage;
    }
}
