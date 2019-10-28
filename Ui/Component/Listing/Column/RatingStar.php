<?php

namespace Magenest\Movie\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Ui\Component\Listing\Columns\Column;

class RatingStar extends Column
{
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        $css = '<style>
                     .checked {
                          color: orange;
                     }
                 </style>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';
        $star='';
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$items) {
                // $items['instock'] is column value
                if ($items['rating'] == 1) {
                    $star = '
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star "></span>
                                  <span class="fa fa-star "></span>
                                  <span class="fa fa-star "></span>
                                  <span class="fa fa-star"></span>';
                } elseif ($items['rating'] == 2) {
                    $star = '
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star "></span>
                                  <span class="fa fa-star "></span>
                                  <span class="fa fa-star"></span>';
                } elseif ($items['rating'] == 3) {
                    $star = '
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star "></span>
                                  <span class="fa fa-star"></span>';
                } elseif ($items['rating'] == 4) {
                    $star = '
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star"></span>';
                } elseif ($items['rating'] == 5) {
                    $star = '
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>
                                  <span class="fa fa-star checked"></span>';

                }
                $items['rating'] = $css.$star;
            }
        }
        return $dataSource;
    }
}