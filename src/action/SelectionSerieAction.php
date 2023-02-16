<?php

namespace iutnc\sae\action;

use iutnc\sae\media\Serie;

class SelectionSerieAction extends Action{

    private string $id;
    private bool $catalogue;

    public function __construct(string $id, bool $catalogue = false) {
    parent::__construct();
    $this->id = $id;
    $this->catalogue = $catalogue;
    }

    public function execute(): string{
        return Serie::afficher($this->id, $this->catalogue);
    }
}