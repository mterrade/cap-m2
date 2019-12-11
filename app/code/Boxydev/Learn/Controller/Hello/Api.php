<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Learn\Controller\Hello;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;

class Api extends Action
{
    /**
     * @var JsonFactory
     */
    private $jsonFactory;

    public function __construct(Context $context, JsonFactory $jsonFactory)
    {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
    }

    public function execute()
    {
        $json = $this->jsonFactory->create();
        $json->setData(['message' => 'Hello World']);

        return $json;
    }
}
