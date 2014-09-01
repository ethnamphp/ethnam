<?php

class UtilTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function checkMailAddressValid()
    {
        $this->assertTrue(Ethna_Util::checkMailAddress('hoge@fuga.net'));
        $this->assertTrue(Ethna_Util::checkMailAddress('-hoge@fuga.net'));
        $this->assertTrue(Ethna_Util::checkMailAddress('.hoge@fuga.net'));
        $this->assertTrue(Ethna_Util::checkMailAddress('+hoge@fuga.net'));
    }

    /**
     * @test
     */
    public function checkMailAddressInvalid()
    {
        // @がない
        $this->assertFalse(Ethna_Util::checkMailAddress('hogefuga.net'));
        // @の前に文字がない
        $this->assertFalse(Ethna_Util::checkMailAddress('@hogefuga.net'));

        // @の後に文字がない
        $this->assertFalse(Ethna_Util::checkMailAddress('hogefuga.net@'));
        // 先頭文字が許されていない
        $this->assertFalse(Ethna_Util::checkMailAddress('%hoge@fuga.net'));

        // 末尾文字が不正
        $this->assertFalse(Ethna_Util::checkMailAddress('hoge@fuga.net.'));
    }
}
