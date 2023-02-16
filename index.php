<?php
declare(strict_types=1);
require_once "vendor/autoload.php";


use iutnc\ccd\action\CatalogueAction;
use iutnc\ccd\db\ConnectionFactory;
use iutnc\ccd\dispatch\Dispatcher;
use iutnc\ccd\header\Html;

session_start();
ConnectionFactory::setConfig("DBConfig.ini");
//Si l'utilisateur est connecté, on affiche la page qui propose d'afficher le catalogue

if (isset($_GET['action'])) {
    $dispatcher = new Dispatcher($_GET['action']);
    $dispatcher->run();
}else {
    $catalogue = new CatalogueAction();
    $html = Html::afficherHtml() . Html::afficherHeader() . $catalogue->execute() .'</body>
            </html>';
    echo $html;
}
