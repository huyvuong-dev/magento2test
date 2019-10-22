<?php
namespace Magenest\Movie\Block;

class CustomerInfo extends \Magento\Framework\View\Element\Template
{
    private $_info;
    private $_customer;
    private $_customerSession;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Block\Account\Dashboard\Info $info,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface,
        \Magento\Customer\Model\Session $customerSession,
        array $data = []
    ) {
        $this->_info = $info;
        $this->_customer = $customerRepositoryInterface;
        $this->_customerSession = $customerSession;
        parent::__construct(
            $context,
            $data
        );
    }

    public function getName()
    {
        return $this->_info->getName();
    }

    public function getEmail()
    {
        return $this->_info->getCustomer()->getEmail();
    }

    public function getPhone()
    {
        return $this->_customerSession->getCustomer()->getPrimaryBillingAddress()->getTelephone();
    }

    public function getImage(){
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $mediaUrl = $objectManager->get('Magento\Store\Model\StoreManagerInterface')
            ->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $id = $this->_customerSession->getCustomer()->getId();
        $src = $this->_customer->getById($id)->getCustomAttribute('customer_image')->getValue();
        $img = $mediaUrl.'customer'.$src;
        return $img;
    }

    public function checkPhone(){
        if ($this->_customerSession->getCustomer()->getPrimaryBillingAddress()->getTelephone() != ''){
            return true;
        }
        return false;
    }
}