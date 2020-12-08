<section id="page-geolocalisation">
    <form>
        <div>
            <label for="search">Recherche</label>
            <input type="text" id="search" name="search">
        </div>
        <div>
            <select id="filtre" name="filtre">
                <option value="#" disabled selected>Choisir un filtre</option>
                <option value="address">Adresse</option>
                <option value="zipcode">Code Postal</option>
                <option value="city">Ville</option>
            </select>
        </div>
        <div>
            <select id="distance" name="distance">
                <option value="#" disabled selected>Choisir une distance</option>
                <option value="5">5km</option>
                <option value="10">10km</option>
                <option value="20">20km</option>
                <option value="25">25km</option>
            </select>
        </div>
        <div class="btn teal">Valider</div>
    </form>
    <div id="detailsMap" class="container"></div>
</section>