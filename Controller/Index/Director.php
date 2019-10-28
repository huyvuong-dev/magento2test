<?php
namespace Magenest\Movie\Controller\Index;
use Magento\Framework\Controller\ResultFactory;
class Director extends \Magento\Framework\App\Action\Action {
    public function execute() {
        try{
            $director = $this->_objectManager->create('Magenest\Movie\Model\Director');
            $director->setName('Cena');
            $director->save();
            $this->getResponse()->setBody('success');
        }catch (\Exception $e){
            $this->messageManager->addErrorMessage($e->getMessage());
            // redirect previous page
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

            // Your code

            $resultRedirect->setUrl($this->_redirect->getRefererUrl());
            return $resultRedirect;
        }

    }
}