<?php
namespace Simicart\QRcode\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class QRcodeActions extends Column
{   


    /** @var UrlInterface */
    protected $urlBuilder;

    /**
     * @var string
     */
    private $editUrl;
    private $deleteUrl;
    private $viewUrl;
  
    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     * @param string $editUrl
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->editUrl = $data['QRcodeUrlPathEdit'];
        $this->deleteUrl = $data['QRcodeUrlPathDelete'];
        $this->viewUrl = $data['QRcodeUrlPathView'];
     

        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    { 

        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $name = $this->getData('name');
                if (isset($item['qrcode_id'])) {
                    $item[$name]['edit'] = [
                        'href' => $this->urlBuilder->getUrl($this->editUrl, ['id' => $item['qrcode_id']]),
                        'label' => __('Edit')
                    ];
                    $item[$name]['delete'] = [
                        'href' => $this->urlBuilder->getUrl($this->deleteUrl, ['id' => $item['qrcode_id']]),
                        'label' => __('Delete')
                    ];
                     $item[$name]['view'] = [
                        'href' => $this->urlBuilder->getUrl($this->viewUrl, ['id' => $item['qrcode_id']]),
                        'label' => __('View')
                    ];
                   
                }
            }
        }
       
        return $dataSource;
    }
}