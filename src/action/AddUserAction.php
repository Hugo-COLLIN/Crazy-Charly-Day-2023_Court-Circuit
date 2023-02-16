<?php

namespace iutnc\ccd\action;

use iutnc\ccd\auth\Auth;
use iutnc\ccd\exception\EmailAlreadyRegistedException;
use iutnc\ccd\exception\NotStrengthPassWord;
use iutnc\ccd\exception\TooShortPasswordException;
use iutnc\ccd\db\ConnectionFactory;

class AddUserAction extends Action {

    public function execute() : string {
        $html = "";
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            $html = <<<HTML
                    <main class="main-signin">
                        <div class="form-group">
                            <div class="title">
                                <label for="register">S'inscrire</label>
                            </div>
                            <form id="creer_user" method="POST" action="?action=add-user">
                                <div class="form-item">
                                    <span class="form-item-icon material-symbols-rounded">email</span>
                                    <input type="email" name="email" placeholder="Entrez un email">
                                </div>
                                <br>
                                <div class="double-form-item">
                                    <div class="double-form-sous-item">
                                        <span class="form-item-icon material-symbols-rounded">lock</span>
                                        <input type="password" name="passwd" placeholder="Entrez un mot de passe">
                                    </div>
                                    <div class="double-form-sous-item">
                                        <span class="form-item-icon material-symbols-rounded">lock</span>
                                        <input type="password" name="passwd_confirm" placeholder="Confirmez votre mot de passe">
                                    </div>
                                </div>
                                <br>
                                <div class="form-item-other">
                                    <label for="signin"> <a href="index.php?action=signin">Vous avez déjà un compte ?</a></label>
                                    <button type="submit">S'inscire</button>
                                </div>
                            </form>
                        </div>
                    </main>
            HTML;
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $passwd = filter_var($_POST['passwd']);
            $passwd2 = filter_var($_POST['passwd_confirm']);
            if($passwd != $passwd2){
                $html = "<p>Les 2 mdp ne sont pas identiques</p>";
            }
            else
            {
                try {
                    if (!Auth::register($email, $passwd)) {
                        $html = "<p>Email non valide</p>";
                    }
                } catch (EmailAlreadyRegistedException $e) {
                    $html = "<p>Cet email est déjà utilisé</p>";
                } catch (TooShortPasswordException $e) {
                    $html = "<p>Mot de passe trop court (10 caractères minimum)</p>";
                } catch (NotStrengthPassWord $e) {
                    $html = "<p>Mot de passe pas assez protégé</p>";
                }
                if (Auth::authenticate($email, $passwd)) {
                    $html = "<p>You are connected</p>";
                    header("Location:index.php");
                }
            }
        }
        return $html;
    }

}