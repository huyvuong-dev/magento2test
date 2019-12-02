<?php
namespace Magenest\Movie\Controller\Index;
class MovieActor extends \Magento\Framework\App\Action\Action {
    public function execute() {
        $movieactor = $this->_objectManager->create('Magenest\Movie\Model\MovieActor');
        $movieactor->setMovieId('11');
        $movieactor->setActorId('1');
        $movieactor->save();
        $this->getResponse()->setBody('success');
    }
}