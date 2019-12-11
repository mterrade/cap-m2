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
use Magento\Framework\View\Result\PageFactory;

class World extends Action
{
    /**
     * @var PageFactory
     */
    private $pageFactory;

    public function __construct(Context $context, PageFactory $pageFactory)
    {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
    }

    public function execute()
    {
        $page = $this->pageFactory->create();

        // Ajout du layout pour le router custom
        // $page->addHandle('boxydev_hello_world');
        // dump($page->getLayout()->getUpdate()->getHandles());

        return $page;
    }
}
