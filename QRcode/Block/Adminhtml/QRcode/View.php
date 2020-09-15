<?php

namespace Simicart\QRcode\Block\Adminhtml\QRcode;

/**
 * Class Edit
 * @package Magestore\Multivendor\Block\Adminhtml\Vendor
 */
class View extends \Magento\Backend\Block\Widget\Form\Container
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

   
    	$this->removeButton('save');
    	$this->removeButton('delete');
    	$this->removeButton('reset');
    }

    
}