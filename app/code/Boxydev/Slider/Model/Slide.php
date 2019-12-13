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
use Magento\Store\Model\StoreManagerInterface;

class Slide extends AbstractModel implements SlideInterface
{
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        StoreManagerInterface $storeManager,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
        $this->storeManager = $storeManager;
    }

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

    public function getImageUrl()
    {
        return $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'boxydev/slide/' . $this->getImage();
    }
}
