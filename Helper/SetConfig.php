<?php
namespace Magenest\Movie\Helper;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Config\ScopeConfigInterface;
/**
 *  @var \Magento\Framework\App\Config\Storage\WriterInterface
 */
class SetConfig extends AbstractHelper
{
    protected $configWriter;

    /**
     *
     * @param \Magento\Framework\App\Config\Storage\WriterInterface $configWriter
     */
    public function __construct(\Magento\Framework\App\Config\Storage\WriterInterface $configWriter)
    {
        $this->configWriter = $configWriter;
    }

    public function setConfig($code,$value,$scopeId = null){
        $this->configWriter->save('movie/moviepage/'.$code,  $value, $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeId);
    }
}