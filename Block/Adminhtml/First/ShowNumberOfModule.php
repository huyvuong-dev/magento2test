<?php
namespace Magenest\Movie\Block\Adminhtml\First;

class ShowNumberOfModule extends \Magento\Framework\View\Element\Template
{
    private $_resource;
    protected $fullModuleList;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\ResourceConnection $resource,
        \Magento\Framework\Module\FullModuleList $fullModuleList,
        array $data = []
    ) {
        $this->_resource = $resource;
        $this->fullModuleList = $fullModuleList;
        parent::__construct(
            $context,
            $data
        );
    }

    public function getNumberOfModule(){
        $arr = array();
        $allModules = $this->fullModuleList->getNames();
        foreach ($allModules as $value){
            $sub = substr($value,0,7);
            if ($sub == 'Magento'){
                $arr[] = $value;
            }
        }
        return $arr;
    }

    public function getNumberOfModuleAnother(){
        $arr = array();
        $allModules = $this->fullModuleList->getNames();
        foreach ($allModules as $value){
            $sub = substr($value,0,7);
            if ($sub != 'Magento'){
                $arr[] = $value;
            }
        }
        return $arr;
    }
}