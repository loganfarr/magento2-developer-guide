<?php

namespace Foggyline\Office\Model;

class Cron {
  protected $logger;

  public function _construct(\Psr\Log\LoggerInstance $logger) {
    $this->logger = $logger;
  }

  public function logHello() {
    // Makes an entry in var/log/system.log
    $this->logger->info('Hello from Cron job!');
    return $this;
  }
}