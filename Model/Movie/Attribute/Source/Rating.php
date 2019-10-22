<?php
namespace Magenest\Movie\Model\Movie\Attribute\Source;

class Rating implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Retrieve options array.
     *
     * @return array
     */
    public function toOptionArray($addEmpty = true)
    {
        $result = [];
        if ($addEmpty) {
            $result[] = ['label' => __('-- Please Select a Rating --'), 'value' => ''];
        }
        foreach (self::getOptionArray() as $index => $value) {
            $result[] = ['value' => $index, 'label' => $value];
        }

        return $result;
    }

    /**
     * Retrieve option array
     *
     * @return string[]
     */
    public static function getOptionArray()
    {
        return [1 => __('1'),
            2 => __('2'),
            3 => __('3'),
            4 => __('4'),
            5 => __('5'),
            6 => __('6'),
            7 => __('7'),
            8 => __('8'),
            9 => __('9'),
            10 => __('10')
            ];
    }

    /**
     * Retrieve option array with empty value
     *
     * @return string[]
     */
    public function getAllOptions()
    {
        $result = [];

        foreach (self::getOptionArray() as $index => $value) {
            $result[] = ['value' => $index, 'label' => $value];
        }

        return $result;
    }

    /**
     * Retrieve option text by option value
     *
     * @param string $optionId
     * @return string
     */
    public function getOptionText($optionId)
    {
        $options = self::getOptionArray();

        return isset($options[$optionId]) ? $options[$optionId] : null;
    }
}