<?php

namespace Simicart\QRcode\Controller\Adminhtml\QRcode;

use Magento\Backend\App\Action;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Filesystem;
use Magento\MediaStorage\Model\File\UploaderFactory;


class Upload extends Action
{
    protected $fileSystem;

    protected $uploaderFactory;

    protected $allowedExtensions = ['csv']; // Files allowed types 

    protected $fileId = 'file'; // name input file  

    protected $moduleReader;

    public function __construct(
        Action\Context $context,
        Filesystem $fileSystem,
        UploaderFactory $uploaderFactory, \Magento\Framework\Module\Dir\Reader $moduleReader
    ) {
        $this->fileSystem = $fileSystem;
        $this->uploaderFactory = $uploaderFactory;
        $this->moduleReader = $moduleReader;
        parent::__construct($context);
    }

    public function execute()
    {   

       // $destinationPath = $this->getDestinationPath();
        $destinationPath = $this->moduleReader->getModuleDir('etc', 'Simicart_QRcode');

        $wantedSavedFileName = 'csv.csv';
        try {
            $uploader = $this->uploaderFactory->create(['fileId' => $this->fileId])->setAllowCreateFolders(true)->setAllowedExtensions($this->allowedExtensions)->addValidateCallback('validate', $this, 'validateFile');
            
            if (!$uploader->save($destinationPath,$wantedSavedFileName)) {

                throw new LocalizedException(
                    __('File cannot be saved to path: $1', $destinationPath)
                );
            }


            // process the uploaded file
        } catch (\Exception $e) {
           
            $this->messageManager->addError(
                __($e->getMessage())
            );
           
            return $this->resultRedirectFactory->create()->setPath('*/*/importnew');
        }


        return $this->resultRedirectFactory->create()->setPath('*/*/save', ['_current' => true]);
    }

    public function validateFile($filePath)
    {
        // your custom validation code here
    }

    public function getDestinationPath()
    {
        return $this->fileSystem
        ->getDirectoryWrite(DirectoryList::TMP)
        ->getAbsolutePath('/');
    }
}