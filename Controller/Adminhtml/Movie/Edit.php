<?php
namespace Magenest\Movie\Controller\Adminhtml\Movie;
use Magento\Backend\App\Action;
use Magenest\Movie\Model\Movie as Movie;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * Edit A Contact Page
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();

        $movieDatas = $this->getRequest()->getParam('movie');

        if(is_array($movieDatas)) {
            $contact = $this->_objectManager->create(Movie::class);
            $contact->setData($movieDatas);
            $contact->setData($movieDatas)->save();
            //$this->_eventManager->dispatch('change_rating_movie', ['movie' => $contact]);
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index');
        }
    }
}