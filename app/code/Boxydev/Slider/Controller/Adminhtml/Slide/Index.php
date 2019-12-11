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

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action
{
    public function execute()
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Boxydev_Slider::head');
        $resultPage->getConfig()->getTitle()->prepend(__('Slides'));

        return $resultPage;
    }
}
