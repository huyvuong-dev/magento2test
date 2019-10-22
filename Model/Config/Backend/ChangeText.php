<?php
namespace Magenest\Movie\Model\Config\Backend;

class ChangeText extends \Magento\Framework\App\Config\Value
{
    // data not save into database
    public function _afterLoad()
    {
        if($this->getValue() == 'Ping'){
            $this->setValue('Pong');
        }
    }
    //data save into database
//    public function beforeSave()
//    {
//        if($this->getValue() == 'Ping'){
//            $this->setValue('Pong');
//        }
//    }
}