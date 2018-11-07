<?php

namespace Yarimadam\COR\Test;

use PHPUnit\Framework\TestCase;
use Yarimadam\COR\ChainOfResponsibility;
use Yarimadam\COR\Test\HandlerStub\IntegerHandlerStub;
use Yarimadam\COR\Test\HandlerStub\StringHandlerStub;
use Yarimadam\COR\Test\HandlerStub\XyzHandlerStub;

class ChainOfResponsibilityTest extends TestCase
{
    public function testRegisterSameHandlerTwice()
    {
        $this->expectException(\LogicException::class);

        $handler1 = new XyzHandlerStub();
        $handler2 = new XyzHandlerStub();

        $cor = new ChainOfResponsibility();

        $cor->registerHandler($handler1);
        $cor->registerHandler($handler2);
    }

    public function testGetResponsibleHandlerOutput()
    {
        $cor = new ChainOfResponsibility();

        $cor->registerHandler(new IntegerHandlerStub());
        $cor->registerHandler(new StringHandlerStub());

        $subject = 'Hi there, i\'m a string!';

        $cor->processThroughChain($subject);

        $output = $cor->getResponsibleHandlerOutput();

        $this->assertContains('string', $output);
    }

    public function testGetResponsibleHandler()
    {
        $cor = new ChainOfResponsibility();

        $cor->registerHandler(new StringHandlerStub());
        $cor->registerHandler(new XyzHandlerStub());

        $subject = ['XyzHandler should handle me.'];

        $cor->processThroughChain($subject);

        $responsibleHandler = $cor->getResponsibleHandler();

        $this->assertContains(XyzHandlerStub::class, $responsibleHandler);
    }
}
