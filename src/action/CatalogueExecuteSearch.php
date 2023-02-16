<?php

namespace iutnc\ccd\action;

class CatalogueExecuteSearch extends Action
{
    private CatalogueSearchAction $classe;
    private string $chaine;

    public function __construct(CatalogueSearchAction $classe, string $ch)
    {
        parent::__construct();
        $this->classe = $classe;
        $this->chaine = $ch;
    }

    public function execute(): string
    {
        return $this->classe->executeWithArg($this->chaine);
    }
}