<?php

require_once 'Element.php';
require_once 'Game.php';
require_once 'Pattern.php';

$elements = [
    new Element("$", 1),
    new Element("*", 13),
    new Element("+", 4),
    new Element("M", 7),
    new Element("#", 2),
    new Element("=", 15),
    new Element("@", 24)
];

$patterns = [
    new Pattern([[0, 0], [0, 1], [0, 2], [0, 3], [0, 4]]),
    new Pattern([[1, 0], [1, 1], [1, 2], [1, 3], [1, 4]]),
    new Pattern([[2, 0], [2, 1], [2, 2], [2, 3], [2, 4]]),
    new Pattern([[0, 0], [1, 1], [2, 2], [1, 3], [0, 4]]),
    new Pattern([[2, 0], [1, 1], [0, 2], [1, 3], [2, 4]]),
    new Pattern([[1, 0], [0, 1], [0, 2], [0, 3], [1, 4]]),
    new Pattern([[1, 0], [2, 1], [2, 2], [2, 3], [1, 4]]),
    new Pattern([[0, 0], [1, 1], [1, 2], [1, 3], [0, 4]]),
    new Pattern([[2, 0], [1, 1], [1, 2], [1, 3], [2, 4]]),
    new Pattern([[0, 0], [1, 1], [0, 2], [1, 3], [0, 4]]),
    new Pattern([[1, 0], [0, 1], [1, 2], [0, 3], [1, 4]]),
    new Pattern([[2, 0], [1, 1], [2, 2], [1, 3], [2, 4]]),
    new Pattern([[1, 0], [2, 1], [1, 2], [2, 3], [1, 4]]),
    new Pattern([[2, 0], [2, 1], [1, 2], [0, 3], [0, 4]]),
    new Pattern([[0, 0], [0, 1], [1, 2], [2, 3], [2, 4]])
];

$game = new Game($elements, $patterns);
$game->start();
