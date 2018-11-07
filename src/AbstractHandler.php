<?php

namespace Yarimadam\COR;

/**
 * Class AbstractHandler
 * @package Yarimadam\COR
 * @author Halil Tuncay Uner <tuncayuner@gmail.com>
 */
abstract class AbstractHandler
{
    /** @var ChainOfResponsibility */
    protected $chain;

    /** @var AbstractHandler */
    protected $nextHandler;

    /**
     * Decide what to do with the subject.
     *
     * @param $subject mixed
     */
    public function introduce($subject): void
    {
        if ($this->isResponsible($subject)) {
            $this->chain->setResponsibleHandler(static::class);
            $this->chain->setResponsibleHandlerOutput($this->handle($subject));
        } elseif ($this->nextHandler instanceof AbstractHandler) {
            $this->nextHandler->introduce($subject);
        }
    }

    /**
     * Register new link to chain.
     *
     * @param AbstractHandler $handler
     */
    public function registerNextHandler(AbstractHandler $handler)
    {
        if ($this->nextHandler instanceof AbstractHandler) {
            $this->nextHandler->registerNexthandler($handler);
        } else {
            $this->nextHandler = $handler;
        }
    }

    /**
     * Set which chain this particular handler belongs to.
     *
     * @param ChainOfResponsibility $chain
     */
    public function setChain(ChainOfResponsibility $chain)
    {
        $this->chain = $chain;
    }

    /**
     * Is this handler responsible for handling the subject?
     *
     * @param $subject
     * @return bool
     */
    abstract protected function isResponsible($subject): bool;

    /**
     * Handle the subject.
     *
     * @param $subject
     * @return mixed
     */
    abstract protected function handle($subject): ?void;
}
