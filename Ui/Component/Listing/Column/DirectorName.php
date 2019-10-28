<?php
namespace Magenest\Movie\Ui\Component\Listing\Column;

use \Magento\Sales\Api\OrderRepositoryInterface;
use \Magento\Framework\View\Element\UiComponent\ContextInterface;
use \Magento\Framework\View\Element\UiComponentFactory;
use \Magento\Ui\Component\Listing\Columns\Column;
use \Magento\Framework\Api\SearchCriteriaBuilder;
use \Magenest\Movie\Model\ResourceModel\Director\CollectionFactory;

class DirectorName extends Column
{
    protected $_orderRepository;
    protected $_searchCriteria;
    protected $_sessionQuote;
    protected $_directorFactory;

    public function __construct(CollectionFactory $directorFactory,ContextInterface $context, UiComponentFactory $uiComponentFactory, OrderRepositoryInterface $orderRepository, SearchCriteriaBuilder $criteria, array $components = [], array $data = [])
    {
        $this->_directorFactory = $directorFactory;
        $this->_orderRepository = $orderRepository;
        $this->_searchCriteria  = $criteria;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }


    public function prepareDataSource(array $dataSource)
    {
        $director = $this->_directorFactory->create();
        $id = $director->getData('director_id');
        $count = $director->count();

        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                for ($i = 0 ; $i < $count ; $i++){
                    if ($item['director_id'] == $id[$i]['director_id']){
                        $item['director_id'] = $id[$i]['name'];
                        break;
                    }
                }


            }
        }

        return $dataSource;
    }



}