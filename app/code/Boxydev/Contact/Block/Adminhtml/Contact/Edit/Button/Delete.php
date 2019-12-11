<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Contact\Block\Adminhtml\Contact\Edit\Button;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Delete implements ButtonProviderInterface
{
    /**
     * @var Context
     */
    private $context;

    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    public function getButtonData()
    {
        $data = [];

        if ($this->context->getRequest()->getParam('id')) {
            $data = [
                'label' => __('Delete Contact'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\''
                    . __('Are you sure you want to delete this contact ?')
                    . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 20,
            ];
        }

        return $data;
    }

    public function getDeleteUrl()
    {
        return $this->context->getUrlBuilder()->getUrl('*/*/delete', ['id' => $this->context->getRequest()->getParam('id')]);
    }
}
