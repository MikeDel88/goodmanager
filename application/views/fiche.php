<section id="page-fiche" class="container">
    <fieldset class='row'>
        <legend><?= "$client->nom $client->prenom"?></legend>
        <div class="container">
            <?= form_open("fiche-client/modification") ?>
                <input type="hidden" name="id" value="<?= $client->id ?>">
                <div class="input-field">
                    <label for="nom-client">Nom</label>
                    <input id="nom-client" type="text" name="nom"  value="<?= ucFirst($client->nom) ?>" required>
                </div>
                <div class="input-field">
                    <label for="prenom-client">Prénom</label>
                    <input id="prenom-client" type="text" name="prenom"  value="<?= ucFirst($client->prenom) ?>" required>
                </div>
                <div class="input-field">
                    <label for="date_naissance-client">Date de naissance</label>
                    <input id="date_naissance-client" type="text" name="date_naissance" class="datepicker"  value="<?= date("d-m-Y" , strtotime($client->date_naissance)) ?>" required>
                </div>
                <div class="input-field">
                    <label for="adresse-client">Adresse</label>
                    <input id="adresse-client" type="text" name="adresse" value="<?= $client->adresse ?>" >
                </div>
                <div class="input-field">
                    <label for="code_postal-client">Code postal</label>
                    <input id="code_postal-client" type="text" name="code_postal" value="<?= $client->code_postal ?>" >
                </div>
                <div class="input-field">
                    <label for="ville-client">Ville</label>
                    <input id="ville-client" type="text" name="ville" value="<?= ucFirst($client->ville) ?>" >
                </div>
                <div class="input-field">
                    <label for="tel-client">Téléphone</label>
                    <input id="tel-client" type="text" name="telephone" value="<?= $client->telephone ?>" >
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
                <input class="delete-fiche-client" type="hidden" name="id" value="<?= $client->id ?>">
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