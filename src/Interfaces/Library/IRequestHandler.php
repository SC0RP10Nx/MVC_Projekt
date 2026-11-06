<?php

namespace dateninjson\Interfaces\Library;
//In PHP ist ein Interface eine Vorlage für eine Klasse,
//die bestimmte Methoden definiert, die in jeder implementierenden Klasse vorhanden sein müssen.
//Interfaces ermöglichen es, eine klare Struktur für Klassen zu schaffen,
//ohne deren konkrete Implementierung vorzugeben.

/*Wichtige Punkte zu Interfaces in PHP:

- Methoden in einem Interface haben keine Implementierung – sie werden nur deklariert.
- Alle Methoden in einem Interface müssen public sein.
- Eine Klasse kann mehrere Interfaces implementieren (Mehrfachvererbung möglich).
- Interfaces werden mit dem Schlüsselwort interface definiert.
- Eine Klasse, die ein Interface implementiert, muss alle Methoden des Interfaces bereitstellen.*/


/*Warum Interfaces verwenden?

- Saubere Code-Struktur: Interfaces erzwingen, dass bestimmte Methoden in Klassen existieren.
- Flexibilität: Eine Klasse kann mehrere Interfaces implementieren, was mit normaler Vererbung nicht möglich ist.
- Gute Wartbarkeit: Wenn eine neue Klasse hinzugefügt wird, muss sie sich an das Interface halten.*/

interface IRequestHandler
{
    /**
     * @param array $serverVarablen
     * Hier übergebe ich die globale Servervariable
     */
    public function __construct(array $serverVarablen);

    public string $controllerName {
        get;
    }

    public string $actionName {
        get;
    }
}