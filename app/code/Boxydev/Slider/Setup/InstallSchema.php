<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Slider\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $table = $setup->getConnection()
            ->newTable($setup->getTable('boxydev_slide'))
            ->addColumn('id', Table::TYPE_INTEGER, null, ['identity' => true, 'nullable' => false, 'primary' => true])
            ->addColumn('name', Table::TYPE_TEXT, 255, ['nullable' => false])
            ->addColumn('image', Table::TYPE_TEXT, 255);

        $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }
}
