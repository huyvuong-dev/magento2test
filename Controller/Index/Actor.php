<?php
namespace Magenest\Movie\Controller\Index;
class Actor extends \Magento\Framework\App\Action\Action {
    public function execute() {
        $director = $this->_objectManager->create('Magenest\Movie\Model\Actor');
        $director->setName('Emma Stone');
        $director->save();
        $this->getResponse()->setBody('success');
    }
}