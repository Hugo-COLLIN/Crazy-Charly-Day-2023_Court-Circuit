<?php

namespace iutnc\ccd\action;

use iutnc\ccd\Produit;

class SelectionProduitAction extends Action{

    private string $id;

    public function __construct(string $id) {
        parent::__construct();
        $this->id = $id;
    }

    public function execute(): string{
        return Produit::afficher($this->id);
    }
}