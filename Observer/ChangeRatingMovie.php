<?php
namespace Magenest\Movie\Observer;
class ChangeRatingMovie implements \Magento\Framework\Event\ObserverInterface
{
    private $layout;

    public function __construct(
        \Magento\Framework\View\Layout $layout
    ) {
        $this->layout = $layout;
    }
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $movie = $observer->getData('movie');
        $movie->setData('rating',0);
        $movie->save();
    }
}
