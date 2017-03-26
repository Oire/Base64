<?php
use Oire\Base64;
use PHPUnit\Framework\TestCase;

/**
 @requires php 7.1
*/

class Base64Test extends TestCase {
	protected $text;
	protected $encodedText;
	protected $urlSafeEncodedText;
	protected $paddinglessEncodedText;

	protected function setUp() {
		$this->text = "The quick brown fox jumps over the lazy dog";
		$this->encodedText = "VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZw==";
		$this->urlSafeEncodedText = "VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZw~~";
		$this->paddinglessEncodedText = "VGhlIHF1aWNrIGJyb3duIGZveCBqdW1wcyBvdmVyIHRoZSBsYXp5IGRvZw";
	}

	public function testDataEquality() {
		$this->assertSame(Base64::decode(Base64::encode($this->text)), $this->text);
	}

	public function testEncodingValidity() {
		$this->assertSame(Base64::encode($this->text), $this->paddinglessEncodedText);
	}

	public function testUrlSafeness() {
		$this->assertNotSame(Base64::encode($this->text, true), $this->encodedText);
		$this->assertSame(Base64::encode($this->text, true), $this->urlSafeEncodedText);
	}

	public function testPadding() {
		$this->assertNotSame(Base64::encode($this->text), $this->urlSafeEncodedText);
		$this->assertSame(Base64::encode($this->text, true), $this->urlSafeEncodedText);
	}

	/**
	 * @expectedException \InvalidArgumentException
	*/
	public function testInvalidArgumentException() {
		Base64::decode([1, 2, 3]);
		Base64::decode(42);
		Base64::decode(new Datetime());
	}

	/**
	 * @expectedException \Exception
	*/
	function testNonBase64Alphabet() {
		Base64::decode(random_bytes(32));
	}
	
	public function testEmpty() {
		$this->assertEmpty(Base64::encode(""));
		$this->assertEmpty(Base64::decode(""));
	}
}
?>