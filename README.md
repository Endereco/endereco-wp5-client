# Endereco Wordpress Client

## Installation

Die Installation erfolgt in folgenden Schritten:

1. Das Modul hier als ZIP herunterladen
2. Das Modul im Wordpress Backend installieren und aktivieren (Plugins → installieren)
3. Anschließend muss das Modul nur noch konfiguriert werden (Einstellungen → Endereco AMS)

## Konfiguration des Moduls

Als Erstes wird ein API-Key benötigt, um das Modul nutzen zu können. Diesen kann man [hier](https://www.endereco.de) beantragen

### Adress-Services Konfiguration

Hier kann man die Adressprüfung, Eingabe-Assistent und SmartAutocomplete aktivieren oder deaktivieren. Der SmartAutocomplete übernimmt automatisch den Vorschlag von Eingabe-Assistenten, wenn es nur einen Vorschlag gibt.

Außerdem kann man einstellen, ob der User eine fehlerhafte Adresse mit einer zusätzlicher Checkbox bestätigen muss oder auch ob das Adressmodal, in der sich die Adressvorschläge befinden, geschlossen werden darf auch ohne Adressauswahl.

### Name-Services Konfiguration
Die Namensprüfung und auch das automatische Vertauschen des Vor- und Nachnamens lässt sich aktivieren oder deaktivieren

### Rufnummernprüfung-Services Konfiguration

Hier kann man die Rufnummernprüfung aktivieren oder deaktivieren. Ebenso, ob Statusmeldungen angezeigt werden sollen und auch in welchem Format die Telefonnummer erwartet wird

### Email-Services Konfiguration

Hier kann man die E-Mail-Prüfung aktivieren oder deaktivieren. Ebenso, wie bei der Rufnummernprüfung lassen sich die Statusmeldungen anzeigen oder nicht.

### Designanpassungen

Hier kann man sich entscheiden, ob man das Standard CSS nutzen möchte oder nicht

### Entwicklereinstellungen

#### Adressprüfung beim Absenden des Formulars auslösen
Wenn aktiv, wird die Adresse geprüft, sobald das Formular abgeschickt wird

#### Adressprüfung sofort nach Verlassen des Hausnummernfeldes auslösen
Wenn aktiv wird die Adresse sofort geprüft, sobald die Adressfelder verlassen wurden

#### Das Absenden des Formulars nach der Adressauswahl fortsetzen
Wenn aktiv wird nach der Adressprüfung das Formular abgeschickt. Wenn es deaktiviert ist kann der User nochmal alle Daten in Ruhe anschauen und muss das Formular nochmal abschicken

#### Endereco AMS auf folgenden Seiten einbauen. Id's kommagetrennt
Hier müssen die Seitenids auf denen Endereco aktiv sein soll eingetragen werden, mit einem Komma getrennt (z. B. "8,9"). 
</br>Diese ids findet man in der Url, sobald man diese Adresse bearbeitet. (z. B. post=2 → Seitenid: 2)

#### Debuginformationen in der Browserkonsole ausgeben
Dabei werden zusätzlich Informationen in der Konsole ausgegeben