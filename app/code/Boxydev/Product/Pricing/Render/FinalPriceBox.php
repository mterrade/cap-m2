<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Product\Pricing\Render;

use Magento\Catalog\Model\Product\Pricing\Renderer\SalableResolverInterface;
use Magento\Catalog\Pricing\Price\MinimalPriceCalculatorInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Pricing\Price\PriceInterface;
use Magento\Framework\Pricing\Render\RendererPool;
use Magento\Framework\Pricing\SaleableInterface;
use Magento\Framework\View\Element\Template\Context;

class FinalPriceBox extends \Magento\Catalog\Pricing\Render\FinalPriceBox
{
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    public function __construct(
        Context $context,
        SaleableInterface $saleableItem,
        PriceInterface $price,
        RendererPool $rendererPool,
        ScopeConfigInterface $scopeConfig,
        array $data = [],
        SalableResolverInterface $salableResolver = null,
        MinimalPriceCalculatorInterface $minimalPriceCalculator = null
    ) {
        parent::__construct($context, $saleableItem, $price, $rendererPool, $data, $salableResolver, $minimalPriceCalculator);
        $this->scopeConfig = $scopeConfig;
    }

    protected function wrapResult($html)
    {
        dump((int) $this->scopeConfig->getValue('products/product/display_price'));
        if (1 === (int) $this->scopeConfig->getValue('products/product/display_price')) {
            return parent::wrapResult($html);
        }

        return '';
    }
}
