<?php

namespace Foggyline\Plugged\Block\Catalog\Product;

class AbstractPluginProduct1 {
  public function beforeGetAddToCartUrl($subject, $product, $additional = []) {
    var_dump('Plugin1 - beforeGetAddToCartUrl');
  }

  public function afterGetAddToCartUrl($subject) {
    var_dump('Plugin1 - afterGetAddToCartUrl');
  }

  public function aroundGetAddToCartUrl($subject, \Closure $proceed, $product, $additional = []) {
    var_dump('Plugin1 - aroundGetAddToCartUrl');
    return $proceed($product, $additional);
  }
}