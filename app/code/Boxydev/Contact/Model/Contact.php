<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Contact\Model;

use Magento\Framework\Model\AbstractModel;
use Boxydev\Contact\Model\ResourceModel\Contact as ContactResource;

class Contact extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ContactResource::class);
    }
}
