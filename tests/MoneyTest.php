<?php

namespace Pablo\MoneyExample\Tests;

use PHPUnit\Framework\TestCase;
use \Pablo\MoneyExample\Money;
use \Pablo\MoneyExample\Bank;
use \Pablo\MoneyExample\Sum;

class MoneyTest extends TestCase
{
    public function testMultiplication(): void
    {
        $five = Money::dollar(5);

        $product = $five->times(2);

        self::assertEquals(Money::dollar(10), $product);
    }

    public function testMultiplicationByThree(): void
    {
        $five = Money::dollar(5);

        $product = $five->times(3);

        self::assertEquals(Money::dollar(15), $product);
    }

    public function testEquality(): void
    {
        self::assertTrue(
            Money::dollar(5)->equals(Money::dollar(5))
        );

        self::assertFalse(
            Money::dollar(5)->equals(Money::dollar(6))
        );

        self::assertFalse(
            Money::dollar(5)->equals(Money::franc(5))
        );
    }

    public function testCurrency(): void
    {
        $five = Money::dollar(5);

        self::assertEquals('USD', $five->currency());
    }

    public function testFrancMultiplication(): void
    {
        $five = Money::franc(5);

        $product = $five->times(2);

        self::assertTrue($product->equals(Money::franc(10)));
    }

    public function testAddition(): void
    {
        $bank = new Bank();

        $sum = Money::dollar(5)->plus(Money::dollar(5));

        $reduced = $sum->reduce($bank, 'USD');

        self::assertTrue(
            $reduced->equals(Money::dollar(10))
        );
    }

    public function testSumStoresAugendAndAddend(): void
    {
        $five = Money::dollar(5);

        $sum = $five->plus($five);

        self::assertSame($five, $sum->augend);
        self::assertSame($five, $sum->addend);
    }

    public function testReduceMoney(): void
    {
        $bank = new Bank();

        $result = Money::dollar(5)->reduce($bank, 'USD');

        self::assertTrue(
            $result->equals(Money::dollar(5))
        );
    }

    public function testRate(): void
    {
        $bank = new Bank();
        $bank->addRate('CHF', 'USD', 2);

        self::assertEquals(2, $bank->rate('CHF', 'USD'));
    }

    public function testReduceMoneyDifferentCurrency(): void
    {
        $bank = new Bank();
        $bank->addRate('CHF', 'USD', 2);

        $result = Money::franc(10)->reduce($bank, 'USD');

        self::assertTrue(
            $result->equals(Money::dollar(5))
        );
    }

    public function testMixedAddition(): void
    {
        $fiveBucks = Money::dollar(5);
        $tenFrancs = Money::franc(10);

        $bank = new Bank();
        $bank->addRate('CHF', 'USD', 2);

        $sum = $fiveBucks->plus($tenFrancs);

        $result = $sum->reduce($bank, 'USD');

        self::assertTrue(
            $result->equals(Money::dollar(10))
        );
    }

    public function testSumPlusMoney(): void
    {
        $fiveBucks = Money::dollar(5);
        $tenFrancs = Money::franc(10);

        $bank = new Bank();
        $bank->addRate('CHF', 'USD', 2);

        $sum = new Sum($fiveBucks, $tenFrancs);
        $sum = $sum->plus($fiveBucks);

        $result = $sum->reduce($bank, 'USD');

        $this->assertTrue($result->equals(Money::dollar(15)));
    }

    public function testSumTimes(): void
    {
        $fiveBucks = Money::dollar(5);
        $tenFrancs = Money::franc(10);

        $bank = new Bank();
        $bank->addRate('CHF', 'USD', 2);

        $sum = new Sum($fiveBucks, $tenFrancs);
        $sum = $sum->times(2);

        $result = $sum->reduce($bank, 'USD');

        $this->assertTrue($result->equals(Money::dollar(20)));
    }
}