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

use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '0.0.3') < 0) {
            $setup->getConnection()->addIndex(
                $setup->getTable('boxydev_slide'),
                $setup->getIdxName($setup->getTable('boxydev_slide'), ['name'], AdapterInterface::INDEX_TYPE_FULLTEXT),
                ['name'],
                AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }
    }
}
