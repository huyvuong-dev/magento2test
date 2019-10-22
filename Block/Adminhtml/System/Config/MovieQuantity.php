<?php
namespace Magenest\Movie\Block\Adminhtml\System\Config;

class MovieQuantity extends \Magento\Config\Block\System\Config\Form\Field
{
    protected $_template = 'Magenest_Movie::system/config/moviequantity.phtml';
    protected $_movie;
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magenest\Movie\Model\ResourceModel\Movie\CollectionFactory $movie,
        array $data = []
    ) {
        $this->_movie = $movie;
        parent::__construct($context, $data);
    }

    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        return $this->_toHtml();
    }

    public function getCountNumberOfRows(){
        $collection = $this->_movie->create()->count();
        return $collection;
    }
}