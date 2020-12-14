<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<main id="page_inscription" class="row valign-wrapper">
<div class="col m6  hide-on-small-only">
    <img src="<?= base_url() ?>/assets/images/inscription.jpg" alt="logo inscription" class="img-inscription">
</div>
<div class="col m6">
    <h3 class="center-align h1">Rejoignez-nous !</h3>

    <?= form_open('inscription') ?>
    <div class="input-field col s12">
        <label for="email">E-mail</label>
        <input type="email" name="email" class="validate" value="<?= $this->input->post('email') ?? null ?>" required>
        <span class="helper-text" data-error="mail incorrect" data-success="mail correct">Une adresse mail valide</span>
    </div>
    <div class="input-field col s12">
        <label for="entreprise">Entreprise</label>
        <input id="entreprise" type="text" name="entreprise" value="<?= $this->input->post('entreprise') ?? null ?>" required>
        <span class="helper-text">Le nom de votre entreprise</span>
    </div>
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
    <div class="form-submit col s-12 right-align">
        <button type="submit" class="waves-effect waves-light btn #0d47a1 blue darken-2  right-align">inscription</button>
        <div class="messages">
        <?= validation_errors('<div class="chip teal lighten-1 white-text">', '<i class="close material-icons">close</i></div><br>'); ?>
        <?= (isset($confirm)) ? "<p class='chip teal ligthen-1 white-text'>Un mail vient d'être envoyé</p>" : '' ?>
        </div>
    </div>

    <?= form_close(); ?>
</div>
</main>


