<?php

namespace dateninjson\Models\Darlehen;
class Darlehen
{

    /**
     * @var float $tilgung
     */
    private float $tilgung;
    /**
     * @var array $ausgabe
     */
    private array $ausgabe = array();

    /**
     * @param int $kreditsumme
     * @param int $laufzeit
     * @param float $zinssatz
     * @param string $artdesdarlehen
     */
    public function __construct(private int $kreditsumme, private int $laufzeit, private float $zinssatz, private string $artdesdarlehen)
    {
        $this->tilgung = round($this->kreditsumme / $this->laufzeit, 2);
        $this->zinssatz = $zinssatz / 100;
        if ($this->artdesdarlehen == 'Ratenkredit') {
            $this->Ratenkredit();
        } elseif ($this->artdesdarlehen == 'Annuitaeten') {
            $this->Annuitaeten();
        } elseif ($this->artdesdarlehen == 'Endfaelliges') {
            $this->Enfaelliges();
        } else {
            echo $this->artdesdarlehen . 'ist nicht korrekt angeben';
        }
    }

    /**
     * @return void
     */
    public function Ratenkredit(): void
    {
        $summeZinssatz = 0;
        $summeTilgung = 0;
        $summeAnnuitaet = 0;
        $summeMonatsrate = 0;
        for ($i = 0; $i <= $this->laufzeit; $i++) {
            $this->ausgabe[$i]['laufzeit'] = ($i === $this->laufzeit) ? '⅀' : $i + 1;
            $this->ausgabe[$i]['restschuld'] = ($i === $this->laufzeit) ? ' ' : $this->kreditsumme - $this->tilgung * $i;
            $this->ausgabe[$i]['zins'] = ($i === $this->laufzeit) ? $summeZinssatz : $this->ausgabe[$i]['restschuld'] * $this->zinssatz;
            $summeZinssatz += $this->ausgabe[$i]['zins'];
            $this->ausgabe[$i]['tilgung'] = ($i === $this->laufzeit) ? $summeTilgung : $this->tilgung;
            $summeTilgung += $this->ausgabe[$i]['tilgung'];
            $this->ausgabe[$i]['annuitaet'] = ($i === $this->laufzeit) ? $summeAnnuitaet : $this->ausgabe[$i]['zins'] + $this->tilgung;
            $summeAnnuitaet += $this->ausgabe[$i]['annuitaet'];
            $this->ausgabe[$i]['monatsrate'] = ($i === $this->laufzeit) ? $summeMonatsrate : $this->ausgabe[$i]['annuitaet'] / 12;
            $summeMonatsrate += $this->ausgabe[$i]['monatsrate'];
        }
    }

    /**
     * @return void
     */
    public function Annuitaeten(): void
    {
        $annunitaet = $this->kreditsumme * (pow(1 + $this->zinssatz, $this->laufzeit) * $this->zinssatz) / (pow(1 + $this->zinssatz, $this->laufzeit) - 1);
        $summeZinssatz = 0;
        $summeTilgung = 0;
        $summeAnnuitaet = 0;
        $summeMonatsrate = 0;
        for ($i = 0; $i <= $this->laufzeit; $i++) {
            $this->ausgabe[$i]['laufzeit'] = ($i === $this->laufzeit) ? '⅀' : $i + 1;
            $this->ausgabe[$i]['restschuld'] = ($i === $this->laufzeit) ? ' ' : (($i == 0) ? $this->kreditsumme : $this->ausgabe[$i - 1]['restschuld'] - $this->ausgabe[$i - 1]['tilgung']);
            $this->ausgabe[$i]['zins'] = ($i === $this->laufzeit) ? $summeZinssatz : $this->ausgabe[$i]['restschuld'] * $this->zinssatz;
            $summeZinssatz += $this->ausgabe[$i]['zins'];
            $this->ausgabe[$i]['tilgung'] = ($i === $this->laufzeit) ? $summeTilgung : $annunitaet - $this->ausgabe[$i]['zins'];
            $summeTilgung += $this->ausgabe[$i]['tilgung'];
            $this->ausgabe[$i]['annuitaet'] = ($i === $this->laufzeit) ? $summeAnnuitaet : $annunitaet;
            $summeAnnuitaet += $this->ausgabe[$i]['annuitaet'];
            $this->ausgabe[$i]['monatsrate'] = ($i === $this->laufzeit) ? $summeMonatsrate : $this->ausgabe[$i]['annuitaet'] / 12;
            $summeMonatsrate += $this->ausgabe[$i]['monatsrate'];
        }

    }

    /**
     * @return void
     */
    public function Enfaelliges(): void
    {
        $summeZinssatz = 0;
        $summeAnnuitaet = 0;
        for ($i = 0; $i <= $this->laufzeit; $i++) {
            $this->ausgabe[$i]['laufzeit'] = ($i === $this->laufzeit) ? '⅀' : $i + 1;
            $this->ausgabe[$i]['restschuld'] = ($i === $this->laufzeit) ? 0 : $this->kreditsumme;
            $this->ausgabe[$i]['zins'] = ($i === $this->laufzeit) ? $summeZinssatz : $this->kreditsumme * $this->zinssatz;
            $summeZinssatz += $this->ausgabe[$i]['zins'];
            $this->ausgabe[$i]['tilgung'] = ($i === $this->laufzeit) ? $this->kreditsumme : 0;
            $this->ausgabe[$i]['annuitaet'] = ($i === $this->laufzeit) ? $summeAnnuitaet : $this->ausgabe[$i]['zins'] + $this->ausgabe[$i]['tilgung'];
            $summeAnnuitaet += $this->ausgabe[$i]['annuitaet'];
            $this->ausgabe[$i]['monatsrate'] = ($i === $this->laufzeit) ? '' : $this->ausgabe[$i]['annuitaet'] / 12;
        }
    }

    /**
     * @return array
     */
    public function getAugabe(): array
    {
        return $this->ausgabe;
    }
}
