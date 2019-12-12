<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Slider\Model;

use Boxydev\Slider\Api\Data\SlideInterface;
use Magento\Framework\Model\AbstractModel;
use Boxydev\Slider\Model\ResourceModel\Slide as SlideResource;

class Slide extends AbstractModel implements SlideInterface
{
    protected function _construct()
    {
        $this->_init(SlideResource::class);
    }

    public function getId()
    {
        return $this->_getData('id');
    }

    public function setId($id)
    {
        $this->setData('id', $id);
    }

    public function getName()
    {
        return $this->_getData('name');
    }

    public function setName($name)
    {
        $this->setData('name', $name);
    }

    public function getImage()
    {
        return $this->_getData('image');
    }

    public function setImage($image)
    {
        return $this->setData('image', $image);
    }
}
