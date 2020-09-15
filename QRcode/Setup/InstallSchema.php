<?php

namespace Simicart\QRcode\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();


        $setup->getConnection()->dropTable($setup->getTable('simicart_qrcode'));
        $table = $setup->getConnection()->newTable($setup->getTable('simicart_qrcode')
    )->addColumn(
        'qrcode_id',
        Table::TYPE_INTEGER,
        null,
        ['identity'=>true,'unsigned'=>true,'nullable'=>false,'primary'=>true],
        'qrcode_id id'
    )->addColumn(
        'qrcode',
        Table::TYPE_TEXT,
        null,
        ['nullable'=>false,'default'=>''],
        'qrcode qrcode'
    )->addColumn(
        'product_name',
        Table::TYPE_TEXT,
        null,
        ['nullable'=>false,'default'=>''],
        'product name'

    )->addColumn(
        'product_sku',
        Table::TYPE_TEXT,
        null,
        ['nullable'=>false,'default'=>''],
        'product sku'
    )->addColumn(
        'created_at',
        Table::TYPE_DATETIME,
        null,
        ['nullable'=>true],
        'created at'
    )->addColumn(
        'updated_at',
        Table::TYPE_DATETIME,
        null,
        ['nullable'=>true],
        'updated at'  
    );

    $setup->getConnection()->createTable($table);
    $setup->endSetup();
}
}