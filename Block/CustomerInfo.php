<?php
namespace Magenest\Movie\Block;

class CustomerInfo extends \Magento\Framework\View\Element\Template
{
    private $_info;
    private $_customer;
    private $_customerSession;
    private $_address;
    private $_customerInterface;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Block\Account\Dashboard\Info $info,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Customer\Api\AddressRepositoryInterface $address,
        \Magento\Customer\Api\Data\CustomerInterface $customerInterface,
        array $data = []
    ) {
        $this->_customerInterface = $customerInterface;
        $this->_address = $address;
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
        $getPhone = '';
        $id = $this->_customerSession->getCustomer()->getId();
        $customerId = $this->_customer->getById($id);

        $address = $customerId->getDefaultBilling();
        if (!isset($address)){
            $getPhone = 'not found';
        }else{
            $getPhone = $billingAddress = $this->_address->getById($address)->getTelephone();
        }
        return $getPhone;
    }

    public function getImage(){
        $a=$this->_customerInterface->getAddresses();
        $getImg = '';
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $mediaUrl = $objectManager->get('Magento\Store\Model\StoreManagerInterface')
            ->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $id = $this->_customerSession->getCustomer()->getId();
        $src = $this->_customer->getById($id)->getCustomAttribute('customer_image');
        if (!isset($src)){
            $src = $this->_customer->getById($id)->setCustomAttribute('customer_image','/index.png');
            $getImg = $src->getCustomAttribute('customer_image')->getValue();
        }else{
            $getImg = $src->getValue();
        }

        $img = $mediaUrl.'customer'.$getImg;
        return $img;
    }

}