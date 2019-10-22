<?php
namespace Magenest\Movie\Controller\Adminhtml\Director;

class Index extends \Magento\Framework\App\Action\Action
{
    /** @var \Magento\Framework\View\Result\PageFactory
    protected $resultPageFactory;
     */
    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Magenest_Movie::director');
        $resultPage->getConfig()->getTitle()->prepend(__('Director'));
        return $resultPage;
    }
    protected function _isAllowed(){
        return $this->_authorization->isAllowed('Magenest_Movie::director');
    }
}