# Chain of Responsibility with PHP

## Description
Yarimadam/COR package is a simple chain of responsibility implementation written in PHP. It allows you to define handlers for each contex of your subjects and helps you with better modularizing your conditionals by decreasing cyclomatic/npath complexity in your applications.

## Installation

If you are crazy enough not to use composer, just download/clone it.

Otherwise, install with composer.

    composer require yarimadam/phpcor

## Quick Start

### Define Handlers

Create respective handlers for each contex of your subject, by extending `\Yarimadam\COR\AbstractHandler` superclass.

#### Handler Examples

Execute when passed subject is type of a "string":

```php
class StringHandler extends AbstractHandler
{
    protected function isResponsible($subject): bool
    {
        return is_string($subject);
    }

    protected function process($subject): void
    {
        // echo the output
        echo 'We have a string here!';
    }
}
```

Execute when passed subject is type of an "array".

```php
class ArrayHandler extends AbstractHandler
{
    protected function isResponsible($subject): bool
    {
        return is_array($subject);
    }

    protected function process($subject): void
    {
        $output = [];
        foreach($subject as $item) {
            $output[] = $item;
        }
        // don't echo, set as handler output instead
        $this->chain->setResponsibleHandlerOutput($output);
    }
}
```

### Define Flow

```php
$cor = new ChainOfResponsibility();

$cor->registerHandler(new StringHandler());
$cor->registerHandler(new ArrayHandler());

$subject = 'Hi there, i\'m a string!';

$cor->processThroughChain($subject);
```

### Get Results

```php
// fully qualified class name
$cor->getResponsibleHandler();

// output from the handler - if any
$cor->getResponsibleHandlerOutput();
```
