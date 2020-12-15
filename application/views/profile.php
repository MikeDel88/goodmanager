<section class="container">
<? if($this->session->admin == true){?>
    <fieldset class='row'>
        <legend>L'entreprise</legend>
        <div class="container">
            <?= form_open("profil/entreprise") ?>
                <div class="input-field">
                    <label for="name-entreprise">Nom</label>
                    <input id="name-entreprise" type="text" name="nom" value="<?= ucfirst($entreprise->nom) ?>">
                </div>
                <div class="input-field">
                    <label for="adresse-entreprise">Adresse</label>
                    <input id="adresse-entreprise" type="text" name="adresse" value="<?= $entreprise->adresse ?>">
                </div>
                <div class="input-field">
                    <label for="code-entreprise">Code postal</label>
                    <input id="code-entreprise" type="text" name="code_postal" value="<?= $entreprise->code_postal ?>">
                </div>
                <div class="input-field">
                    <label for="ville-entreprise">Ville</label>
                    <input id="ville-entreprise" type="text" name="ville" value="<?= ucfirst($entreprise->ville) ?>">
                </div>
                <div class="form-submit">
                    <button class="btn" type="submit">Mettre à jour</button>
                </div>
                <?= (isset($msg) && $msg == 'error') ? "<span class='red-text'>Erreur sur le nom de l'entreprise</span>" : null ?>
            <?= form_close() ?>
        </div>
    </fieldset>
<?}?>
    <fieldset class='row'>
        <legend>Mon Profil</legend>
        <div class="container">
            <?= form_open("profil/user") ?>
                <div class="input-field">
                    <label for="email-user">Email</label>
                    <input id="email-user" type="email" name="email" value="<?= $user->email ?>">
                </div>
                <div class="input-field">
                    <label for="nom-user">Nom</label>
                    <input id="nom-user" type="text" name="nom" value="<?= ucfirst($user->nom) ?>">
                </div>
                <div class="input-field">
                    <label for="prenom-user">Prénom</label>
                    <input id="prenom-user" type="text" name="prenom" value="<?= ucfirst($user->prenom) ?>">
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