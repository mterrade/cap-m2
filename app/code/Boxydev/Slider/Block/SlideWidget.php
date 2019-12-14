<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Slider\Block;

use Magento\Widget\Block\BlockInterface;

class SlideWidget extends SlideList implements BlockInterface
{
    protected $_template = 'widget/slide.phtml';

    public function getSlides()
    {
        $collection = parent::getSlides();

        if (null !== $this->getData('slides')) {
            $collection->setPageSize($this->getData('slides'));
        }

        return $collection;
    }
}
