<?php

declare(strict_types=1);

namespace Lsp\Message;

use Lsp\Contracts\Message\NotificationInterface;

class Notification implements NotificationInterface
{
    /**
     * @param non-empty-string $method
     * @param array<array-key, mixed> $parameters
     */
    public function __construct(
        protected readonly string $method,
        protected readonly array $parameters = []
    ) {
        /** @psalm-suppress RedundantCondition : Allow additional assertion */
        assert($method !== '', 'Method name cannot be empty');
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }
}
