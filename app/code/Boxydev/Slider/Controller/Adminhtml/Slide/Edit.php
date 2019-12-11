<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Slider\Controller\Adminhtml\Slide;

use Boxydev\Slider\Model\ResourceModel\SlideFactory as ResourceSlideFactory;
use Boxydev\Slider\Model\ResourceModel\Slide as ResourceSlide;
use Boxydev\Slider\Model\Slide;
use Boxydev\Slider\Model\SlideFactory;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Page;
use Magento\Catalog\Model\ImageUploader;
use Magento\Framework\Controller\ResultFactory;

class Edit extends Action
{
    const ADMIN_RESOURCE = 'Boxydev_Slider::slide_save';

    /**
     * @var Slide
     */
    private $slide;

    /**
     * @var ResourceSlide
     */
    private $resourceSlide;
    /**
     * @var ImageUploader
     */
    private $imageUploader;

    public function __construct(Action\Context $context, SlideFactory $slideFactory, ResourceSlideFactory $resourceSlideFactory, ImageUploader $imageUploader)
    {
        parent::__construct($context);
        $this->slide = $slideFactory->create();
        $this->resourceSlide = $resourceSlideFactory->create();
        $this->imageUploader = $imageUploader;
    }

    public function execute()
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Boxydev_Slider::head');

        $slideData = $this->getRequest()->getPostValue();

        if ($slideData) {
            // When edit a slide
            if ($id = $this->getRequest()->getParam('id')) {
                $this->resourceSlide->load($this->slide, $id);
            }

            $this->slide->addData([
                'name' => $slideData['name'],
                'image' => $slideData['image'][0]['name'] ?? null
            ]);
            $this->resourceSlide->save($this->slide);

            if ($this->slide->getData('image')) {
                $this->imageUploader->moveFileFromTmp($this->slide->getData('image'));
            }

            $this->messageManager->addSuccessMessage(__('Success'));

            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }

        return $resultPage;
    }
}
