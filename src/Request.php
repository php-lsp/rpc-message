<?php

declare(strict_types=1);

namespace Lsp\Message;

use Lsp\Contracts\Message\IdInterface;
use Lsp\Contracts\Message\RequestInterface;

class Request extends Notification implements RequestInterface
{
    /**
     * @param non-empty-string $method
     * @param array<array-key, mixed> $parameters
     */
    public function __construct(
        protected readonly IdInterface $id,
        string $method,
        array $parameters = [],
    ) {
        /** @psalm-suppress RedundantCondition : Allow additional assertion */
        assert($method !== '', 'Method name cannot be empty');

        parent::__construct($method, $parameters);
    }

    public function getId(): IdInterface
    {
        return $this->id;
    }
}
