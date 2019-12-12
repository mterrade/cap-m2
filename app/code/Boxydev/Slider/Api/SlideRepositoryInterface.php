<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Slider\Api;

use Boxydev\Slider\Api\Data\SlideInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface SlideRepositoryInterface
{
    /**
     * @param \Boxydev\Slider\Api\Data\SlideInterface $slide
     * @return \Boxydev\Slider\Api\Data\SlideInterface
     */
    public function save(SlideInterface $slide);

    /**
     * @param int $id
     * @return \Boxydev\Slider\Api\Data\SlideInterface
     */
    public function getById($id);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface
     * @return \Boxydev\Slider\Api\Data\SlideSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria);

    /**
     * @param \Boxydev\Slider\Api\Data\SlideInterface $slide
     * @return void
     */
    public function delete(SlideInterface $slide);

    /**
     * @param int $id
     * @return void
     */
    public function deleteById($id);
}
