<?php
namespace Magenest\Movie\Controller\Index;
class Movie extends \Magento\Framework\App\Action\Action {
    public function execute() {
        $movie = $this->_objectManager->create('Magenest\Movie\Model\Movie');
        $movie->setName('Hai Phuong');
        $movie->setDescription('Hai Phuong Description');
        $movie->setRating('10');
        $movie->setDirectorId('9');
        $movie->save();
        $this->getResponse()->setBody('success');
    }
}