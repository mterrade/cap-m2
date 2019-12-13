<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\CustomerJob\Model\Attribute\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Job extends AbstractSource
{
    public function getAllOptions()
    {
        return [
            ['label' => 'Développeur', 'value' => 'Développeur'],
            ['label' => 'Développeur web', 'value' => 'Développeur web']
        ];
    }
}
