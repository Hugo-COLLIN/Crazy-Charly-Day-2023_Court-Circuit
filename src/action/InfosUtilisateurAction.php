<?php

namespace iutnc\ccd\action;

use iutnc\ccd\db\Commande;
use iutnc\ccd\db\ConnectionFactory;
use iutnc\ccd\Produit;
use iutnc\ccd\render\InfosUtilsateurRenderer;
use iutnc\ccd\render\ListeCommandesRenderer;
use iutnc\ccd\render\ListeUtilsateursRenderer;

class InfosUtilisateurAction extends Action
{
    private string $id;

    public function __construct($id) {
        parent::__construct();
        $this->id = $id;
    }

    public function execute(): string
    {
        return InfosUtilsateurRenderer::render($this->id);
    }
}