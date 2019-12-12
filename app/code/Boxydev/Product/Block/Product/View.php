<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Product\Block\Product;

class View extends \Magento\Catalog\Block\Product\View
{
    public function getProductDefaultQty($product = null)
    {
        return parent::getProductDefaultQty($product) * 3;
    }
}
