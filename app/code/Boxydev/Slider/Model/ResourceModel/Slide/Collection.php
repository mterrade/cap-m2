<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Slider\Model\ResourceModel\Slide;

use Boxydev\Slider\Model\Slide;
use Boxydev\Slider\Model\ResourceModel\Slide as SlideResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';

    protected function _construct()
    {
        $this->_init(Slide::class, SlideResource::class);
    }

    protected function _initSelect()
    {
        parent::_initSelect();

        // $this->getSelect()->join();
    }
}
