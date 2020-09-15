<?php
namespace Simicart\QRcode\Block\Adminhtml\QRcode\View;

class View extends \Magento\Framework\View\Element\Template
{	
	
	protected $request;
	protected $QRcode;
	protected $objectmanager;

	public function __construct(
		\Magento\Backend\Block\Template\Context $context,
		\Magento\Framework\App\RequestInterface $request,
		\Magento\Framework\ObjectManagerInterface $objectmanager

	) {
		parent::__construct($context);
		$this->request = $request;
		$this->objectmanager = $objectmanager;
	}

	public function getQRcode()
	{
		$id = $this->request->getParam('id');
		$qrcode_model = $this->objectmanager->create('Simicart\QRcode\Model\QRcode')->load($id);
		return $qrcode_model;
	}

}	