<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<main class="container">
    <h2 class="center-align">Acceder à votre compte</h2>

    <?= form_open('connexion/index') ?>
    <div class="input-field col s12">
        <label for="email">Adresse mail</label>
        <input type="email" name="email" required>
    </div>
    <div class="input-field col s12">
        <label for="password">Mot de passe</label>
        <input id="password" type="password" name="password" data-length="10" required>
    </div>
    <div class="submit col s-12 left-align">
        <button type="submit" class="waves-effect waves-light btn #0d47a1 blue darken-2">connexion</button>
    </div>

    <div class="password_reset right-align">
        <a href="#">Mot de passe oublié ?</a>
    </div>
    <? if(isset($msg)){?>
        <div class="chip teal lighten-1 white-text">
            <?= $msg ?>
            <i class="close material-icons">close</i>
        </div>
    <?}?>
    <? form_close() ?>
</main>
<style>
    .password_reset{
        margin-top: 10px;
    }
    @media screen and (max-width:600px){
        .submit{
            text-align: center;
        }
    }
</style>