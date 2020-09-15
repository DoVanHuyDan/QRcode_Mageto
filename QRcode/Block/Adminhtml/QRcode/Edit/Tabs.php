<?php

namespace Simicart\QRcode\Block\Adminhtml\QRcode\Edit;

/**
 * Class Tabs
 * @package Magestore\Multivendor\Block\Adminhtml\Vendor\Edit
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{


    /**
     *
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('qrcode_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('QRcode Information'));
    }


    /**
     * @return $this
     * @throws \Exception
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'qrcode_form',
            [
                'label' => __('General'),
                'title' => __('General'),
                'content' => $this->getLayout()->createBlock('Simicart\QRcode\Block\Adminhtml\QRcode\Edit\Tab\Form')
                ->toHtml(),
                'active' => true
            ]
        );

        // neu id k ton tai ==> adnew ==> add product tab
     //    $id = $this->getRequest()->getParam('id');
     //    if (!$id)
     //    {
     //     $this->addTab(
     //        'product_section',
     //        [
     //            'label' => __('Product List'),
     //            'title' => __('Product List'),
     //            'class' => 'ajax',
     //            'url' => $this->getUrl('*/*/product', array('_current' => true, 'id' => $this->getRequest()->getParam('id')))
     //        ]
     //    );


     // }
     
        $id = $this->getRequest()->getParam('id');
        $actionName = $this->_request->getFullActionName();
        // echo $actionName;
        // echo isset($id);

        // die();
        if($actionName == 'simicartadmin_qrcode_edit' && isset($id) != 1 )
        {
         $this->addTab(
            'product_section',
            [
                'label' => __('Product List'),
                'title' => __('Product List'),
                'class' => 'ajax',
                'url' => $this->getUrl('*/*/product', array('_current' => true, 'id' => $this->getRequest()->getParam('id')))
            ]
        );
     }



     return parent::_beforeToHtml();
 }

}