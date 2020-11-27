<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<main id="page_inscription" class="row valign-wrapper">
<div class="col m6  hide-on-small-only">
    <img src="./assets/images/inscription.jpg" alt="logo inscription" class="img-inscription">
</div>
<div class="col m6">
    <h3 class="center-align h1">Rejoignez-nous !</h3>

    <?= form_open('inscription') ?>
    <div class="input-field col s12">
        <label for="email">E-mail</label>
        <input type="email" name="email" class="validate" required>
        <span class="helper-text" data-error="mail incorrect" data-success="mail correct">Une adresse mail valide</span>
    </div>
    <div class="input-field col s12">
        <label for="entreprise">Entreprise</label>
        <input id="entreprise" type="text" name="entreprise" required>
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
<script>
    let password_repeat = document.querySelector("#password_repeat");
    let password = document.querySelector("#password");

    password_repeat.addEventListener('change', function(){

        let helper = document.querySelector("#helper_password_repeat");
        
        if(password.value !== password_repeat.value){
            helper.innerHTML = "Les mots de passe ne correspondent pas";
            helper.style.color = 'red';
        }else{
            helper.innerHTML = "";
        }

    })

    password.addEventListener('keypress', function(){

        let helper = document.querySelector("#helper_password");

        if(password.value.length >= 8 && password.value.length <= 16){
            helper.innerHTML = "Mot de passe correct";
            helper.style.color = 'green';
        }else{
            helper.innerHTML = "Mot de passe incorrect";
            helper.style.color = 'red';
        }
    })

</script>
<style>
    #page_inscription{
        display:flex;
    }
    .img-inscription{
        width:80%;
        height:auto;
    }
    .messages{
        margin-top: 10px;
    }
    .form-submit{
        text-align:right;
        width:100%;
    }
    @media screen and (max-width:600px){
        .form-submit{
            text-align: center;
        }
    }
</style>
