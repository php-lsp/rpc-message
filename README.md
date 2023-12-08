# RPC Message

---

<p align="center">
    <a href="https://packagist.org/packages/php-lsp/rpc-message"><img src="https://poser.pugx.org/php-lsp/rpc-message/require/php?style=for-the-badge" alt="PHP 8.1+"></a>
    <a href="https://packagist.org/packages/php-lsp/rpc-message"><img src="https://poser.pugx.org/php-lsp/rpc-message/version?style=for-the-badge" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/php-lsp/rpc-message"><img src="https://poser.pugx.org/php-lsp/rpc-message/v/unstable?style=for-the-badge" alt="Latest Unstable Version"></a>
    <a href="https://raw.githubusercontent.com/php-lsp/rpc-message/blob/master/LICENSE"><img src="https://poser.pugx.org/php-lsp/rpc-message/license?style=for-the-badge" alt="License MIT"></a>
</p>
<p align="center">
    <a href="https://github.com/php-lsp/rpc-message/actions"><img src="https://github.com/php-lsp/rpc-message/workflows/tests/badge.svg"></a>
</p>

A set of classes for the RPC messages implementations.

## Requirements

- PHP 8.1+

## Installation

- Add `php-lsp/rpc-message` as composer dependency.

```json
{
    "require": {
        "php-lsp/rpc-message": "^1.0"
    }
}
```

## Usage

### Identifiers

**Empty Identifier**

> Note that some RPC implementations do not allow the 
> creation of empty identifiers.

```php
$id = new \Lsp\Message\EmptyIdentifier();

// OR

$id = \Lsp\Message\EmptyIdentifier::getInstance();
```

**Platform-based Integer Identifier**

```php
$id = new \Lsp\Message\IntIdentifier(0xDEAD_BEEF);
```

**String Identifier**

```php
$id = new \Lsp\Message\StringIdentifier('hello');

$id = new \Lsp\Message\StringIdentifier(''); // Error: Empty ID not allowed
```

### Requests

**Notification**

```php
$notify1 = new \Lsp\Message\Notification('method1');

$notify2 = new \Lsp\Message\Notification('method2', ['argument']);

$notify3 = new \Lsp\Message\Notification('method3', ['name' => 0xDEAD_BABE]);
```

**Request**

```php
$request1 = new \Lsp\Message\Request(
    id: new \Lsp\Message\StringIdentifier('RequestID'),
    method: 'name',
);

$request2 = new \Lsp\Message\Request(
    id: new \Lsp\Message\StringIdentifier('RequestID'),
    method: 'method-with-args',
    parameters: [ 'name' => 'value' ],
);
```

### Responses

**Successful Response**

```php
$response = new \Lsp\Message\SuccessfulResponse(
    id: new \Lsp\Message\StringIdentifier('RequestID'),
    result: 'Arbitrary response data',
);
```

**Failure Response**

```php
$response1 = new \Lsp\Message\FailureResponse(
    id: new \Lsp\Message\StringIdentifier('RequestID'),
);

$response2 = new \Lsp\Message\FailureResponse(
    id: new \Lsp\Message\StringIdentifier('RequestID'),
    code: 0xDEAD,
);

$response3 = new \Lsp\Message\FailureResponse(
    id: new \Lsp\Message\StringIdentifier('RequestID'),
    code: 0xDEAD,
    message: 'Something went wrong',
);

$response4 = new \Lsp\Message\FailureResponse(
    id: new \Lsp\Message\StringIdentifier('RequestID'),
    code: 0xDEAD,
    message: 'Something went wrong again',
    data: [ 'additional', 'information' => 'asdasd' ],
);
```
