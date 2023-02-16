<?php

namespace iutnc\ccd\action;

use iutnc\ccd\db\Commande;
use iutnc\ccd\db\ConnectionFactory;
use iutnc\ccd\Produit;
use iutnc\ccd\render\ErrorRenderer;
use iutnc\ccd\render\ListeCommandesRenderer;

class ListeCommandesAction extends Action
{
    private string $id;

    public function __construct() {
        parent::__construct();
        //$this->id = $id;
    }

    public function execute(): string
    {
        if (isset($_SESSION['user']) && unserialize($_SESSION['user'])->getRole() == 'admin')
            return ListeCommandesRenderer::render();
        else
            return ErrorRenderer::render();
    }
}