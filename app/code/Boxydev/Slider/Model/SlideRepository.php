<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Slider\Model;

use Boxydev\Slider\Api\Data\SlideInterface;
use Boxydev\Slider\Api\Data\SlideSearchResultsInterfaceFactory;
use Boxydev\Slider\Api\SlideRepositoryInterface;
use Boxydev\Slider\Model\ResourceModel\Slide\Collection;
use Boxydev\Slider\Model\ResourceModel\Slide\CollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;

class SlideRepository implements SlideRepositoryInterface
{
    /**
     * @var ResourceModel\Slide
     */
    private $resource;

    /**
     * @var SlideFactory
     */
    private $slideFactory;

    /**
     * @var SlideSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @var CollectionFactory
     */
    private $slideCollectionFactory;

    public function __construct(
        \Boxydev\Slider\Model\ResourceModel\Slide $resource,
        SlideFactory $slideFactory,
        SlideSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionFactory $slideCollectionFactory
    ) {
        $this->resource = $resource;
        $this->slideFactory = $slideFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->slideCollectionFactory = $slideCollectionFactory;
    }

    public function save(SlideInterface $slide)
    {
        $this->resource->save($slide);

        return $slide;
    }

    public function getById($id)
    {
        $slide = $this->slideFactory->create();
        $this->resource->load($slide, $id);

        return $slide;
    }

    public function getList(SearchCriteriaInterface $criteria)
    {
        /** @var Collection $collection */
        $collection = $this->slideCollectionFactory->create();

        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                $collection->addFieldToFilter($filter->getField(), [$filter->getConditionType() => $filter->getValue()]);
            }
        }

        /** @var SortOrder $sortOrder */
        foreach ((array) $criteria->getSortOrders() as $sortOrder) {
            $collection->addOrder($sortOrder->getField(), $sortOrder->getDirection());
        }

        $collection->setPageSize($criteria->getPageSize());
        $collection->setCurPage($criteria->getCurrentPage());

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    public function delete(SlideInterface $slide)
    {
        $this->resource->delete($slide);
    }

    public function deleteById($id)
    {
        $this->delete($this->getById($id));
    }
}
