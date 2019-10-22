<?php

namespace Magenest\Movie\Controller\Index;

class Config extends \Magento\Framework\App\Action\Action
{
    protected $helperGetData;
    protected $helperSetData;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magenest\Movie\Helper\GetConfig $helperGetData,
        \Magenest\Movie\Helper\SetConfig $helperSetData
    )
    {
        $this->helperGetData = $helperGetData;
        $this->helperSetData = $helperSetData;
        return parent::__construct($context);
    }

    public function execute()
    {
        echo $this->helperGetData->getGeneralConfig('text_field');
        if ($this->helperGetData->getGeneralConfig('text_field') == "Ping"){
            $this->helperSetData->setConfig('text_field','Pong');
            echo $this->helperGetData->getGeneralConfig('text_field');
        }
        exit();

    }
}
