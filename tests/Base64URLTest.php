<?php
declare(strict_types=1);

namespace Olegf13\Tests;

use Olegf13\Base64URL;
use PHPUnit\Framework\TestCase;

/**
 * Class Base64URLTest
 * @package Olegf13\Tests
 */
class Base64URLTest extends TestCase
{
    /**
     *
     */
    public function testEncode()
    {
        $input = '????SlashAndPlus>>>';
        $this->assertEquals('Pz8_P1NsYXNoQW5kUGx1cz4-Pg', Base64URL::encode($input));
    }

    /**
     *
     */
    public function testDecode()
    {
        $input = 'Pz8_P1NsYXNoQW5kUGx1cz4-Pg';
        $this->assertEquals('????SlashAndPlus>>>', Base64URL::decode($input));
    }

    /**
     *
     */
    public function testEncodeThenDecode()
    {
        /** @var array $cases */
        $cases = [
            'testbox@example.com',
            '??????Slash??????',
            '<<<<<<<<<Plus>>>>>>>>>',
            '??????????SlashAndPlus>>>>>>>>>>',
            'D:/test/1231.jpg',
            '~/dev/.ssh/some_key',
            '你好',
            'текст с кириллицей',
            'f',
        ];
        foreach ($cases as $testCase) {
            $standardBase64 = \base64_decode(\base64_encode($testCase));
            $base64URL = Base64URL::decode(Base64URL::encode($testCase));
            $this->assertEquals($standardBase64, $base64URL);
        }
    }
}
