<?php

namespace Ekown\Laracore5\App\Audit\Flow\Login;

use Ekown\Laracore5\App\Audit\Logger;
use Ekown\Laracore5\App\Audit\Schema\LoginSchema;

class Processing
{
    /**
     * @var float
     */
    private $startTime;

    /**
     * @var Logger
     */
    private $logger;

    /**
     * @var bool
     */
    private $enabled;

    /**
     * Form Logger constructor.
     *
     * @param Logger $logger
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;

        // temporary
        $this->enabled = true;
    }

    /**
     * @param void
     *
     */
    public function loginRetrieveDetailsSuccess() : null
    {
        try {
            if ($this->enabled) {
                $name = LoginSchema::LOGIN_RETRIEVE_DETAILS_SUCCESS['name'];
                $logger  = $this->logger->withName($name);
                $message = LoginSchema::LOGIN_RETRIEVE_DETAILS_SUCCESS['message'];

                $logger->addRecord(Logger::NOTICE, $name, [
                    'message' => $message
                ]);
            }
        } catch (\Exception $e) {
            \error_log($e->getMessage());
        }
    }

    /**
     * @param string $exception
     * @param string $message
     *
     */
    public function loginRetrieveDetailsFailed(string $exception, string $message) : null
    {
        try {
            if ($this->enabled) {
                $name = LoginSchema::LOGIN_RETRIEVE_DETAILS_FAILED['name'];
                $logger  = $this->logger->withName($name);

                $logger->addRecord(Logger::NOTICE, $name, [
                    'exception' => $exception . 'Exception',
                    'message' => $message
                ]);
            }
        } catch (\Exception $e) {
            \error_log($e->getMessage());
        }
    }

    /**
     * @param void
     *
     */
    public function loginSuccess() : null
    {
        try {
            if ($this->enabled) {
                $name = LoginSchema::LOGIN_SUCCESS['name'];
                $logger  = $this->logger->withName($name);
                $message = LoginSchema::LOGIN_SUCCESS['message'];

                $logger->addRecord(Logger::NOTICE, $name, [
                    'message' => $message
                ]);
            }
        } catch (\Exception $e) {
            \error_log($e->getMessage());
        }
    }

    /**
     * @param string $exception
     * @param string $message
     *
     */
    public function loginFailed(string $exception, string $message) : null
    {
        try {
            if ($this->enabled) {
                $name = LoginSchema::LOGIN_FAILED['name'];
                $logger  = $this->logger->withName($name);

                $logger->addRecord(Logger::ALERT, $name, [
                    'exception' => $exception,
                    'message' => $message
                ]);
            }
        } catch (\Exception $e) {
            \error_log($e->getMessage());
        }
    }

    /**
     * @param string $instanceId
     *
     */
    public function logoutSuccess(string $instanceId) : null
    {
        try {
            if ($this->enabled) {
                $name = LoginSchema::LOGOUT_SUCCESS['name'];
                $logger  = $this->logger->withName($name);

                $logger->addRecord(Logger::NOTICE, $name, [
                    'exception' => $exception,
                    'message' => $message
                ]);
            }
        } catch (\Exception $e) {
            \error_log($e->getMessage());
        }
    }

    /**
     * @param string $exception
     * @param string $message
     *
     */
    public function logoutFailed(string $exception, string $message) : null
    {
        try {
            if ($this->enabled) {
                $name = LoginSchema::LOGOUT_FAILED['name'];
                $logger  = $this->logger->withName($name);

                $logger->addRecord(Logger::ALERT, $name, [
                    'exception' => $exception,
                    'message' => $message
                ]);
            }
        } catch (\Exception $e) {
            \error_log($e->getMessage());
        }
    }

}