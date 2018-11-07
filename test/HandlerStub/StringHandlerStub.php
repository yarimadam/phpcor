<?php

namespace Yarimadam\COR\Test\HandlerStub;

use Yarimadam\COR\AbstractHandler;

/**
 * Class StringHandlerStub
 * @package Yarimadam\COR\Test\HandlerStub
 * @author Halil Tuncay Uner <tuncayuner@gmail.com>
 */
class StringHandlerStub extends AbstractHandler
{
    protected function isResponsible($subject): bool
    {
        return is_string($subject);
    }

    protected function handle($subject): void
    {
        $output = sprintf('subject "%s" is string.', $subject);
        $this->chain->setResponsibleHandlerOutput($output);
    }
}
