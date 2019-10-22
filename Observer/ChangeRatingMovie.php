<?php
namespace Magenest\Movie\Observer;
class ChangeRatingMovie implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $movie = $observer->getData('movie');
        $movie->setData('rating',0);
        $movie->save();
    }
}
