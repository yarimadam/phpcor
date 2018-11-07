<?php

namespace Yarimadam\COR\Test\HandlerStub;

use Yarimadam\COR\AbstractHandler;

/**
 * Class XyzHandlerStub
 * @package Yarimadam\COR\Test\HandlerStub
 * @author Halil Tuncay Uner <tuncayuner@gmail.com>
 */
class XyzHandlerStub extends AbstractHandler
{
    protected function isResponsible($subject): bool
    {
        return true;
    }

    protected function handle($subject): void
    {
        echo __CLASS__ . '::' . __METHOD__;
    }
}
