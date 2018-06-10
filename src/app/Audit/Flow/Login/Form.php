<?php

namespace Audit\Flow\Login;

use Audit\Logger;
use Audit\Schema\LoginSchema;

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
     * @param Logger         $logger
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;

        // temporary
        $this->enabled = true;
    }

    public function loginFormDisplayed()
    {
        try {
            if ($this->enabled) {
                $logger  = $this->logger->withName(LoginSchema::LOGIN_FORM_DISPLAYED['name']);
                $message = LoginSchema::LOGIN_FORM_DISPLAYED['message'];

                $logger->addRecord(Logger::NOTICE, $name, [
                    'message' => $message
                ]);
            }
        } catch (\Exception $e) {

        }
    }
}