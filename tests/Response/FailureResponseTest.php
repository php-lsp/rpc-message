<?php

declare(strict_types=1);

namespace Lsp\Message\Tests\Response;

use Lsp\Message\EmptyIdentifier;
use Lsp\Message\FailureResponse;
use Lsp\Message\IntIdentifier;
use Lsp\Message\Request;
use Lsp\Message\Tests\TestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group('php-lsp/rpc-message')]
final class FailureResponseTest extends TestCase
{
    public function testIdentifier(): void
    {
        $response = new FailureResponse(
            $id = EmptyIdentifier::getInstance(),
        );

        self::assertSame($id, $response->getId());
    }

    public function testErrorCode(): void
    {
        $response = new FailureResponse(
            EmptyIdentifier::getInstance(),
            $code = 0xDEAD_BEEF,
        );

        self::assertSame($code, $response->getErrorCode());
    }

    public function testNegativeErrorCode(): void
    {
        $response = new FailureResponse(
            EmptyIdentifier::getInstance(),
            $code = -0xDEAD_BEEF,
        );

        self::assertSame($code, $response->getErrorCode());
    }

    public function testZeroErrorCodeByDefault(): void
    {
        $response = new FailureResponse(
            EmptyIdentifier::getInstance(),
        );

        self::assertSame(0, $response->getErrorCode());
    }


    public function testErrorMessage(): void
    {
        $response = new FailureResponse(
            EmptyIdentifier::getInstance(),
            0,
            $message = 'example message',
        );

        self::assertSame($message, $response->getErrorMessage());
    }

    public function testEmptyErrorMessage(): void
    {
        $response = new FailureResponse(
            EmptyIdentifier::getInstance(),
            0,
            $message = '',
        );

        self::assertSame($message, $response->getErrorMessage());
    }

    public function testEmptyErrorMessageByDefault(): void
    {
        $response = new FailureResponse(
            EmptyIdentifier::getInstance(),
        );

        self::assertSame('', $response->getErrorMessage());
    }

    public function testSameErrorData(): void
    {
        $response = new FailureResponse(
            EmptyIdentifier::getInstance(),
            0,
            '',
            $data = (object)["\0test\0field" => 42],
        );

        self::assertSame($data, $response->getErrorData());
    }

    public function testSameRequest(): void
    {
        $id = new IntIdentifier(0xDEAD_BEEF);

        $request = new Request($id, 'example');
        $response = new FailureResponse($id);

        self::assertTrue($response->matchesRequest($request));
    }
}
