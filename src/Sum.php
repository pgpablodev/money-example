<?php

namespace Pablo\MoneyExample;

class Sum implements Expression
{
    public function __construct(
        public Expression $augend,
        public Expression $addend
    ) {
    }

    public function reduce(Bank $bank, string $currency): Money
    {
        return new Money(
            $this->augend->reduce($bank, $currency)->amount()
            + $this->addend->reduce($bank, $currency)->amount(),
            $currency
        );
    }

    public function plus(Expression $addend): Expression
    {
        return new Sum($this, $addend);
    }

    public function times(int $multiplier): Expression
    {
        return new Sum(
            $this->augend->times($multiplier),
            $this->addend->times($multiplier)
        );
    }
}