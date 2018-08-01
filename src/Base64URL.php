<?php
declare(strict_types=1);

namespace Olegf13;

/**
 * Base64 encoder/decoder with URL safe alphabet (base64url).
 *
 *
 * Modified Base64 with URL (and filename) safe alphabet, where the '+' and '/' characters of standard Base64
 * are respectively replaced by '-' and '_', and the padding '=' signs are omitted.
 *
 *
 * Given the example input "????SlashAndPlus>>>",
 * standard base64 encoded result equals to "Pz8/P1NsYXNoQW5kUGx1cz4+Pg==",
 * where base64url version produces "Pz8_P1NsYXNoQW5kUGx1cz4-Pg".
 *
 * @see https://tools.ietf.org/html/rfc4648#section-5 base64url in RFC 4648.
 */
class Base64URL
{
    /** @var string Padding symbol. */
    const PADDING_SYMBOL = '=';
    /** @var int Padding size. */
    const PADDING_SIZE = 4;
    /** @var string Original base64 alphabet symbols which are to be replaced. */
    const BASE64_ORIGINAL_SYMBOLS = '+/';
    /** @var string Replace symbols for base64 alphabet to match base64url. */
    const BASE64_REPLACE_SYMBOLS = '-_';

    /**
     * Encodes data with MIME base64url.
     *
     * @param string $data Data to encode.
     * @return string encoded data, as a string .
     */
    public static function encode(string $data): string
    {
        return \rtrim(\strtr(
            \base64_encode($data),
            static::BASE64_ORIGINAL_SYMBOLS,
            static::BASE64_REPLACE_SYMBOLS
        ), static::PADDING_SYMBOL);
    }

    /**
     * Decodes data encoded with MIME base64url.
     *
     * @param string $data Encoded data.
     * @param bool $strict [optional] Returns false if input contains character from outside the base64 alphabet.
     * @return string|bool the original data or false on failure. The returned data may be binary.
     */
    public static function decode(string $data, bool $strict = false)
    {
        return \base64_decode(\str_pad(
            \strtr($data, static::BASE64_REPLACE_SYMBOLS, static::BASE64_ORIGINAL_SYMBOLS),
            \strlen($data) % static::PADDING_SIZE,
            static::PADDING_SYMBOL,
            \STR_PAD_RIGHT
        ), $strict);
    }
}
