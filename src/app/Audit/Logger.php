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

    // Defaults
    const DEFAULT_NAME = 'Application';
    const DEFAULT_PATH = 'php://stdout';
    const DEFAULT_HANDLER = StreamHandler::class;
    const DEFAULT_MINIMUM_LEVEL = \Monolog\Logger::DEBUG;

    /**
     * Logger constructor.
     *
     * @param string $path
     * @param int $minimumLevel
     */
    public function __construct(
        $path = self::DEFAULT_PATH,
        $minimumLevel = self::DEFAULT_MINIMUM_LEVEL,
        $handlerName = self::DEFAULT_HANDLER
    ) {
        parent::__construct(self::DEFAULT_NAME);

        $this->setupHandlers($path, $minimumLevel, $handlerName);
        $this->setupProcessors();
    }
    
    /**
     * @param string $message
     * @param \Exception $e
     * @param int $level
     */
    public function exception($message, \Exception $e, $level = self::CRITICAL)
    {
        $exceptionToArray = [
            'message' => $e->getMessage(),
            'code' => $e->getCode(),
            'exception_class' => get_class($e)
        ];

        $this->addRecord($level, $message, $exceptionToArray);
    }

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

    /**
     * @return $this
     */
    private function setupProcessors()
    {
        $memoryUsage = new MemoryUsageProcessor();
        $memoryPeak = new MemoryPeakUsageProcessor();
        $introspection = new IntrospectionProcessor();
        $web = new WebProcessor();
        $uid = new UidProcessor();

        $this->pushProcessor($memoryUsage);
        $this->pushProcessor($memoryPeak);
        $this->pushProcessor($introspection);
        $this->pushProcessor($web);
        $this->pushProcessor($uid);

        return $this;
    }

    /**
     * @param string $path
     * @param int $minimumLevel
     * @param string $handlerName
     * @return $this
     */
    private function setupHandlers($path, $minimumLevel, $handlerName)
    {
        $formatter = new JsonFormatter();

        $handler = $this->getHandlerInstance(
            $handlerName,
            $minimumLevel,
            $path
        );
        $handler->setFormatter($formatter);

        $this->pushHandler($handler);

        return $this;
    }
    /**
     * @param string $handlerName
     * @param int $minimumLevel
     * @param string $path
     * @return AbstractProcessingHandler
     */
    private function getHandlerInstance($handlerName, $minimumLevel, $path = '')
    {
        switch ($handlerName) {
            case StreamHandler::class:
                return new StreamHandler($path, $minimumLevel);
            case ErrorLogHandler::class:
                return new ErrorLogHandler(
                    ErrorLogHandler::OPERATING_SYSTEM,
                    $minimumLevel
                );
            default:
                return new StreamHandler(self::DEFAULT_PATH, $minimumLevel);
        }
    }

}