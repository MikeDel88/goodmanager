<section id="page-listing" class="">
    <div class="row">
    <?= form_open("liste-clients/search", array('class' => 'form-listing')) ?>
        <nav class="col s12 m6 teal">
            <div class="nav-wrapper">
                <div class="input-field">
                    <input id="gestion-search" name="search" type="search" placeholder="faire une recherche par filtre" required>
                    <label class="label-icon" for="search"><i class="material-icons black-text">search</i></label>
                </div>
            </div>
        </nav>
        <div class="input-field col s12 m6">
            <select id="select-search" name="select-search">
                <option disabled selected>Choisir votre filtre</option>
                <option value="last_name">Nom</option>
                <option value="zipcode">Code Postal</option>
                <option value="city">Ville</option>
            </select>
            <label>Filtre</label>
        </div>
    <?= form_close() ?>
    </div>
    <div class="row">
        <table class="responsive-table highlight centered">
            <thead>
              <tr>
                  <th><span>Nom</span></th>
                  <th><span>Prénom</span><i class="material-icons">swap_vert</i></th>
                  <th><span>Age</span><i class="material-icons">swap_vert</i></th>
                  <th><span>Adresse</span><i class="material-icons">swap_vert</i></th>
                  <th><span>Code Postal</span><i class="material-icons">swap_vert</i></th>
                  <th><span>Ville</span><i class="material-icons">swap_vert</i></th>
                  <th><span>Téléphone</span><i class="material-icons">swap_vert</i></th>
                  <th><span>Email</span></th>
                  <th><span>Contact</span></th>
                  <th><span>Rdv</span></th>
              </tr>
            </thead>
        <? if(isset($clients)) { ?>
            <tbody class="search-body">
            <? foreach($clients as $client){?>
                <tr>
                    <td><?= ucFirst($client->last_name) ?></td>
                    <td><?= ucFirst($client->first_name) ?></td>
                    <td><?= $client->age() ?></td>
                    <td><?= $client->address ?></td>
                    <td><?= $client->zipcode  ?></td>
                    <td><?= ucFirst($client->city)  ?></td>
                    <td>
                        <a href="tel:<?= $client->phone ?>" title="<?= $client->phone ?>"><?= ($client->phone !== '') ? '<i class="material-icons">phone_forwarded</i>' : '<i class="material-icons red-text">phonelink_erase</i>' ?></a>
                    </td>
                    <td>
                        <a href="mailto:<?= $client->email ?>" title="<?= $client->email ?>"><?= ($client->email !== '') ? '<i class="material-icons">email</i>' : '<i class="material-icons red-text">email</i>'?></a>
                    </td>
                    <td>
                        <label>
                            <input type="checkbox" class="check-contact" data-client-id="<?= $client->id ?>" />
                            <span></span>
                        </label>
                    </td>
                    <td><a href="#"><i class="material-icons teal-text">event</i></a></td>
                </tr>
            <?}?>
            </tbody>
        <?}?>
        </table>
    </div>
</section>
