<section class="container">
    <fieldset class='row'>
        <legend><?= "$client->last_name $client->first_name"?></legend>
        <div class="container">
            <?= form_open("fiche-client/modification") ?>
                <input type="hidden" name="id" value="<?= $client->id ?>">
                <div class="input-field">
                    <label for="last_name-client">Nom</label>
                    <input id="last_name-client" type="text" name="last_name"  value="<?= ucFirst($client->last_name) ?>" required>
                </div>
                <div class="input-field">
                    <label for="first_name-client">Prénom</label>
                    <input id="first_name-client" type="text" name="first_name"  value="<?= ucFirst($client->first_name) ?>" required>
                </div>
                <div class="input-field">
                    <label for="birthday-client">Date de naissance</label>
                    <input id="birthday-client" type="text" name="birthday" class="datepicker"  value="<?= $client->birthday ?>" required>
                </div>
                <div class="input-field">
                    <label for="adresse-client">Adresse</label>
                    <input id="adresse-client" type="text" name="address" value="<?= $client->address ?>" >
                </div>
                <div class="input-field">
                    <label for="code_postal-client">Code postal</label>
                    <input id="code_postal-client" type="text" name="zipcode" value="<?= $client->zipcode ?>" >
                </div>
                <div class="input-field">
                    <label for="ville-client">Ville</label>
                    <input id="ville-client" type="text" name="city" value="<?= ucFirst($client->city) ?>" >
                </div>
                <div class="input-field">
                    <label for="tel-client">Téléphone</label>
                    <input id="tel-client" type="text" name="phone" value="<?= $client->phone ?>" >
                </div>
                <div class="input-field">
                    <label for="mail-client">Email</label>
                    <input id="mail-client" type="email" name="email" value="<?= $client->email ?>" >
                </div>
                <div class="form-submit">
                    <button class="btn" type="submit">Mettre à jour</button>
                </div>
                <p class="right-align form-submit"><a href="#delete-client" class="modal-trigger">Supprimer le client</a></p>
            <?= form_close() ?>
        </div>
        <div id="delete-client" class="modal">
            <?= form_open("fiche-client/delete") ?>
            <div class="modal-content">
                <input type="hidden" name="id" value="<?= $client->id ?>">
                <h4>Suppression du client</h4>
                <p>La suppression du client sera définitive</p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="waves-effect waves-green btn-flat">Confirmer</button>
            </div>
            <?= form_close() ?>
        </div>
    </fieldset>
</section>