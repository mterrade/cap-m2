<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Slider\Model\Slide;

use Boxydev\Slider\Model\ResourceModel\Slide\Collection;
use Magento\Catalog\Model\Category\FileInfo;
use Magento\Framework\App\ObjectManager;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    protected $loadedData = [];
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        Collection $collection,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collection;
        $this->storeManager = $storeManager;
    }

    public function getData()
    {
        $items = $this->collection->getItems();

        foreach ($items as $slide) {
            $slideData = $slide->getData();

            /** @var FileInfo $fileInfo */
            $fileInfo = ObjectManager::getInstance()->get(FileInfo::class);
            $fileName = $slideData['image'];
            $slideData['image'] = [];
            $filePath = 'pub/media/boxydev/slide/' . $fileName;

            if ($fileInfo->isExist($filePath)) {
                $slideData['image'][0]['name'] = $fileName;
                $slideData['image'][0]['url'] = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'boxydev/slide/' . $fileName;
                $slideData['image'][0]['size'] = $fileInfo->getStat($filePath)['size'];
            }

            $this->loadedData[$slide->getId()] = $slideData;
        }

        return $this->loadedData;
    }
}
