<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Contact\Model\Contact;

use Magento\Framework\Data\OptionSourceInterface;

class Civility implements OptionSourceInterface
{
    public function toOptionArray()
    {
        return [
            ['label' => 'Mme', 'value' => 0],
            ['label' => 'Mr', 'value' => 1]
        ];
    }
}
