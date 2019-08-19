<?php

namespace IsbnEan;

class Transfer
{
    const ISBN_PREFIX_978 = '978';

    const ISBN_PREFIX_979 = '979';

    /**
     * Instance
     * @return Transfer
     */
    public static function getInstance(): self
    {
        return new self();
    }

    public function isbn13(string $isbn10): string
    {
        // TODO ISBN-10 transfer ISBN-13
    }

    public function isbn10(string $isbn13): string
    {
        // TODO ISBN-10 transfer ISBN-13
    }

    /**
     * ISBN code to EAN code
     * @param string $isbn
     * @param string $prefix
     * @return array
     */
    public function isbn2Ean(string $isbn, string $prefix = self::ISBN_PREFIX_978): array
    {
        $verifyCode = substr($isbn, -1);
        $isbn = substr($isbn, 0, strlen($isbn) - 1);
        if ($this->isbnVerifyCode($isbn) == $verifyCode) {
            $ean = $prefix . $isbn;
            $ean .= $this->eanVerifyCode($ean);

            return [$ean, null];
        } else {
            return [null, 'illegal isbn code'];
        }
    }

    /**
     * EAN code to ISBN code
     * @param string $ean
     * @return array
     */
    public function ean2Isbn(string $ean): array
    {
        if (strlen($ean) == 13 && in_array(substr($ean, 0, 3), [self::ISBN_PREFIX_978, self::ISBN_PREFIX_979])) {
            $verifyCode = substr($ean, -1);
            $ean = substr($ean, 0, strlen($ean) - 1);
            if ($this->eanVerifyCode($ean) == $verifyCode) {
                $isbn = substr($ean, 3, 9);
                $isbn .= $this->isbnVerifyCode($isbn);

                return [$isbn, null];
            } else {
                return [null, 'illegal ean code'];
            }
        } else {
            return [null, 'unknown ean code'];
        }
    }

    /**
     * ISBN verify code
     * @param string $isbn
     * @return int
     */
    private function isbnVerifyCode(string $isbn): int
    {
        $sub = 0;
        for ($i = 0; $i < 9; $i++) {
            $sub += intval(substr($isbn, $i, 1)) * ($i + 1);
        }
        $mod = $sub % 11;
        return $mod;
    }

    /**
     * EAN verify code
     * @param string $ean
     * @return int
     */
    private function eanVerifyCode(string $ean): int
    {
        $len = strlen($ean);
        $oddSum = 0;
        $evenSum = 0;
        for ($i = 1; $i <= $len; $i++) {
            $num = substr($ean, $len - $i, 1);

            if ($i % 2 == 0) {
                $evenSum += $num;
            } else {
                $oddSum += $num;
            }
        }

        $sum = $oddSum * 3 + $evenSum;

        return $sum % 10;
    }

}