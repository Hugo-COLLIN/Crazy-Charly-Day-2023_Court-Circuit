<?php

namespace iutnc\ccd\action;

use iutnc\ccd\auth\Auth;
use iutnc\ccd\exception\EmailNonExistsException;

class SigninAction extends Action {

    public function execute() : string {
        $html = "";
        if($_SERVER['REQUEST_METHOD'] === "GET") {
            $html = <<<HTML
                    <main class="main-signin">
                        <div class="form-group">
                            <div class="title">
                                <label for="signin">Se connecter</label>
                            </div>
                            <form id="signin-form" method="POST" action="?action={$_GET['action']}">
                                <div class="form-item">
                                    <span class="form-item-icon material-symbols-rounded">email</span>
                                    <input type="email" name="email" placeholder="Entrez un email">
                                </div>
                                <br>
                                <div class="form-item">
                                    <span class="form-item-icon material-symbols-rounded">lock</span>
                                    <input type="password" name="passwd" placeholder="Entrez mot de passe">
                                </div>
                                <br>
                                <div class="form-item-other">
                                    <button type="submit" id="item-button-connection">Se connecter</button>
                                    <label for="forgotpasswd">Vous n'avez pas encore de compte ?</label>
                                    <label id="add-account" "><a href='?action=add-user'">Créez le ici</a></label>
                                </div>
                            </form>
                        </div>
                    </main>
            HTML;
        }
        elseif ($_SERVER['REQUEST_METHOD'] === "POST") {
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $passwd = filter_var($_POST['passwd'], FILTER_SANITIZE_STRING);
            try {
                if (Auth::authenticate($email, $passwd)) {
                    $html = "<p>You are connected</p>";
                    header("Location:index.php");
                } else {
                    $html = "<p>Email or password incorrect</p>";
                }
            } catch (EmailNonExistsException $e) {
                $html.= "<p>Email or password incorrect</p>";
            }
        }
        return $html;
    }
}