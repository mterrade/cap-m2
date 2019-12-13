<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Slider\Test\Unit\Model;

use Boxydev\Slider\Api\Data\SlideInterface;
use Boxydev\Slider\Model\Slide;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Magento\Framework\UrlInterface;
use Magento\Store\Api\Data\StoreInterface;
use Magento\Store\Model\StoreManagerInterface;
use PHPUnit\Framework\TestCase;

class SlideTest extends TestCase
{
    /**
     * @var Slide
     */
    protected $_model;

    protected function setUp()
    {
        $storeMock = $this->getMockBuilder(StoreInterface::class)
            ->setMethods(['getBaseUrl'])
            ->getMockForAbstractClass();
        $storeMock
            ->expects($this->once())
            ->method('getBaseUrl')
            ->with(UrlInterface::URL_TYPE_MEDIA)
            ->willReturn('http://localhost/media/');

        $storeManagerMock = $this->createMock(StoreManagerInterface::class);
        $storeManagerMock->method('getStore')->willReturn($storeMock);

        $this->_model = (new ObjectManager($this))->getObject(Slide::class, [
            'storeManager' => $storeManagerMock
        ]);
    }

    public function testSlideIsInstanceOfModel()
    {
        $this->assertInstanceOf(AbstractModel::class, $this->_model);
        $this->assertInstanceOf(SlideInterface::class, $this->_model);
    }

    public function testSlideHasGettersSetters()
    {
        $this->assertNull($this->_model->getId());
        $this->_model->setId(5);
        $this->assertSame(5, $this->_model->getId());
    }

    /**
     * @dataProvider slides
     */
    public function testSlideHasAnImageUrl($image, $url)
    {
        $this->_model->setImage($image);
        $this->assertSame($url, $this->_model->getImageUrl());
    }

    public function slides()
    {
        return [
            ['toto.jpg', 'http://localhost/media/boxydev/slide/toto.jpg'],
            ['titi.jpg', 'http://localhost/media/boxydev/slide/titi.jpg']
        ];
    }
}
