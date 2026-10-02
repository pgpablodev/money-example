<?php

namespace Pablo\MoneyExample;

class Money implements Expression{
    protected int $amount;
    protected string $currency;

    public function __construct(int $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function amount(): int
    {
        return $this->amount;
    }

    public static function dollar(int $amount): Money
    {
        return new Money($amount, 'USD');
    }

    public static function franc(int $amount): Money
    {
        return new Money($amount, 'CHF');
    }

    public function equals(Money $money): bool
    {
        return $this->amount === $money->amount
        && $this->currency() === $money->currency();
    }

    public function currency(): string
    {
        return $this->currency;
    }

    public function times(int $multiplier): Expression{
        return new Money(
            $this->amount * $multiplier,
            $this->currency
        );
    }

    public function plus(Expression $addend): Expression
    {
        return new Sum($this, $addend);
    }

    public function reduce(Bank $bank, string $currency): Money
    {
        $rate = $bank->rate($this->currency, $currency);

        return new Money(
            $this->amount / $rate,
            $currency
        );
    }
}