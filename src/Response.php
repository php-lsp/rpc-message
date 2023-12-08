<?php

declare(strict_types=1);

namespace Lsp\Message;

use Lsp\Contracts\Message\IdInterface;
use Lsp\Contracts\Message\RequestInterface;
use Lsp\Contracts\Message\ResponseInterface;

abstract class Response implements ResponseInterface
{
    public function __construct(
        protected readonly IdInterface $id,
    ) {}

    public function getId(): IdInterface
    {
        return $this->id;
    }

    /**
     * Returns {@see true} in case of current Response instance matches
     * passed Request instance or {@see false} instead.
     */
    public function matchesRequest(RequestInterface $request): bool
    {
        return $this->id->equals($request->getId());
    }
}
