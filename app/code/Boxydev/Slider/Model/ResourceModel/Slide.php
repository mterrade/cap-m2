<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Slider\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Slide extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('boxydev_slide', 'id');
    }
}
