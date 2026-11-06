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
                                   value="Frau" {if ($smarty.session['anrede']|default:null) === 'Frau'} checked {/if}>
                            <label class="form-check-label" for="Frau">Frau</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="anrede" id="Divers"
                                   value="Divers" {if ($smarty.session['anrede']|default:null) === 'Divers'} checked {/if}>
                            <label class="form-check-label" for="Divers">Divers</label>
                        </div>
                        <div class="input-group mb-3 mt-3">
                            <label class="input-group-text" for="Name">Name</label>
                            <input type="text" class="form-control" id="Name" name="name" title="affe"
                                   placeholder="Nachname"
                                   value="{$smarty.session.name|default:''}">
                            <label class="input-group-text" for="VName">Vorname</label>
                            <input type="text" class="form-control" id="VName" name="vname"
                                   placeholder="Vorname"
                                   value="{$smarty.session.vname|default:''}">
                        </div>
                        <div class="input-group mb-3 mt-3">
                            <label class="input-group-text" for="strasse">Straße</label>
                            <input type="text" class="form-control" id="strasse" name="strasse"
                                   placeholder="Straßenname"
                                   value="{$smarty.session.strasse|default:''}">
                            <label class="input-group-text" for="hausnr">HausNr.</label>
                            <input type="text" class="form-control" id="hausnr" name="hausnr"
                                   placeholder="Hausnummer"
                                   value="{$smarty.session.hausnr|default:''}">
                        </div>
                        <div class="input-group mb-3 mt-3">
                            <label class="input-group-text" for="plz">PLZ</label>
                            <input type="text" class="form-control" id="plz" name="plz"
                                   placeholder="Postleitzahl" value="{$smarty.session.plz|default:''}">
                            <label class="input-group-text" for="ort">Ort</label>
                            <input type="text" class="form-control" id="ort" name="ort"
                                   placeholder="Wohnort"
                                   value="{$smarty.session.ort|default:''}">
                        </div>
                        <div class="input-group mb-3 mt-3">
                            <label class="input-group-text" for="email">E-Mail</label>
                            <input type="text" class="form-control" id="email" name="email"
                                   placeholder="E-Mail"
                                   value="{$smarty.session.email|default:''}">
                            <label class="input-group-text" for="tel">Telefon</label>
                            <input type="text" class="form-control" id="tel" name="tel"
                                   placeholder="Telefonnummer"
                                   value="{$smarty.session.tel|default:''}">
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="Verein">Fußballverein</label>
                            <select class="form-select" name="verein" id="Verein">
                                <option value=''>---Bitte auswählen---</option>
                                {foreach $smarty.const.VEREIN as $item =>$value}
                                    <option value='{$item}' {$auswahlSession->checkedselectedFeld('verein',$item,'selected')}>{$value}</option>
                                {/foreach}

                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="Laender">Länder</label>
                            <select class="form-select" name="laender" id="Laender">
                                <option value=''>---Bitte auswählen---</option>
                                {foreach $smarty.const.LAENDER as $item =>$value}
                                    <option value='{$item}'{if ($smarty.session['laender']|default:null) === $item} selected {/if}>{$value}</option>
                                {/foreach}
                            </select>
                        </div>
                        {foreach $smarty.const.SPORTART as $item => $value}
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="sportart[]" id="{$item}"
                                        {* value="{$item}" {$auswahlSession->arrayFeld('sportart',$item,'checked')}>*}
                                       value="{$value}" {if  in_array($value,$smarty.session['sportart']|default:null)} checked {/if}>
                                <label class="form-check-label" for="{$item}">{$value}</label>
                            </div>
                        {/foreach}
                        <div class="form-group mt-3">
                            <label for="Feedback">Feedback</label>
                            <textarea class="form-control" id="Feedback" name="feedback"
                                      rows="3">{$smarty.session.feedback|default:''}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3" formaction="/Textspeichernjson/senden"
                                formmethod="post"
                                name="senden">Submit
                        </button>
                        <button type="submit" class="btn btn-primary mt-3" formaction="/Textspeichernjson/toreadout"
                                name="auslesen"
                                formmethod="post">Login
                        </button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
