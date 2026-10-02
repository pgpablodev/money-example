<?php

namespace Pablo\MoneyExample;

class Bank
{
    private array $rates = [];

    public function addRate(string $from, string $to, int $rate): void
    {
        $this->rates[$from . '_' . $to] = $rate;
    }

    public function rate(string $from, string $to): int
    {
        return $this->rates[$from . '_' . $to] ?? 1;
    }
}