<?php

namespace Yarimadam\COR\Test\HandlerStub;

use Yarimadam\COR\AbstractHandler;

/**
 * Class IntegerHandlerStub
 * @package Yarimadam\COR\Test\HandlerStub
 * @author Halil Tuncay Uner <tuncayuner@gmail.com>
 */
class IntegerHandlerStub extends AbstractHandler
{
    protected function isResponsible($subject): bool
    {
        return is_int($subject);
    }

    protected function handle($subject): void
    {
        $output = sprintf('subject "%i" is integer.', $subject);
        $this->chain->setResponsibleHandlerOutput($output);
    }
}
