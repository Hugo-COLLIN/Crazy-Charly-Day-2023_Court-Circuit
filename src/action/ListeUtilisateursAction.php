<?php

namespace iutnc\ccd\action;

use iutnc\ccd\db\Commande;
use iutnc\ccd\db\ConnectionFactory;
use iutnc\ccd\Produit;
use iutnc\ccd\render\ErrorRenderer;
use iutnc\ccd\render\InfosUtilsateurRenderer;
use iutnc\ccd\render\ListeCommandesRenderer;
use iutnc\ccd\render\ListeUtilsateursRenderer;

class ListeUtilisateursAction extends Action
{
    private string $id;

    public function __construct() {
        parent::__construct();
    }

    public function execute(): string
    {
        if (isset($_SESSION['user']) && unserialize($_SESSION['user'])->getRole() == 'admin')
            return ListeUtilsateursRenderer::render();
        else
            return ErrorRenderer::render();
    }
}