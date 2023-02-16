<?php

namespace iutnc\ccd\action;


use iutnc\ccd\render\ErrorRenderer;

class ErrorAction extends Action
{
    public function __construct() {
        parent::__construct();
    }

    public function execute(): String
    {
        return ErrorRenderer::render();
    }
}