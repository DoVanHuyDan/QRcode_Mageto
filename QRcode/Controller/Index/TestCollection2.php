<?php
namespace Simicart\QRcode\Controller\Index;

class TestCollection2 extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
	protected $collection;
	protected $productCollectionFactory;
	protected $productModel;
	protected $productFactory;
	protected $_productRepository;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\Simicart\QRcode\Model\ResourceModel\QRcode\Collection $collection,
		\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
		\Magento\Catalog\Model\Product $productModel,
		\Magento\Catalog\Model\ProductFactory $productFactory,
		\Magento\Catalog\Model\ProductRepository $productRepository
	)
	{
		$this->_pageFactory = $pageFactory;
		$this->collection = $collection;
		$this->productCollectionFactory = $productCollectionFactory;
		$this->productModel = $productModel;
		$this->productFactory = $productFactory;
		$this->_productRepository = $productRepository;

		return parent::__construct($context);
	}

	public function execute()
	{		
		echo "<pre>";

		// var_dump($this->productModel->load(5)->getName()); // get product name by id 
		$product = $this->_productRepository->get('sku');
		var_dump($product->getName());


		die("ass");

	}
}

