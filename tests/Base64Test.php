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
		$this->assertEquals(Base64::decode(Base64::encode($this->text)), $this->text);
	}

	public function testEncodingValidity() {
		$this->assertEquals(Base64::encode($this->text), $this->paddinglessEncodedText);
	}

	public function testUrlSafeness() {
		$this->assertNotEquals(Base64::encode($this->text, true), $this->encodedText);
		$this->assertEquals(Base64::encode($this->text, true), $this->urlSafeEncodedText);
	}

	public function testPadding() {
		$this->assertNotEquals(Base64::encode($this->text), $this->urlSafeEncodedText);
		$this->assertEquals(Base64::encode($this->text, true), $this->urlSafeEncodedText);
	}

	/**
	 * @expectedException InvalidArgumentException
	*/
	public function testException() {
		Base64::decode([1, 2, 3]);
		Base64::decode(42);
		Base64::decode(new Datetime());
	}

	public function testEmpty() {
		$this->assertEmpty(Base64::encode(""));
		$this->assertEmpty(Base64::decode(""));
	}
}
?>