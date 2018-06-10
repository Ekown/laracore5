<?php

namespace Audit;

use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Handler\ErrorLogHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Processor\IntrospectionProcessor;
use Monolog\Processor\MemoryPeakUsageProcessor;
use Monolog\Processor\MemoryUsageProcessor;
use Monolog\Processor\TagProcessor;
use Monolog\Processor\UidProcessor;
use Monolog\Processor\WebProcessor;

class Logger extends \Monolog\Logger
{
    /**
     * @param int $level
     * @param string $message
     * @param array $context
     * @return bool
     *
     */
    public function addRecord($level, $message, array $context = array())
    {
        try {
            $context['ip_address'] = $this->getIpAddress();
            return parent::addRecord($level, $message, $context);
        } catch (\Exception $e) {}

        return false;
    }

    /**
     * @return string
     */
    private function getIpAddress()
    {
        $ipAddress = '';

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
            $ipAddress = $_SERVER['REMOTE_ADDR'];
        }

        return $ipAddress;
    }
}