<?php
namespace Oire\Base64;

use Oire\Base64\Exception\Base64Exception;

/**
 * Oirë URL-safe BASE64 handling
 * Copyright © 2017-2021, Andre Polykanine also known as Menelion Elensúlë, the Magical Kingdom of Oirë, https://github.com/Oire
 *  Portions copyright © 2016 Paragon Initiative Enterprises.
 *  Portions copyright © 2014 Steve "Sc00bz" Thomas (steve at tobtu dot com)
 *
 *  Permission is hereby granted, free of charge, to any person obtaining a copy
 *  of this software and associated documentation files (the "Software"), to deal
 *  in the Software without restriction, including without limitation the rights
 *  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *  copies of the Software, and to permit persons to whom the Software is
 *  furnished to do so, subject to the following conditions:
 *
 *  The above copyright notice and this permission notice shall be included in all
 *  copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 *  SOFTWARE.
 */

class Base64
{
    private const WHAT = '+/'; // Characters to be replaced
    private const WITH = '-_'; // Characters to replace with
    private const EXT_WHAT = '+/='; // With equals signs
    private const EXT_WITH = '-_~';

    /**
     * Encoding into URL-safe Base64.
     * @param  string  $data The data to be encoded
     * @return string The encoded data or an empty string on failure
     */
    public static function encode(string $data, bool $replaceEquals = false): string
    {
        $b64 = base64_encode($data);

        return $replaceEquals ? strtr($b64, self::EXT_WHAT, self::EXT_WITH) : strtr(rtrim($b64, '='), self::WHAT, self::WITH);
    }

    /**
     * Decoding from URL-safe Base64.
     * @param  string          $data The data to be decoded
     * @throws Base64Exception if decoding from Base64 fails
     * @return mixed           Returns decoded data or an empty string on failure
     */
    public static function decode(string $data)
    {
        $result = base64_decode(strtr($data, self::WITH, self::WHAT), true);

        if ($result === false) {
            throw new Base64Exception('Base64 decoding failed.');
        }

        return $result;
    }
}
