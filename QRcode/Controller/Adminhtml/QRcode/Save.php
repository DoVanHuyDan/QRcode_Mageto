<?php


namespace Simicart\QRcode\Controller\Adminhtml\QRcode;

class Save extends \Magento\Backend\App\Action
{
	protected $resultPageFactory = false;
	protected $collection;
	protected $productRepository;
	protected $csv;
	protected $moduleReader;
	protected $File;
	protected $Filesystem;
	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory, 
		\Simicart\QRcode\Model\ResourceModel\QRcode\Collection $collection,
		\Magento\Catalog\Model\ProductRepository $productRepository,
		\Magento\Framework\File\Csv $csv,
		\Magento\Framework\Module\Dir\Reader $moduleReader,
		\Magento\Framework\Filesystem\Driver\File $File,
		\Magento\Framework\Filesystem $Filesystem
	)
	{
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
		$this->collection = $collection;
		$this->productRepository = $productRepository;
		$this->csv = $csv;
		$this->moduleReader = $moduleReader;
		$this->File = $File;
		$this->Filesystem = $Filesystem;
	}



	function createQRcode($rule) // 2A3N
	{
		$alpha = $rule[0];
		$num = $rule[2];
		$QRcode ='';
		$existed = true;

		$allAlpha = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		while($existed == true)
		{
			$existed = false;
			for($i = 1; $i <= $alpha; $i++)
			{
				$QRcode = $QRcode . $allAlpha[rand(0,strlen($allAlpha)-1)];
			}

			for($i =1; $i<=$num; $i++ )
			{
				$QRcode = $QRcode . rand(0,9);
			}
			str_shuffle($QRcode);

			foreach($this->collection as $row)
			{
				if($row->getData('qrcode') == $QRcode)
				{
					$existed = true;
				}
				
			}
			
		}

		return $QRcode;

	}

	public function isValidQRcodeRule($rule)
	{
		$pattern = "/^(\dA\dN)/";
		return preg_match($pattern, $rule);
	}

	public function delete()
	{
		$fileName= "/csv.csv";
		$directory = $this->moduleReader->getModuleDir('etc', 'Simicart_QRcode'); 
		if ($this->File->isExists($directory . $fileName)) {
			$this->File->deleteFile($directory . $fileName);
		}

	}	


	public function execute()
	{	

		date_default_timezone_set('Asia/Ho_Chi_Minh');

		// get data from form
		$data = $this->getRequest()->getPostValue();


		$qrcodeId = $this->getRequest()->getParam('qrcode_id');

		$date = time();
		
		/** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
		$resultRedirect = $this->resultRedirectFactory->create();

		if (!empty($data)) {
			
			if(!empty($qrcodeId)){
				
			 // neu $qrcodeID ton tai => dang edit
				$qrcode_model = $this->_objectManager->create('Simicart\QRcode\Model\QRcode')->load($qrcodeId);

				$newQrcode = $data['qrcode'];
				$qrcode_model->setData('qrcode',$newQrcode);
				$qrcode_model->setData('updated_at',$date) ;
				$qrcode_model->save();	

			}
			else{ // add new 
				

				$qrcodeRule = $this->getRequest()->getParam('qrcode_rule');
				if($this->isValidQRcodeRule($qrcodeRule) == 0)
				{
					$this->messageManager->addError('You typed an invalid rule!');
					return $resultRedirect->setPath('*/*/addnewqrcode');
				}


				$qrcodeRule = trim($qrcodeRule);
				// get all selected products' ids
				if(!isset($data['in_products']))
				{
					$this->messageManager->addError('You did not choose any product!');
					return $resultRedirect->setPath('*/*/addnewqrcode');
				}
				$productIDs = explode('&',$data['in_products']);


				$objectManager = \Magento\Framework\App\ObjectManager::getInstance();

				foreach($productIDs as $productID)
				{	
					$qrcode_model = $this->_objectManager->create('Simicart\QRcode\Model\QRcode');

						// create QRcode
					$qrcode = $this->createQRcode($qrcodeRule);

					$product = $objectManager->create('Magento\Catalog\Model\Product')->load($productID);
					$productName = $product->getName();
					$productSKU = $product->getSKU();

					$qrcode_model->setData('qrcode_rule',$qrcodeRule);
					$qrcode_model->setData('qrcode',$qrcode);
					$qrcode_model->setData('product_name',$productName) ;
					$qrcode_model->setData('product_sku',$productSKU) ;
					$qrcode_model->setData('created_at',$date) ;
					$qrcode_model->setData('updated_at',$date) ;
					$qrcode_model->save();


				}
				

			}
		}
		else
		{// $data = emty ==> request is sent from upload.php
			// ==> read csv file from var/tmp and save to DB
			$directory = $this->moduleReader->getModuleDir('etc', 'Simicart_QRcode'); 

			// This is your CSV file.
			$file = $directory . '/csv.csv';
			
			if (file_exists($file)) {

				$csvData = $this->csv->getData($file);


				for($i = 1; $i<count($csvData);$i++)
				{

					$existed = false;
					// check existed qrcode
					foreach($this->collection as $row)
					{
						if($row->getData('qrcode') == $csvData[$i][0])
						{
							$existed = true;
						}

					}

					if($existed == false)
					{
						$qrcode_model = $this->_objectManager->create('Simicart\QRcode\Model\QRcode');

						$qrcode_model->setData('qrcode',$csvData[$i][0]);
						$qrcode_model->setData('product_name',$csvData[$i][1]) ;
						$qrcode_model->setData('product_sku',$csvData[$i][2]) ;
						$qrcode_model->setData('created_at',$date) ;
						$qrcode_model->setData('updated_at',$date) ;
						$qrcode_model->save();
					}
					
				}
			}
			$this->delete();
		}
		return $resultRedirect->setPath('*/*/');
	}


}