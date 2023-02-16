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
            <div class="div-form-log">
            <form action="?action=${_GET['action']}" method="post" class="log-form">
                <label>Email: </label><input type="text" name="email" placeholder="toto@gmail.com" required>
                <label>Password: </label><input type="password" name="password" required>
                <label>Password: (verification) </label><input type="password" name="password2" required>
                <button type="submit">Validate</button>
            </form>
            </div>
            HTML;
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $passwd = filter_var($_POST['password']);
            $passwd2 = filter_var($_POST['password2']);
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