<div class="container">
    <div class="card mt-3">
        <div class="card-body">
            <div class="row">
                <div class="offset-1 col-10">
                    <form class="kontaktformular">
                        <fieldset>
                            <legend>Kontaktformular</legend>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input" type="radio" name="anrede" id="Herr"
                                       value="Herr" checked>
                                <label class="form-check-label" for="Herr">Herr</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="anrede" id="Frau"
                                       value="Frau" >
                                <label class="form-check-label" for="Frau">Frau</label>
                            </div>
                            <div class="input-group mb-3 mt-3">
                                <label class="input-group-text" for="Name">Name</label>
                                <input type="text" class="form-control" id="Name" name="name" title="affe"
                                       placeholder="Bitte einen Namen eintragen!!"
                                       value="">
                                <label class="input-group-text" for="VName">Vorname</label>
                                <input type="text" class="form-control" id="VName" name="vname"
                                       placeholder="Bitte einen Vornamen eintragen!!"
                                       value="">
                            </div>
                            <div class="input-group mb-3 mt-3">
                                <label class="input-group-text" for="strasse">Straße</label>
                                <input type="text" class="form-control" id="strasse" name="strasse"
                                       placeholder="Straßennamen"
                                       value="">
                                <label class="input-group-text" for="hausnr">HausNr.</label>
                                <input type="text" class="form-control" id="hausnr" name="hausnr"
                                       placeholder="Hausnummer"
                                       value="">
                            </div>
                            <div class="input-group mb-3 mt-3">
                                <label class="input-group-text" for="plz">PLZ</label>
                                <input type="text" class="form-control" id="plz" name="plz"
                                       placeholder="PLZ" value="">
                                <label class="input-group-text" for="ort">Ort</label>
                                <input type="text" class="form-control" id="ort" name="ort"
                                       placeholder="Ort"
                                       value="">
                            </div>
                            <div class="input-group mb-3 mt-3">
                                <label class="input-group-text" for="email">E-Mail</label>
                                <input type="text" class="form-control" id="email" name="email"
                                       placeholder="E-Mail"
                                       value="">
                                <label class="input-group-text" for="tel">Telefon</label>
                                <input type="text" class="form-control" id="tel" name="tel"
                                       placeholder="Telefonnummer"
                                       value="">
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="Verein">Fußballverein</label>
                                <select class="form-select" name="verein" id="Verein">
                                    <option value=''>---Bitte auswählen---</option>

                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="Laender">Länder</label>
                                <select class="form-select" name="laender" id="Laender">
                                    <option value=''>---Bitte auswählen---</option>

                                </select>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="sportart[]" id=""
                                       value=""
                                <label class="form-check-label" for=""></label>
                            </div>
                            <div class="form-group mt-3">
                                <label for="Feedback">Feedback</label>
                                <textarea class="form-control" id="Feedback" name="feedback"
                                          rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3" formaction="/Textspeichernjson/senden"
                                    formmethod="post"
                                    name="senden">Submit
                            </button>
                            <button type="submit" class="btn btn-primary mt-3" formaction="/Textspeichernjson/ueberpruefungSession"
                                    name="auslesen"
                                    formmethod="post">Login
                            </button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>