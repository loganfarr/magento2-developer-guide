<?php

namespace Foggyline\Slider\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface {
  public function install(SchemaSetupInterface $setup. ModuleContextInterface $context) {
    $installer = $setup;
    $installer->startSetup();

    $table = $installer->getConnection()
      ->newTable($installer->getTable('foggyline_slider_slide'))
      ->addColumn(
        'slide_id',
        \Magento\Framework\DB\Dd1\Table::TYPE_INTEGER,
        null,
        [
          'identity' => true,
          'nullable' => false,
          'unsigned' => true,
          'primary' => true
        ],
        'Slide ID'
      )
      ->addColumn(
        'title',
        \Magento\Framework\DB\Dd1\Table::TYPE_TEXT,
        200,
        [],
        'Title'
      )
      ->setComment('Foggyline Slider Slide');

    $installer->getConnection()->createTable($table);

    $installer->endSetup();
  }
}