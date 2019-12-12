<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Checkout\Model;

use Magento\Catalog\Helper\Image as MagentoImage;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ResourceModel\Product\Collection;
use Magento\Checkout\Model\ConfigProviderInterface;

class DefaultConfigProvider implements ConfigProviderInterface
{
    /**
     * @var Collection
     */
    protected $productCollection;

    /**
     * @var MagentoImage
     */
    protected $imageHelper;

    public function __construct(
        Collection $productCollection,
        MagentoImage $imageHelper
    ) {
        $this->productCollection = $productCollection;
        $this->imageHelper = $imageHelper;
    }

    public function getConfig()
    {
        $products = $this->productCollection
            ->addAttributeToSelect('name')
            ->addAttributeToSelect('price')
            ->addAttributeToSelect('thumbnail')
            ->setPage(1, 10);
        $crossProducts = [];

        /** @var Product $product */
        foreach ($products as $product) {
            $crossProducts[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'price' => $product->getFinalPrice(),
                'thumbnail' => $this->imageHelper
                    ->init($product, 'product_thumbnail_image')
                    ->setImageFile($product->getThumbnail())
                    ->getUrl()
            ];
        }

        return ['crossProducts' => $crossProducts];
    }
}
