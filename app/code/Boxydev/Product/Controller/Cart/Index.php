<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Product\Controller\Cart;

class Index extends \Magento\Checkout\Controller\Cart\Index
{
    public function execute()
    {
        $result = parent::execute();
        $result->getConfig()->getTitle()->set(__('Mon super panier'));

        return $result;
    }
}
