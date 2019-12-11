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

use Boxydev\Slider\Model\Slide;
use Boxydev\Slider\Model\SlideFactory;
use Boxydev\Slider\Model\ResourceModel\SlideFactory as ResourceSlideFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var SlideFactory
     */
    private $slideFactory;

    /**
     * @var ResourceSlideFactory
     */
    private $resourceSlideFactory;

    public function __construct(SlideFactory $slideFactory, ResourceSlideFactory $resourceSlideFactory)
    {
        $this->slideFactory = $slideFactory;
        $this->resourceSlideFactory = $resourceSlideFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '0.0.2') < 0) {
            $resource = $this->resourceSlideFactory->create();

            for ($i = 1; $i <= 10; ++$i) {
                /** @var Slide $slide */
                $slide = $this->slideFactory->create()->setData([
                    'name' => 'slide-' . $i,
                    'image' => 'slide-' . $i . '.jpg',
                ]);

                $resource->save($slide);
            }
        }

        $setup->endSetup();
    }
}
