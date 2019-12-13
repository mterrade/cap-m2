<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\CustomerJob\Setup;

use Magento\Customer\Model\Customer;
use Magento\Customer\Model\ResourceModel\Attribute;
use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    /**
     * @var EavSetup
     */
    private $eavSetup;

    /**
     * @var Config
     */
    private $eavConfig;

    /**
     * @var Attribute
     */
    private $attributeResource;

    public function __construct(EavSetup $eavSetup, Config $eavConfig, Attribute $attributeResource)
    {
        $this->eavSetup = $eavSetup;
        $this->eavConfig = $eavConfig;
        $this->attributeResource = $attributeResource;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $this->eavSetup->addAttribute(
            Customer::ENTITY,
            'job',
            [
                'label' => 'Job',
                'input' => 'select',
                'source' => \Boxydev\CustomerJob\Model\Attribute\Source\Job::class,
                'visible' => true,
                'required' => false,
                'position' => 150,
                'user_defined' => true,
                'system' => false
            ]
        );

        $attribute = $this->eavConfig->getAttribute(Customer::ENTITY, 'job');
        $attribute->setData('used_in_forms', [
            'adminhtml_customer', 'customer_account_create', 'customer_account_edit', 'checkout_register'
        ]);
        $attribute->addData([
            'attribute_set_id' => 1,
            'attribute_group_id' => 1
        ]);

        $this->attributeResource->save($attribute);

        $setup->endSetup();
    }
}
