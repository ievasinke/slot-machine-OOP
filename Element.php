<?php

class Element
{
    private string $symbol;
    private int $weight;

    public function __construct(string $symbol, int $weight)
    {
        $this->symbol = $symbol;
        $this->weight = $weight;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }
}