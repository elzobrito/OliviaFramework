<?php

namespace OliviaRouter;

class TrieNode
{
    public $char;
    public $isEndOfWord;
    public $children;
    public $route;

    public function __construct($char)
    {
        $this->char = $char;
        $this->isEndOfWord = false;
        $this->children = [];
        $this->route = null;
    }
}
