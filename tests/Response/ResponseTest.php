<?php

declare(strict_types=1);

namespace Lsp\Message\Tests\Response;

use Lsp\Message\EmptyIdentifier;
use Lsp\Message\IntIdentifier;
use Lsp\Message\Request;
use Lsp\Message\Response;
use Lsp\Message\Tests\TestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group('php-lsp/rpc-message')]
final class ResponseTest extends TestCase
{
    public function testIdentifier(): void
    {
        $response = new class (
            $id = EmptyIdentifier::getInstance(),
        ) extends Response {};

        self::assertSame($id, $response->getId());
    }

    public function testSameRequest(): void
    {
        $id = new IntIdentifier(0xDEAD_BEEF);

        $request = new Request($id, 'example');
        $response = new class ($id) extends Response {};

        self::assertTrue($response->matchesRequest($request));
    }
}
