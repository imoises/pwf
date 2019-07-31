    <?php
        echo '<form action="/restaurant/restaurantes" method="POST">';
    ?>
        <div class="row">
            <div class="col s2"></div>
            <div class="input-field col s6 z-depth-6" id="buscador">
                <select class="white-text" name="ciudad">
                    <option value="" selected class="white-text">Ciudad</option>
                    <?php
                        foreach ($_SESSION['ciudades'] as $key => $ciudad) {
                            echo "<option value='".$ciudad->ciudad."' class='white-text'>".$ciudad->ciudad."</option>";
                        }

                     ?>
                </select>
            </div>

            <div class="input-field col s1 z-depth-6 transparent center-align" id="buscador">
               <button class="waves-effect waves-light btn-large orange darken-3" type="submit" name="action">Buscar
                <i class="material-icons right">send</i>
            </button>
            </div>
        </div>
      </form>

    