<?php
namespace Magenest\Movie\Block\Adminhtml\Second;

class NumberOfEntity extends \Magento\Framework\View\Element\Template
{
    protected $_productCollectionFactory;
    protected $_customerFactory;
    protected $_orderFactory;
    protected $_invoiceFactory;
    protected $_creditMemoFactory;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderFactory,
        \Magento\Sales\Model\ResourceModel\Order\Invoice\CollectionFactory $invoiceFactory,
        \Magento\Sales\Model\ResourceModel\Order\Creditmemo\CollectionFactory $creditMemoFactory,
        array $data = []
    ) {
        $this->_creditMemoFactory = $creditMemoFactory;
        $this->_invoiceFactory = $invoiceFactory;
        $this->_orderFactory = $orderFactory;
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_customerFactory = $customerFactory;
        parent::__construct(
            $context,
            $data
        );
    }

    public function getProductCollection()
    {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');

        return $collection;
    }

    public function getCustomerCollection()
    {
        $collection = $this->_customerFactory->create()
            ->getCollection()
            ->addAttributeToSelect("*");

        return $collection;
    }

    public function getNumbersOfOrder(){
        $order  = $this->_orderFactory->create()->count();
        return $order;
    }

    public function getNumbersOfInvoice(){
        $invoice  = $this->_invoiceFactory->create()->count();
        return $invoice;
    }

    public function getNumbersOfCreditMemo(){
        $credit  = $this->_creditMemoFactory->create()->count();
        return $credit;
    }
}