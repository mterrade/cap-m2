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

use Boxydev\Slider\Model\ResourceModel\Slide as ResourceSlide;
use Boxydev\Slider\Model\ResourceModel\SlideFactory as ResourceSlideFactory;
use Boxydev\Slider\Model\SlideFactory;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class InlineEdit extends Action
{
    const ADMIN_RESOURCE = 'Boxydev_Slider::slide_save';

    /**
     * @var ResourceSlide
     */
    private $resourceSlide;

    /**
     * @var SlideFactory
     */
    private $slideFactory;

    public function __construct(
        Action\Context $context,
        ResourceSlideFactory $resourceSlideFactory,
        SlideFactory $slideFactory
    ) {
        parent::__construct($context);
        $this->resourceSlide = $resourceSlideFactory->create();
        $this->slideFactory = $slideFactory;
    }
    public function execute()
    {
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $items = $this->getRequest()->getParam('items');

        foreach ($items as $item) {
            $slide = $this->slideFactory->create();
            $this->resourceSlide->load($slide, $item['id']);
            $slide->addData($item);
            $this->resourceSlide->save($slide);
        }

        return $resultJson->setData([
            'error' => false
        ]);
    }
}
