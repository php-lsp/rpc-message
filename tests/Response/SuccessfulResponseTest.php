<?php

declare(strict_types=1);

namespace Lsp\Message\Tests\Response;

use Lsp\Message\EmptyIdentifier;
use Lsp\Message\IntIdentifier;
use Lsp\Message\Request;
use Lsp\Message\SuccessfulResponse;
use Lsp\Message\Tests\TestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group('php-lsp/rpc-message')]
final class SuccessfulResponseTest extends TestCase
{
    public function testIdentifier(): void
    {
        $response = new SuccessfulResponse(
            $id = EmptyIdentifier::getInstance(),
            null,
        );

        self::assertSame($id, $response->getId());
    }

    public function testResult(): void
    {
        $response = new SuccessfulResponse(
            EmptyIdentifier::getInstance(),
            $data = (object)["\0test\0field" => 42],
        );

        self::assertSame($data, $response->getResult());
    }

    public function testSameRequest(): void
    {
        $id = new IntIdentifier(0xDEAD_BEEF);

        $request = new Request($id, 'example');
        $response = new SuccessfulResponse($id, 'data');

        self::assertTrue($response->matchesRequest($request));
    }
}
