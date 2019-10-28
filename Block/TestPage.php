<?php
namespace Magenest\Movie\Block;

use Magento\Framework\App\Config\ScopeConfigInterface;
class TestPage extends \Magento\Framework\View\Element\Template
{
    private $_customer;
    private $_customerSession;
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface,
        \Magento\Customer\Model\Session $customerSession,
        array $data = []
    ) {
        $this->_customer = $customerRepositoryInterface;
        $this->_customerSession = $customerSession;
        parent::__construct($context, $data);
    }

    /**
     * @param string $asset
     * @return string
     */
    //This function will be used to get the css/js file.
    function getAssetUrl($asset) {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $assetRepository = $objectManager->get('Magento\Framework\View\Asset\Repository');
        return $assetRepository->createAsset($asset)->getUrl();
    }

    public function getImage(){
        $getImg = 'images';
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $mediaUrl = $objectManager->get('Magento\Store\Model\StoreManagerInterface')
            ->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $img = $mediaUrl.$getImg;
        return $img;
    }
}