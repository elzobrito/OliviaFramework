<?php

namespace OliviaFrameApp\Middleware;

use OliviaFrameApp\Abstracts\AbstractController;
use OliviaRouter\RequestHandler;

class MidAbrir extends AbstractController implements RequestHandler
{
    public function handle()
    {
        echo 'executou';
    }
}