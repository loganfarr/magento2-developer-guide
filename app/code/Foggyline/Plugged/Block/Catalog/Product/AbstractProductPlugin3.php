<?php

namespace Foggyline\Plugged\Block\Catalog\Product;

class AbstractPluginProduct3 {
  public function beforeGetAddtoCartUrl($subject, $product, $additional = []) {
    var_dump('Plugin1 - beforeGetAddtoCartUrl');
  }

  public function afterGetAddToCartUrl($subject, $product, $additional = []) {
    var_dump('Plugin1 - afterGetAddToCartUrl');
  }

  public function aroundGetAddToCartUrl($subject, \Closure $proceed, $product, $additional = []) {
    var_dump('Plugin1 - aroundGetAddToCartUrl');
    return $proceed($product, $additional);
  }
}