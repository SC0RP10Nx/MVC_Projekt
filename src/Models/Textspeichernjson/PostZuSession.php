<?php

namespace dateninjson\Models\Textspeichernjson;


use dateninjson\Exceptions\Textspeichernjson\ErrorInTextspeichern;
use DateTime;
use IntlDateFormatter;

class PostZuSession
{
    /**
     * @var array $datensatz
     */
    private array $datensatz = [];

    /**
     * @param array|null $indexArray
     * @param array|null $datensatzArray
     * @throws ErrorInTextspeichern
     */
    public function __construct(private readonly array|null $indexArray = null, private readonly array|null $datensatzArray = null)
    {
        (!empty($datensatzArray) && !empty($this->indexArray)) ? $this->zuweisungDatensatz() : throw new ErrorInTextspeichern('Keine Daten Übergeben!');
    }

    private function zuweisungDatensatz(): void
    {
        $formatter = new IntlDateFormatter(
            'de_DE',
            IntlDateFormatter::LONG,
            IntlDateFormatter::NONE
        );
        $this->datensatz['datum'] = $formatter->format(new DateTime());
        foreach ($this->indexArray as $item => $value) {
            if ($value === 'input') {
                //Die PHP-Funktion htmlspecialchars() wird verwendet, um spezielle Zeichen in einem String in HTML-sichere Zeichen umzuwandeln.
                $this->datensatz[$item] = $_SESSION[$item] = ucfirst(htmlspecialchars(trim($this->datensatzArray[$item]??'')));
            } elseif ($value === 'textarea') {
                //Die PHP-Funktion wordwrap() wird verwendet, um einen langen Text nach einer bestimmten Anzahl
                // von Zeichen umzubrechen, also Zeilenumbrüche einzufügen, damit der Text besser lesbar
                // ist oder in bestimmte Layouts passt.
                $_SESSION[$item] = htmlspecialchars(wordwrap($this->datensatzArray[$item], UMBRUCHTEXTAREA, "\n", true));
                //Die PHP-Funktion str_replace() wird verwendet, um Teile eines Strings zu ersetzen –
                //also bestimmte Zeichenfolgen durch andere zu ersetzen.
                $this->datensatz[$item] = str_replace(NLT, NL, $_SESSION[$item]);
            } elseif ($value === 'array') {
                $_SESSION[$item] = $this->datensatzArray[$item]??'';
                //Die PHP-Funktion implode() wird verwendet, um ein Array zu einem String zusammenzufügen –
                //mit einem frei wählbaren Trennzeichen (Separator).
                $this->datensatz[$item] = (!empty($this->datensatzArray[$item])? (implode(':', $this->datensatzArray[$item])):'');
            }else{
                $this->datensatz[$item] = $_SESSION[$item] = htmlspecialchars($this->datensatzArray[$item]??'');
            }
        }
    }

    /**
     * @return array
     */
    public function getDatensatz(): array
    {
        return $this->datensatz;
    }
}