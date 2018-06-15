<?php

namespace Ekown\Laracore5\App\Audit\Flow;

use Ekown\Laracore5\App\Audit\Logger;
use Ekown\Laracore5\App\Audit\Schema\LoginSchema;

class Form
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
     *
     * @param void
     *
     */
    public function loginFormCreated()
    {
        try {
            if ($this->enabled) {
                $name = LoginSchema::LOGIN_FORM_CREATED['name'];
                $logger  = $this->logger->withName($name);
                $message = LoginSchema::LOGIN_FORM_CREATED['message'];

                $logger->addRecord(Logger::NOTICE, $name, [
                    'message' => $message
                ]);
            }
        } catch (\Exception $e) {
            \error_log($e->getMessage());
        }
    }

    /**
     *
     * @param void
     *
     */
    public function loginFormDisplayed()
    {
        try {
            if ($this->enabled) {
                $name = LoginSchema::LOGIN_FORM_DISPLAYED['name'];
                $logger  = $this->logger->withName($name);
                $message = LoginSchema::LOGIN_FORM_DISPLAYED['message'];

                $logger->addRecord(Logger::NOTICE, $name, [
                    'message' => $message
                ]);
            }
        } catch (\Exception $e) {
            \error_log($e->getMessage());
        }
    }

    /**
     * @param array $payload
     *
     */
    public function loginFormSubmit(array $payload)
    {
        try {
            if ($this->enabled) {
                $name = LoginSchema::LOGIN_FORM_SUBMIT['name'];
                $logger  = $this->logger->withName($name);
                $message = LoginSchema::LOGIN_FORM_SUBMIT['message'];

                $logger->addRecord(Logger::NOTICE, $name, [
                    'message' => $message,
                    'email' => $payload['email']
                ]);
            }
        } catch (\Exception $e) {
            \error_log($e->getMessage());
        }
    }
}