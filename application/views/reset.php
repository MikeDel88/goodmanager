<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<main id="page_reset" class="container">
    <h3 class="center-align">Réinitialisaton du mot de passe</h3>
    <?= form_open("reset/$token") ?>
    <div class="input-field col s12">
        <label for="password">Mot de passe</label>
        <input id="password" type="password" name="password" data-length="10" required>
        <span id="helper_password" class="helper-text">Entre 8 et 16 caractères</span>
    </div>
    <div class="input-field col s12">
        <label for="password_repeat">Confirmation du mot de passe</label>
        <input id="password_repeat" type="password" name="password_repeat" required>
        <span id="helper_password_repeat" class="helper-text">Confimer le mot de passe</span>
    </div>
    <div class="form-submit col s-12">
        <button type="submit" class="waves-effect waves-light btn #0d47a1 blue darken-2">Réinitialiser</button>
        <div class="messages">
        <?= validation_errors('<div class="chip teal lighten-1 white-text">', '<i class="close material-icons">close</i></div><br>'); ?>
        </div>
    </div>
    <?= form_close() ?>
</main>
