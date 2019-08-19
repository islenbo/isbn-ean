<?php

namespace Test;

use IsbnEan\Transfer;
use PHPUnit\Framework\TestCase;

class TransferTest extends TestCase
{

    public function testEan2Isbn()
    {
        list($isbn, $err) = Transfer::getInstance()->ean2Isbn('9787121287985');
        var_dump($isbn);
        $this->assertNull($err);
    }

    public function testIsbn2Ean()
    {
        list($ean, $err) = Transfer::getInstance()->isbn2Ean('7121287986');
        var_dump($ean);
        $this->assertNull($err);
    }

}