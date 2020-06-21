<?php
namespace Oire\Tests;

use Oire\Base64;
use Oire\Exception\Base64Exception;
use PHPUnit\Framework\TestCase;

class Base64Test extends TestCase
{
    private const RAW_DATA = 'The quick brown fox jumps over the lazy dog';
    private const ENCODED_DATA = 'VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZw==';
    private const URL_SAFE_ENCODED_DATA = 'VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZw~~';
    private const PADDINGLESS_ENCODED_DATA = 'VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZw';

    public function testDataEquality(): void
    {
        self::assertSame(Base64::decode(Base64::encode(self::RAW_DATA)), self::RAW_DATA);
    }

    public function testEncodingValidity(): void
    {
        self::assertSame(Base64::encode(self::RAW_DATA), self::PADDINGLESS_ENCODED_DATA);
    }

    public function testUrlSafeness(): void
    {
        self::assertNotSame(Base64::encode(self::RAW_DATA, true), self::ENCODED_DATA);
        self::assertSame(Base64::encode(self::RAW_DATA, true), self::URL_SAFE_ENCODED_DATA);
    }

    public function testPadding(): void
    {
        self::assertNotSame(Base64::encode(self::RAW_DATA), self::URL_SAFE_ENCODED_DATA);
        self::assertSame(Base64::encode(self::RAW_DATA, true), self::URL_SAFE_ENCODED_DATA);
    }

    public function testNonBase64Alphabet(): void
    {
        self::expectException(Base64Exception::class);
        self::expectExceptionMessage('Base64 decoding failed.');

        Base64::decode(random_bytes(32));
    }

    public function testEmpty(): void
    {
        self::assertEmpty(Base64::encode(''));
        self::assertEmpty(Base64::decode(''));
    }
}
