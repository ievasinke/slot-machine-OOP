<?php

require_once 'Board.php';
require_once 'Element.php';
require_once 'Pattern.php';

class Game
{
    private array $elements;
    private array $patterns;
    private int $betTokenBase;
    private int $totalTokens;
    private Board $board;


    public function __construct(array $elements, array $patterns, int $betTokenBase = 5)
    {
        $this->elements = $elements;
        $this->patterns = $patterns;
        $this->betTokenBase = $betTokenBase;
    }

    public function start(): void
    {
        echo "Welcome! Let's play a game.\n";
        $this->totalTokens = (int)readline("Enter amount of tokens to play: ");
        $betTokens = $this->getBet();
        while ($this->totalTokens >= $betTokens) {
            $this->totalTokens -= $betTokens;
            $this->board = new Board($this->elements);
            $this->board->generateBoard();
            $this->board->displayBoard();

            $winningAmount = $this->getWinningPatterns($betTokens);

            if ($winningAmount > 0) {
                echo "You won $winningAmount\n";
            } else {
                echo "No winning pattern found\n";
            }
            echo "Tokens left: $this->totalTokens\n";

            if ($this->totalTokens >= $betTokens) {
                $choice = (int)readline("Do you want to continue (1), change the bet (2), anything to exit: ");
                if ($choice === 2) {
                    $betTokens = $this->getBet();
                } elseif ($choice !== 1) {
                    break;
                }
            } else {
                break;
            }
        }
        exit("Thank you for playing!\n");
    }

    private function getBet(): int
    {
        echo "Minimum for the BET are 5 tokens.\n";
        echo "1 to place as a single BET.\n";
        echo "2 to double the BET.\n";
        echo "3 to triple the BET etc.\n";
        $betMultiplier = (int)readline("Enter number to multiply the BET: ");
        $betTokens = $this->betTokenBase * $betMultiplier;
        echo "Your BET is $betTokens tokens.\n";
        if ($betMultiplier < 1 || $betTokens > $this->totalTokens) {
            exit("Game over. See you soon!\n");
        }
        return $betTokens;
    }

    private function getWinningPatterns(int $betTokens): int
    {
        $winningAmount = 0;
        $grid = $this->board->getGrid();
        foreach ($this->patterns as $pattern) {
            $winningElements = [];

            foreach ($pattern->getCoordinates() as $coordinate) {
                list($row, $column) = $coordinate;
                $winningElements[] = $grid[$row][$column];
            }
            if (count(array_count_values($winningElements)) === 1) {
                $symbol = $winningElements[0];
                $weight = array_filter($this->elements, fn($e) => $e->getSymbol() === $symbol)[0]->getWeight();
                $winningAmount += round((30 * $betTokens) / $weight);
                $this->totalTokens += $winningAmount;
            }
        }
        return $winningAmount;
    }
}