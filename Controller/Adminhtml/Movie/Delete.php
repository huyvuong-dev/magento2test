<?php
namespace Magenest\Movie\Controller\Adminhtml\Movie;
use Magenest\Movie\Model\Movie as Movie;
use Magento\Backend\App\Action;

class Delete extends \Magento\Backend\App\Action
{
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        if (!($contact = $this->_objectManager->create(Movie::class)->load($id))) {
            $this->messageManager->addErrorMessage(__('Unable to proceed. Please, try again.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }
        try {
            $contact->delete();
            $this->messageManager->addSuccessMessage(__('Your contact has been deleted !'));
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage(__('Error while trying to delete contact: '));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }


        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index', array('_current' => true));
    }
}

