<?php
/**
 * A Magento 2 module named Ewall/HelpDesk
 * Copyright (C) 2017  Ewall Solutions Pvt Ltd
 *
 */
namespace Magenest\Movie\Model\Movie\Attribute\Source;
class Director implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var \Ewall\HelpDesk\Api\GroupRepositoryInterface
     */
    private $directorRepositoryInterface;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var \Magento\Framework\Convert\DataObject
     */
    private $objectConverter;

    private $_directorCollectionFactory;
    private $_director;
    /**
     * @param \Ewall\HelpDesk\Api\DepartmentRepositoryInterface $departmentRepositoryInterface
     * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
     * @param \Magento\Framework\Convert\DataObject $objectConverter
     * @param \Ewall\HelpDesk\Model\ResourceModel\Department\CollectionFactory $collectionFactory
     */
    public function __construct(
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Convert\DataObject $objectConverter,
        \Magenest\Movie\Model\Director $director
    )
    {
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->objectConverter = $objectConverter;
        $this->_director = $director;

    }

    public function toOptionArray($addEmpty = true)
    {
        /** @var \Magenest\Movie\Model\ResourceModel\Director\Collection $collection */
        $instance = \Magento\Framework\App\ObjectManager::getInstance();
        $director_collections = $instance->get('\Magenest\Movie\Model\ResourceModel\Director\CollectionFactory');
        $collections = $director_collections->create();
        //$collections = $this->_director->getCollection();
        $options = [];
        if ($addEmpty) {
            $options[] = ['label' => __('-- Please Select a Director --'), 'value' => ''];
        }
        foreach ($collections as $director) {
            $options[] = ['label' => $director->getName(), 'value' => $director->getDirectorId()];
        }
        return $options;
    }
}