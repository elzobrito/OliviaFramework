<?php

namespace OliviaRouter;

class Trie
{
    private $root;

    public function __construct()
    {
        $this->root = new TrieNode(null);
    }

    public function getRoutes()
    {
        $routes = [];
        $this->traverse($this->root, '', $routes);
        return $routes;
    }

    private function traverse($node, $prefix, &$routes)
    {
        if ($node->isEndOfWord) {
            $routes[] = [
                'pattern' => $prefix,
                'http_method' => $node->route['http_method'],
                'handler' => $node->route['handler']
            ];
        }

        foreach ($node->children as $char => $childNode) {
            $this->traverse($childNode, $prefix . '/' . $char, $routes);
        }
    }

    public function insert($segments, $route)
    {
        $currentNode = $this->root;
        foreach ($segments as $segment) {
            if (!isset($currentNode->children[$segment])) {
                $currentNode->children[$segment] = new TrieNode($segment);
            }
            $currentNode = $currentNode->children[$segment];
        }

        $currentNode->isEndOfWord = true;
        $currentNode->route = $route;
    }

    public function search($segments, $httpMethod)
    {
        $currentNode = $this->root;
        $routes = null;
        foreach ($segments as $segment) {
            if (isset($currentNode->children[$segment])) {
                $currentNode = $currentNode->children[$segment];
            } elseif (isset($currentNode->children['{param}'])) {
                $currentNode = $currentNode->children['{param}'];
            } else {
                return null;
            }
        }

        if ($currentNode->isEndOfWord && strtoupper($currentNode->route['http_method']) === strtoupper($httpMethod))
            $routes = [
                'char' => $currentNode->char,
                'route' => $currentNode->route ?? '',
                'middleware' => $currentNode->middleware ?? ''
            ];
        return $routes;
    }

    public function searchPrefix($prefix)
    {
        $currentNode = $this->root;

        if ($prefix)
            foreach ($prefix as $segment) {
                if (!isset($currentNode->children[$segment]))
                    return false;
                $currentNode = $currentNode->children[$segment];
                $routes = [
                    'char' => $currentNode->char,
                    'route' => $currentNode->route ?? '',
                    'middleware' => $currentNode->middleware ?? ''
                ];
                return $routes;
            }

        return false;
    }
}
