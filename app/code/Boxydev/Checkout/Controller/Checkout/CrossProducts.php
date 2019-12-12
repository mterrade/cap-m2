<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Checkout\Controller\Checkout;

use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Data\Form\FormKey;
use Magento\Framework\DataObject;

class CrossProducts extends Action
{
    /**
     * @var \Magento\Quote\Model\Quote
     */
    protected $quote;

    /**
     * @var FormKey
     */
    protected $formKey;

    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var \Magento\Quote\Api\CartRepositoryInterface
     */
    private $cartRepository;

    public function __construct(
        Context $context,
        \Magento\Checkout\Model\Session $session,
        \Magento\Quote\Api\CartRepositoryInterface $cartRepository,
        ProductRepository $productRepository,
        FormKey $formKey
    ) {
        parent::__construct($context);
        $this->quote = $session->getQuote();
        $this->cartRepository = $cartRepository;
        $this->formKey = $formKey;
        $this->productRepository = $productRepository;
    }

    public function execute()
    {
        $requestData = $this->getRequest()->getContent();
        $products = json_decode($requestData, true);

        $request = new DataObject([
            'form_key' => $this->formKey->getFormKey(),
            'qty' => 1
        ]);

        foreach ($products as $product) {
            $this->quote->addProduct($this->productRepository->getById((int) $product['value']), $request);
        }

        $this->cartRepository->save($this->quote);

        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData(['success' => 'ok']);
    }
}
