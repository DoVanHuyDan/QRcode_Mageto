<?php
namespace Simicart\QRcode\Block\Adminhtml\QRcode\Edit\Tab;
/**
 * Class Form
 * @package Magestore\Multivendor\Block\Adminhtml\Vendor\Edit\Tab
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
implements \Magento\Backend\Block\Widget\Tab\TabInterface
{

    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;
    protected $productCollectionFactory;
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param array $data
     */
    public function __construct(
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        array $data = array()
    )
    {


        $this->productCollectionFactory = $productCollectionFactory;
        $this->_objectManager = $objectManager;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareLayout() {

        $this->getLayout()->getBlock('page.title')->setPageTitle($this->getPageTitle());

    }


    /**
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {   


        $model = $this->_coreRegistry->registry('current_qrcode');
        $qrcodeId = (int)$this->getRequest()->getParam('id');
        $products = $this->productCollectionFactory->create()->getData();
        $productSKU = array();
        foreach ($products as $product) {
            $productSKU[$product['sku']] = $product['sku'];
        }
        $form = $this->_formFactory->create();


        $form->setHtmlIdPrefix('page_');


        $actionName = $this->_request->getFullActionName();



        if($actionName == 'simicartadmin_qrcode_importnew')
        {   

         $fieldset = $form->addFieldset('base_fieldset', array('legend' => __('Import QRcode File')));


         $fieldset->addField('file', 'file', array(
          'label'     => __('Upload'),
          'value'  => 'Uploadd',
          'disabled' => false,
          'readonly' => true,
          'required' => true,
          'after_element_html' => '<small>Upload CSV file</small>',
          'tabindex' => 1,
          'name'=> 'file'
      ));
            //die("AS");
     }
     else
     {   

        $fieldset = $form->addFieldset('base_fieldset', array('legend' => __('QRcode Information')));

        if(empty($qrcodeId)) // nei k ton tai ID ==> addnew ==> show qrcode rule field
        {

            $fieldset->addField('qrcode_rule', 'text', array(
                'label'     => __('QR Code Rules'),
                'class'     => 'required-entry',
                'required'  => true,
                'name'      => 'qrcode_rule',
                'disabled' => false,
                ))->setAfterElementHtml('
            <div class="field-tooltip toggle">

            <span>Type rule here: xAyN (x number of letters, y number of numers)</span>

            </div>
            ');

            }





        if(!empty($qrcodeId)) // nei ton tai ID ==> edit ==> show QRcode field  
        {   
            $fieldset->addField('qrcode_id', 'hidden', array('name' => 'qrcode_id'));

            $fieldset->addField('qrcode', 'text', array(
                'label'     => __('QR Code'),
                'class'     => 'required-entry',
                'required'  => true,
                'name'      => 'qrcode',
                'disabled' => false

            ));

        }

    }




    $form->setValues($model->getData());
    $this->setForm($form);
    return parent::_prepareForm();
}

    /**
     * @return mixed
     */
    public function getQRcode() {
        return $this->_coreRegistry->registry('current_qrcode');
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getPageTitle() {
        return $this->getQRcode()->getData('qrcode_id') ? __("Edit QRcode %1",
            $this->escapeHtml($this->getQRcode()->getData('qrcode_id'))) : __('New QRcode');
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('QRcode Information');
    }


    /**
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('QRcode Information');
    }

    /**
     * @return bool
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isHidden()
    {
        return false;
    }


}