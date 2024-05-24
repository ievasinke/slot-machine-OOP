<?php

require_once 'Element.php';

class Board
{
    private int $columns;
    private array $elements;
    private array $grid;
    private int $rows;


    public function __construct(array $elements, int $rows = 3, int $columns = 5)
    {
        $this->elements = $elements;
        $this->rows = $rows;
        $this->columns = $columns;
        $this->grid = [];
    }

    private function weightedSample(): string
    {
        $totalWeight = array_sum(array_map(fn($e) => $e->getWeight(), $this->elements));
        $randomIndex = mt_rand(1, $totalWeight);
        foreach ($this->elements as $element) {
            $randomIndex -= $element->getWeight();
            if ($randomIndex <= 0) {
                return $element->getSymbol();
            }
        }
        return key($this->elements[0]->getSymbol());
    }

    public function generateBoard(): void
    {
        for ($row = 0; $row < $this->rows; $row++) {
            for ($column = 0; $column < $this->columns; $column++) {
                $this->grid[$row][$column] = $this->weightedSample();
            }
        }
    }

    public function displayBoard(): void
    {
        foreach ($this->grid as $row) {
            foreach ($row as $column) {
                echo " $column";
            }
            echo PHP_EOL;
        }
    }

    public function getGrid(): array
    {
        return $this->grid;
    }
}