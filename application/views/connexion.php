<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<main id="page_connexion" class="row valign-wrapper">
<div class="col m6">
    <h3 class="center-align">Acceder à votre compte</h3>

    <?= form_open('connexion/index') ?>
    <div class="input-field col s12">
        <label for="email">Adresse mail</label>
        <input type="email" name="email" required>
    </div>
    <div class="input-field col s12">
        <label for="password">Mot de passe</label>
        <input id="password" type="password" name="password" data-length="10" required>
    </div>
    <div class="form-submit col s-12">
        <button type="submit" class="waves-effect waves-light btn #0d47a1 blue darken-2">connexion</button>
    </div>
    <?= form_close(); ?>

    <div class="password_reset right-align">
        <a href="#modal1" class="modal-trigger">Mot de passe oublié ?</a>
    </div>
    <? if(isset($msg)){?>
        <div class="chip teal lighten-1 white-text">
            <?= $msg ?>
            <i class="close material-icons">close</i>
        </div>
    <?}?>

</div>
<div class="col m6  hide-on-small-only">
    <img src="./assets/images/connexion.jpg" alt="logo connexion" class="img-connexion">
</div>
</main>
<div id="modal1" class="modal">
    <?= form_open('connexion/reset-password') ?>
        <div class="modal-content container">
            <h4 class="center-align">Réinitialiser le mot de passe</h4>
            <div class="input-field col s12">
                <label for="email">Adresse mail</label>
                <input type="email" name="email" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type='submit' class="center-align waves-effect waves-light btn #0d47a1 blue darken-2">Envoyer</button>
        </div>
    <?= form_close() ?>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let elems = document.querySelectorAll('.modal');
        let instances = M.Modal.init(elems);
    });
</script>
<style>
    #page_connexion{
        display:flex;
    }
    .img-connexion{
        width:100%;
        height:auto;
    }
    .password_reset{
        margin-top: 10px;
    }
    .modal .modal-footer{
        text-align:center;
    }
    .form-submit{
        width:100%;
    }
    @media screen and (max-width:600px){
        .form-submit, .password_reset{
            text-align: center;
            margin: 10px 0;
        }
    }
</style>