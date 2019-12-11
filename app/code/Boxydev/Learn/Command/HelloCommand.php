<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Learn\Command;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ResourceModel\Product\Collection;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\Event\Manager;
use Magento\Framework\ObjectManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HelloCommand extends Command
{
    /**
     * @var Manager
     */
    private $eventManager;
    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    public function __construct(
        Manager $eventManager,
        ObjectManagerInterface $objectManager,
        CollectionFactory $collectionFactory,
        string $name = null
    ) {
        parent::__construct($name);
        $this->eventManager = $eventManager;
        $this->objectManager = $objectManager;
        $this->collectionFactory = $collectionFactory;
    }

    protected function configure()
    {
        $this
            ->setName('boxydev:hello')
            ->setDescription('A command...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var Product $product */
        $product = $this->objectManager->create(Product::class);
        /** @var Collection $productCollection */
        $productCollection = $this->collectionFactory->create();
        $productCollection
            ->addAttributeToSelect(['name', 'price'])
            ->joinField('quantity', 'cataloginventory_stock_item', 'qty', 'product_id = entity_id')
            ->setPageSize(5)
            ->setCurPage(1)
            ->load();

        $productCollection->getSelect()->assemble();
        echo $productCollection->getSelect();

        $products = [];
        foreach ($productCollection->getItems() as $productItem) {
            $products[] = [
                $productItem->getSku(), $productItem->getName(),
                $productItem->getPrice(), $productItem->getQuantity()
            ];
        }

        $table = new Table($output);
        $table
            ->setHeaders(['SKU', 'name', 'price', 'quantity'])
            ->setRows($products);
        $table->render();

        $this->eventManager->dispatch('boxydev_hello_event', ['key' => 'value']);
        $output->writeln('Hello world');
    }
}
