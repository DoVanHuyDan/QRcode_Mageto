<?php

namespace Simicart\QRcode\Block\Adminhtml\QRcode;

/**
 * Class Edit
 * @package Magestore\Multivendor\Block\Adminhtml\Vendor
 */
class Edit extends \Magento\Backend\Block\Widget\Form\Container
{

    /**
     * @var \Magento\Framework\Registry|null
     */
    protected $_coreRegistry = null;


    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     *
     */
    protected function _construct()
    {
        $this->_objectId = 'id';
        $this->_blockGroup = 'Simicart_QRcode';
        $this->_controller = 'adminhtml_QRcode';

        parent::_construct();

        $this->buttonList->update('save', 'label', __('Save'));
        $this->buttonList->update('delete', 'label', __('Delete'));
        

    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('current_qrcode')->getId()) {
            return __("Edit QRcode '%1'", $this->escapeHtml($this->_coreRegistry->registry('current_qrcode')->getData('display_name')));
        } else {
            return __('New QRcode');
        }
    }
}