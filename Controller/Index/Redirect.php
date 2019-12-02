<?php
namespace Magenest\Movie\Controller\Index;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
class Redirect extends \Magento\Framework\App\Action\Action
{
    private $resultPageFactory;
    /** @var \Magento\Framework\View\Result\PageddFactory
    protected $resultPageFactory;
     */
    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        $this->_redirect('movie');
    }
}