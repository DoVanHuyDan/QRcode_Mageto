<?php

namespace Simicart\QRcode\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class InstallData implements InstallDataInterface
{
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $setup->getConnection()->insert(
            $setup->getTable('simicart_qrcode'),
            [
                'qrcode' => 'QRCODE1',
                'product_name' => 'product1',
                'product_sku' => 'SKU1',

            ]
        );

        $setup->getConnection()->insert(
            $setup->getTable('simicart_qrcode'),
            [
                'qrcode' => 'QRCODE1',
                'product_name' => 'product1',
                'product_sku' => 'SKU1',

            ]
        );

        $setup->getConnection()->insert(
            $setup->getTable('simicart_qrcode'),
            [
                'qrcode' => 'QRCODE1',
                'product_name' => 'product1',
                'product_sku' => 'SKU1',

            ]
        );



        $setup->endSetup();
    }
}
