<?php

namespace Simicart\QRcode\Controller\Adminhtml\QRcode;

class ProductListTest extends \Magento\Backend\App\Action
{
	protected $resultPageFactory = false;
	protected $productCollectionFactory;
	protected $productVisibility;

	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory,
		\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Model\Product\Visibility $productVisibility
	)
	{
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
		$this->productVisibility = $productVisibility;
		$this->productCollectionFactory = $productCollectionFactory;
	}

	public function execute()
	{
		
		die("Dan");
		echo "<pre>";
		var_dump($productCollectionFactory.getData());
		
		
		return $resultPage;
	}


}