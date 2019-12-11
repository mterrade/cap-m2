<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Slider\Ui\Component\Listing\Columns;

use Magento\Catalog\Model\Category\FileInfo;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\DataObject;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\Component\Listing\Columns\Column;

class Thumbnail extends Column
{
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var UrlInterface
     */
    private $urlBuilder;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        StoreManagerInterface $storeManager,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->storeManager = $storeManager;
        $this->urlBuilder = $urlBuilder;
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');

            foreach ($dataSource['data']['items'] as &$item) {
                $slide = new DataObject($item); // DTO convert an array in object and "vice versa"
                $fileName = $slide->getImage();
                $filePath = 'pub/media/boxydev/slide/' . $fileName;

                /** @var FileInfo $fileInfo */
                $fileInfo = ObjectManager::getInstance()->get(FileInfo::class);

                if ($fileName && $fileInfo->isExist($filePath)) {
                    $item[$fieldName . '_alt'] = $fileName;
                    $item[$fieldName . '_src'] = $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) . 'boxydev/slide/' . $fileName;
                    $item[$fieldName . '_orig_src'] = $item[$fieldName . '_src'];
                    $item[$fieldName . '_link'] = $this->urlBuilder->getUrl('boxydev/slide/edit', ['id' => $slide->getId()]);
                }
            }
        }

        return $dataSource;
    }
}
