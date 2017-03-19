<?php
namespace Oire;

/**
 * Oirë URL-safe BASE64 handling
 * Copyright © 2017 Andre Polykanine also known as Menelion Elensúlë, The magical kingdom of Oirë, https://github.com/Oire
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

/**
 * Class Base64
 * URL-and filename-safe BASE64 encoding and decoding
 * @package Base64
*/
class Base64 {
	private const WHAT = "+/"; // Characters to be replaced
	private const WITH = "-_"; // Characters to replace with
	private const EXT_WHAT = "+/="; // With equals signs
	private const EXT_WITH = "-_~";

	/**
	 * Encoding into URL-safe Base64.
	 * @param mixed $data The data to be encoded
	 * @param bool $replaceEquals=false whether to replace the equals signs. If set to true, padding equals signs will be replaced to tildes. If set to false (default), the equals signs will be truncated
	 * @return string The encoded data or an empty string on failure
	 * @throws \Exception if encoding to Base64 fails
	*/
	public static function encode($data, $replaceEquals = false) {
		if (empty($data)) {
			return '';
		}
		$b64 = base64_encode($data);
		if ($b64) {
			$res = $replaceEquals? strtr($b64, self::EXT_WHAT, self::EXT_WITH): strtr(rtrim($b64, "="), self::WHAT, self::WITH);
			return $res;
		} else { // base64_encode() returned false
			throw new \Exception("Base64 encoding failed.");
		}
	}

	/**
	 * Decoding from URL-safe Base64.
	 * @param string $data The data to be decoded
	 * @return mixed Returns decoded data or an empty string on failure
	 * @throws \Exception if decoding from Base64 fails
	 * @throws \InvalidArgumentException if the provided data is not a string
	*/
	public static function decode($data) {
		if (!is_string($data)) {
			throw new \InvalidArgumentException("The base64-encoded data must be a string.");
		}
		if (empty($data)) {
			return '';
		}
		$res = base64_decode(strtr($data, self::WITH, self::WHAT));
		if (!$res) {
			throw new \Exception("Base64 decoding failed.");
			return '';
		} else {
			return $res;
		}
	}
}
?>