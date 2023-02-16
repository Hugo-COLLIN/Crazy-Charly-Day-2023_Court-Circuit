<?php

namespace iutnc\ccd\action;

use iutnc\ccd\auth\Auth;
use iutnc\ccd\exception\EmailNonExistsException;

class SigninAction extends Action {

    public function execute() : string {
        $html = "";
        if($_SERVER['REQUEST_METHOD'] === "GET") {
            $html = <<<HTML
            <div class="div-form-log">
                <form action="?action=${_GET['action']}" method="post" class="log-form">
                    <label>Email: </label><input type="text" name="email" placeholder="toto@gmail.com" required>
                    <label>Password: </label><input type="password" name="password" required>
                    <button type="submit">Validate</button>
                </form>
            </div>
            HTML;
        }
        elseif ($_SERVER['REQUEST_METHOD'] === "POST") {
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $passwd = filter_var($_POST['password']);
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