<?php

namespace Mastering\SimpleModule\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface {
  public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context) {
    $setup->startSetup();
    
    $setup->getConnection->insert(
      $setup->getTable('masetering_sample_item'),
      [
        'name' => 'Item 1'
      ]
    );

    $setup->endSetup();
  }
}