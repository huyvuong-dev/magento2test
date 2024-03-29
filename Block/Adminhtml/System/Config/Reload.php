<?php
namespace Magenest\Movie\Block\Adminhtml\System\Config;

class Reload extends \Magento\Config\Block\System\Config\Form\Field
{
    protected $_template = 'Magenest_Movie::system/config/reload.phtml';
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        return parent::render($element);
    }
    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        return $this->_toHtml();
    }

    public function getButtonHtml()
    {
        $button = $this->getLayout()->createBlock(
            'Magento\Backend\Block\Widget\Button'
        )->setData(
            [
                'id' => 'button',
                'label' => __('Reload'),
            ]
        );

        return $button->toHtml();
    }
}