<?php
namespace Magenest\Movie\Controller\Adminhtml\Second;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
class Index extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;
    public function __construct(Context $context, PageFactory $resultPageFactory) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Magenest_Movie::2nd');
        $resultPage->getConfig()->getTitle()->prepend(__('2nd content'));
        return $resultPage;
    }
    protected function _isAllowed(){
        return $this->_authorization->isAllowed('Magenest_Movie::2nd');
    }
}
