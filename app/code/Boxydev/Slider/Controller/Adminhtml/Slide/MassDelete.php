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

use Boxydev\Slider\Model\ResourceModel\Slide\Collection;
use Boxydev\Slider\Model\ResourceModel\Slide\CollectionFactory;
use Boxydev\Slider\Model\ResourceModel\Slide as ResourceSlide;
use Boxydev\Slider\Model\ResourceModel\SlideFactory as ResourceSlideFactory;
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
     * @var ResourceSlide
     */
    private $resourceSlide;

    public function __construct(
        Action\Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        ResourceSlideFactory $resourceSlideFactory
    ) {
        parent::__construct($context);
        $this->filter = $filter;
        $this->collection = $collectionFactory->create();
        $this->resourceSlide = $resourceSlideFactory->create();
    }

    public function execute()
    {
        $collection = $this->filter->getCollection($this->collection);

        foreach ($collection as $slide) {
            $this->resourceSlide->delete($slide);
        }

        $this->messageManager->addSuccessMessage(__('Slide deleted'));

        return $this->resultRedirectFactory->create()->setPath('*/*/');
    }
}
