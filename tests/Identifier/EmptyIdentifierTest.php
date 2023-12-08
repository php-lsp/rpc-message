<?php

declare(strict_types=1);

namespace Lsp\Message\Tests\Identifier;

use Lsp\Message\EmptyIdentifier;
use Lsp\Message\IntIdentifier;
use Lsp\Message\StringIdentifier;
use Lsp\Message\Tests\TestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group('php-lsp/rpc-message')]
final class EmptyIdentifierTest extends TestCase
{
    public function testIsSameInstance(): void
    {
        $id = EmptyIdentifier::getInstance();

        self::assertSame($id, EmptyIdentifier::getInstance());
    }

    public function testMatchInstances(): void
    {
        $id = new EmptyIdentifier();

        self::assertTrue($id->equals(new EmptyIdentifier()));

        self::assertFalse($id->equals(new IntIdentifier(42)));
        self::assertFalse($id->equals(new StringIdentifier('test')));
    }

    public function testPrimitiveValue(): void
    {
        $id = new EmptyIdentifier();

        self::assertNull($id->toPrimitive());
    }

    public function testStringRepresentation(): void
    {
        $id = new EmptyIdentifier();

        self::assertSame('', (string)$id);
    }
}
