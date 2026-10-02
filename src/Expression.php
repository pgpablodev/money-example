<?php

namespace Pablo\MoneyExample;

interface Expression
{
    public function reduce(Bank $bank, string $currency): Money;

    public function plus(Expression $addend): Expression;

    public function times(int $multiplier): Expression;
}