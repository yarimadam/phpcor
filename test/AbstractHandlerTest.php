<?php

namespace Yarimadam\COR\Test;

use PHPUnit\Framework\TestCase;
use Yarimadam\COR\ChainOfResponsibility;
use Yarimadam\COR\Test\HandlerStub\IntegerHandlerStub;
use Yarimadam\COR\Test\HandlerStub\StringHandlerStub;

class AbstractHandlerTest extends TestCase
{
    public function testRegisterNextHandlerCalled()
    {
        $cor = new ChainOfResponsibility();

        $handler1 = $this->createMock(StringHandlerStub::class);
        $handler1->expects($this->once())->method('registerNextHandler');

        $handler2 = new IntegerHandlerStub();

        $cor->registerHandler($handler1);
        $cor->registerHandler($handler2);
    }
}
