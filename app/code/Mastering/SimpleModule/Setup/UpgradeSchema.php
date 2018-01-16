<?php

namespace Mastering\SampleModule\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface {
  public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context) {
    $setup->startSetup();

    // Checks the module version and will not run if it is greater than or equal to 1.0.1
    if(version_compare($context->getVersion(), '1.0.1', '<')) {
      $setup->getConnection()->addColumn(
      $setup->getTable('mastering_sample_item'),
        'description',
        [
          'type' => Table::TYPE_TEXT,
          'nullable' => TRUE,
          'comment' => 'Item Description'
        ]
      );

      $setup->endSetup();
    }
  }
}