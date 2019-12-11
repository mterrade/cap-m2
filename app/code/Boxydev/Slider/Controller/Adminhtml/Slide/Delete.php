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

class Delete extends Action
{
    const ADMIN_RESOURCE = 'Boxydev_Slider::slide_delete';

    /**
     * @var Slide
     */
    private $slide;

    /**
     * @var ResourceSlide
     */
    private $resourceSlide;

    public function __construct(Action\Context $context, SlideFactory $slideFactory, ResourceSlideFactory $resourceSlideFactory)
    {
        parent::__construct($context);
        $this->slide = $slideFactory->create();
        $this->resourceSlide = $resourceSlideFactory->create();
    }

    public function execute()
    {
        // When delete a slide
        if ($id = $this->getRequest()->getParam('id')) {
            $this->resourceSlide->load($this->slide, $id);
            $this->resourceSlide->delete($this->slide);
        }

        $this->messageManager->addSuccessMessage(__('Slide deleted'));

        return $this->resultRedirectFactory->create()->setPath('*/*/');
    }
}
