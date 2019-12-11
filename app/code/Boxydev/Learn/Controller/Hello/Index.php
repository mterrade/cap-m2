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
use Magento\Framework\Controller\Result\RawFactory;

class Index extends Action
{
    /**
     * @var RawFactory
     */
    private $rawFactory;

    public function __construct(Context $context, RawFactory $rawFactory)
    {
        parent::__construct($context);
        $this->rawFactory = $rawFactory;
    }

    public function execute()
    {
        $raw = $this->rawFactory->create();
        // $raw->setHeader('Content-Type', 'text/css');
        $raw->setContents('<h1>Hello World</h1>');

        return $raw;
    }
}
