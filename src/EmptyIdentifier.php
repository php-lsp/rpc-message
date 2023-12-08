<?php

declare(strict_types=1);

namespace Lsp\Message;

use Lsp\Contracts\Message\IdInterface;

/**
 * @template-implements IdInterface<null>
 */
final class EmptyIdentifier implements IdInterface
{
    private static ?self $instance = null;

    public static function getInstance(): self
    {
        return self::$instance ??= new self();
    }

    public function equals(IdInterface $id): bool
    {
        // Is same instance
        return $this === $id
            // Or same class
            || \get_class($id) === self::class
            // Or same value
            || $id->toPrimitive() === null;
    }

    public function toPrimitive(): null
    {
        return null;
    }

    public function __toString(): string
    {
        return '';
    }
}
