<section id="page-comptes" class="container">
    <div>
        <?= form_open('gestion-comptes/ajouter-un-collaborateur') ?>
            <div class="input-field col s12">
                <input id="email" type="email" name="email">
                <label for="email">Email</label>
            </div>
            <div class="input-field col s12">
                <input id="last_name" type="text" name="last_name">
                <label for="last_name">Nom de famille</label>
            </div>
            <div class="input-field col s12">
                <input id="first_name" type="text" name="first_name">
                <label for="first_name">Prénom</label>
            </div>
            <div>
                <button class="btn teal" type="submit">Ajouter</button>
            </div>
        <?= form_close() ?>
    </div>
<? if(!empty($users)){?>
    <div>
        <h4>Liste des collaborateurs</h4>
        <ul class="collection with-header">
            <li class="collection-header teal white-text"><?= count($users) ?> <?=(count($users) == 1) ? 'collaborateur' : 'collaborateurs'; ?></li>
            <? foreach($users as $user){?>
            <li class="collection-item">
                <p>
                    <?= ucFirst($user->last_name) . " " . $user->first_name  . " " ?> | 
                    <?= ($user->activate) ? '<span class="teal-text">compte validé</span>' : '<span class="red-text">compte non-validé</span>' ?>
                <p>
                <div class="valign-wrapper">
                    <form action="/gestion-comptes/suppression-collaborateur" method="POST">
                        <input type="hidden" name="id" value="<?= $user->id ?>">
                    </form>
                    <a class="modal-trigger close" href="#delete-compte"><i class="material-icons">close</i></a>
                </div>
            </li>
            <?}?>
        </ul>
    </div>

<?}?>
<div id="delete-compte" class="modal">
    <div class="modal-content">
      <h4>Suppression du compte collaborateur</h4>
      <p>attention ! Cette action est irréversible</p>
    </div>
    <div class="modal-footer">
        <span class="modal-close waves-effect waves-green btn-flat">Confirmer</span>
    </div>
</div>
</section>
