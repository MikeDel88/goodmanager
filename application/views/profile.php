<section class="container">
    <fieldset class='row'>
        <legend>L'entreprise</legend>
        <div class="container">
            <?= form_open("profil/entreprise") ?>
                <div class="input-field">
                    <label for="name-entreprise">Nom</label>
                    <input id="name-entreprise" type="text" name="name" value="<?= ucfirst($entreprise->name) ?>">
                </div>
                <div class="input-field">
                    <label for="adresse-entreprise">Adresse</label>
                    <input id="adresse-entreprise" type="text" name="address" value="<?= $entreprise->address ?>">
                </div>
                <div class="input-field">
                    <label for="code-entreprise">Code postal</label>
                    <input id="code-entreprise" type="text" name="zipcode" value="<?= $entreprise->zipcode ?>">
                </div>
                <div class="input-field">
                    <label for="city-entreprise">Ville</label>
                    <input id="city-entreprise" type="text" name="city" value="<?= ucfirst($entreprise->city) ?>">
                </div>
                <div class="form-submit">
                    <button class="btn" type="submit">Mettre à jour</button>
                </div>
            <?= form_close() ?>
        </div>
    </fieldset>
    <fieldset class='row'>
        <legend>Mon Profil</legend>
        <div class="container">
            <?= form_open("profil/user") ?>
                <div class="input-field">
                    <label for="email-user">Email</label>
                    <input id="email-user" type="email" name="email" value="<?= $user->email ?>">
                </div>
                <div class="input-field">
                    <label for="last_name-user">Nom</label>
                    <input id="last_name-user" type="text" name="last_name" value="<?= ucfirst($user->last_name) ?>">
                </div>
                <div class="input-field">
                    <label for="first_name-user">Prénom</label>
                    <input id="first_name-user" type="text" name="first_name" value="<?= ucfirst($user->first_name) ?>">
                </div>
                <div class="form-submit">
                    <button class="btn" type="submit">Mettre à jour</button>
                </div>
            <?= form_close() ?>
            <p class="right-align form-submit"><a href="#delete-compte" class="modal-trigger">Supprimer mon compte</a></p>
        </div>   
    </fieldset>
    <div id="delete-compte" class="modal">
        <div class="modal-content">
            <h4>Suppression du compte</h4>
            <p>La suppression de votre compte sera définitive</p>
        </div>
        <div class="modal-footer">
            <a href="/profil/delete" class="waves-effect waves-green btn-flat">Confirmer</a>
        </div>
    </div>
</section>