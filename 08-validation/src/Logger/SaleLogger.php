<?php

namespace App\Logger;

use Psr\Log\LoggerInterface;
use App\Entity\Sale;

class SaleLogger
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function log(Sale $sale)
    {
        $this->logger->info('Sold ' . count($sale->getTickets()) . ' tickets to ' . $sale->getFullName());
    }
}