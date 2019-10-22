<?php
namespace Magenest\Movie\Observer;

use Magento\Framework\Event\ObserverInterface;

class ChangeCustomerFirstName implements ObserverInterface
{
    const CUSTOMER_FIRST_NAME = "Magenest";
    protected $_logger;
    protected $_customerRepositoryInterface;

    public function __construct(
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->_customerRepositoryInterface = $customerRepositoryInterface;
        $this->_logger=$logger;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $customer = $observer->getCustomer();

        if ($customer->getFirstname() != self::CUSTOMER_FIRST_NAME) {
            $customer->setFirstname(self::CUSTOMER_FIRST_NAME);
            $this->_customerRepositoryInterface->save($customer);
        }

    }
}