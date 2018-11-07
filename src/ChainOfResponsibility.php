<?php

namespace Yarimadam\COR;

/**
 * Class ChainOfResponsibility
 * @package Yarimadam\COR
 * @author Halil Tuncay Uner <tuncayuner@gmail.com>
 */
class ChainOfResponsibility
{
    /** @var array */
    private $registeredHandlers;

    /** @var AbstractHandler */
    private $entrypoint;

    /** @var string */
    private $responsibleHandler = null;

    /** @var mixed */
    private $responsibleHandlerOutput = null;

    /**
     * ChainOfResponsibility constructor.
     */
    public function __construct()
    {
        $this->registeredHandlers = [];
    }

    /**
     * Register a subject handler.
     *
     * @param AbstractHandler $handler
     */
    public function registerHandler(AbstractHandler $handler): void
    {
        if (in_array(get_class($handler), $this->registeredHandlers)) {
            throw new \LogicException('A handler cannot be registeret more than once.');
        }

        $this->registeredHandlers[] = get_class($handler);

        $handler->setChain($this);

        if ($this->entrypoint instanceof AbstractHandler) {
            $this->entrypoint->registerNextHandler($handler);
        } else {
            $this->entrypoint = $handler;
        }
    }

    /**
     * Process subject across registered handlers.
     *
     * @param $subject
     */
    public function processThroughChain($subject): void
    {
        if (is_null($subject)) {
            throw new \InvalidArgumentException(
                sprintf('Argument passed to "%s" cannot be null.', __CLASS__ . '::' . __METHOD__)
            );
        }

        if (($this->entrypoint instanceof AbstractHandler) === false) {
            throw new \LogicException('No handler present in the chain.');
        }

        $this->entrypoint->introduce($subject);
    }

    /**
     * Get fully qualified class name of the handler.
     *
     * @return string
     */
    public function getResponsibleHandler(): string
    {
        return $this->responsibleHandler;
    }

    /**
     * Set fully qualified class name of the handler.
     *
     * @param string $responsibleHandler
     */
    public function setResponsibleHandler(string $responsibleHandler): void
    {
        $this->responsibleHandler = $responsibleHandler;
    }

    /**
     * Get output of the handler.
     *
     * @return mixed
     */
    public function getResponsibleHandlerOutput()
    {
        return $this->responsibleHandlerOutput;
    }

    /**
     * Set output of the handler.
     *
     * @param mixed $responsibleHandlerOutput
     */
    public function setResponsibleHandlerOutput($responsibleHandlerOutput): void
    {
        $this->responsibleHandlerOutput = $responsibleHandlerOutput;
    }
}
