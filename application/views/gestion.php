<section id="page-gestion" class="container">
    <div class="row flex-wrap valign-wrapper">
        <div class="col s12 m6 left-align btn-add">
            <a class="add-customer btn-floating btn-large waves-effect waves-light teal"><i class="material-icons">add</i></a>
        </div>
        <nav class="white  col s12 m6">
            <div class="nav-wrapper">
                    <div class="input-field">
                        <input id="gestion-search" type="search" placeholder="le nom d'un client" required>
                        <label class="label-icon" for="search"><i class="material-icons black-text">search</i></label>
                        <i class="material-icons search-close">close</i>
                    </div>
            </div>
        </nav>
    </div>
    <div class="row">
        <div id="add-customer" class="invisible">
            <h4>Créer un client</h4>
            <?= form_open("gestion/nouveau-client") ?>
                <input type="hidden" name="entreprise_id" value="<?= $entreprise->id ?>">
                <div class="input-field">
                    <label for="nom-client">Nom</label>
                    <input id="nom-client" type="text" name="nom" required>
                </div>
                <div class="input-field">
                    <label for="prenom-client">Prénom</label>
                    <input id="prenom-client" type="text" name="prenom" required>
                </div>
                <div class="input-field">
                    <label for="date_naissance-client">Date de naissance</label>
                    <input id="date_naissance-client" type="text" name="date_naissance" class="datepicker" required>
                </div>
                <div class="input-field">
                    <label for="adresse-client">Adresse</label>
                    <input id="adresse-client" type="text" name="adresse">
                </div>
                <div class="input-field">
                    <label for="code_postal-client">Code postal</label>
                    <input id="code_postal-client" type="text" name="code_postal">
                </div>
                <div class="input-field">
                    <label for="ville-client">Ville</label>
                    <input id="ville-client" type="text" name="ville">
                </div>
                <div class="input-field">
                    <label for="tel-client">Téléphone</label>
                    <input id="tel-client" type="text" name="telephone">
                </div>
                <div class="input-field">
                    <label for="mail-client">Email</label>
                    <input id="mail-client" type="email" name="email">
                </div>
                <div class="form-submit">
                    <button class="btn" type="submit">Créer</button>
                </div>

            <?= form_close() ?>
        </div>
            <?= (isset($msg) && $msg == 'success') ? '<span class="chip teal white-text">Le client a bien été ajouté<i class="close material-icons">close</i></span>' : null ?>
            <?= (isset($msg) && $msg == 'error') ? '<span class="chip red white-text">Une erreur est survenue<i class="close material-icons">close</i></span>' : null ?>
        <div class="search-result">

        </div>
    </div>
</section>
