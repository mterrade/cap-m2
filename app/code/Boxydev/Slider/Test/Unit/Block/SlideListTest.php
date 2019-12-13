<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Slider\Test\Unit\Block;

use Boxydev\Slider\Block\SlideList;
use Boxydev\Slider\Model\ResourceModel\Slide\Collection;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Magento\Framework\View\Element\BlockInterface;
use PHPUnit\Framework\TestCase;

class SlideListTest extends TestCase
{
    /**
     * @var SlideList
     */
    protected $_block;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfigMock;

    protected function setUp()
    {
        $collectionMock = $this->getMockBuilder(Collection::class)
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $this->scopeConfigMock = $this->createMock(ScopeConfigInterface::class);

        $this->_block = (new ObjectManager($this))->getObject(SlideList::class, [
            'collection' => $collectionMock,
            'scopeConfig' => $this->scopeConfigMock
        ]);
    }

    public function testSlideListIsABlock()
    {
        $this->assertInstanceOf(BlockInterface::class, $this->_block);
    }

    /**
     * @dataProvider configs
     */
    public function testSlideListCollectionHasAPageSize($expected)
    {
        $this->scopeConfigMock->method('getValue')
            ->with('slides/slides/number')
            ->willReturn($expected);
        $this->assertSame($expected, $this->_block->getSlides()->getPageSize());
    }

    public function configs()
    {
        return [
            [5],
            [15]
        ];
    }
}
