<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Product\Model;

class Product extends \Magento\Catalog\Model\Product
{
    public function getName()
    {
        return 'OVERRIDE ' . parent::getName();
    }
}
