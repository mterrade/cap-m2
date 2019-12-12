<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Slider\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface SlideSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return \Boxydev\Slider\Api\Data\SlideInterface[]
     */
    public function getItems();

    /**
     * @param \Boxydev\Slider\Api\Data\SlideInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}
