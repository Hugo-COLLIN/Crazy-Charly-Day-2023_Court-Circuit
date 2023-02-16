<?php

namespace iutnc\ccd\Header;
class Header{

    public static function afficger() : String{
        return '<header>
                <div class="nav-group-acceuil">
                    <div class="group-acceuil-center">
                        <h2 id="page-name">Court-circuit Nancy</h2>
                    </div>
                    <div class="group-acceuil-right">
                        <div class="nav-acceuil-item-catalogue">
                            <a href="?action=catalogue" title="Click & collect"><span class="material-symbols-rounded">shopping_cart</span></a>
                        </div>
                        <div class="nav-acceuil-item-account">
                            <a href="?action=profil" title="Mon compte"><span class="material-symbols-rounded">account_box</span></a>
                        </div>
                        <div class="nav-acceuil-item-logout">
                            <a href="?action=logout" title="Se déconnecter"><span class="material-symbols-rounded">logout</span></a>
                        </div>
                    </div>
                </div>
            </header>';
        }
}