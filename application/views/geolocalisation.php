<section id="page-geolocalisation">
    <form>
        <div>
            <label for="search">Recherche</label>
            <input type="text" id="search" name="search">
        </div>
        <div>
            <label for="filtre">Filtre </label>
            <select id="filtre" name="filtre">
                <option value="adresse" selected>Adresse</option>
                <option value="code_postal">Code Postal</option>
                <option value="ville">Ville</option>
            </select>
        </div>
        <div>
            <label for="distance">Rayon de recherche</label>
            <select id="distance" name="distance">
                <option value="5" selected>5km</option>
                <option value="10">10km</option>
                <option value="20">20km</option>
                <option value="25">25km</option>
            </select>
        </div>
        <div class="btn teal">Valider</div>
    </form>
    <p class="count-clients center-align"></p>
    <div id="detailsMap" class="container"></div>
</section>