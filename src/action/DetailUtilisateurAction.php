<?php

namespace iutnc\ccd\action;

use iutnc\ccd\db\Commande;
use iutnc\ccd\db\ConnectionFactory;
use iutnc\ccd\Produit;
use iutnc\ccd\render\ListeCommandesRenderer;

class DetailUtilisateurAction extends Action
{
    private string $id;

    public function __construct() {
        parent::__construct();
        //$this->id = $id;
    }

    public function execute(): string
    {
        return ListeCommandesRenderer::render();
    }
}