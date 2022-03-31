<?php
require_once 'inc/maininclude.php';
?>
<!DOCTYPE HTML>
<html lang="de">
<head>
    <meta charset="utf-8"/>
    <title>rezeptfabrik-info</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <script src="js/jquery-3.6.0.js" defer></script>
    <script src="js/script.js" defer></script>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
<div class="body">

    <header>
        <?php
        include "inc/header.php";
        include "inc/navbar.php";
        ?>
    </header>

    <div class="content">
        <?php
        if ($userManager->isLoggedIn()) {
            echo "
             <h1>Infos zu rezeptfabrik</h1>
            <br/>
             <p>
              <h2>Was ist rezeptfabrik?</h2>        
            rezeptfabrik dient nicht nur zur Erstellung und Verwaltung von Rezepten, es bietet auch eine tolle 
            Sammlung an Rezeptideen von anderen Kochbegeisterten. Egal ob Anfänger, Hobbykoch oder Profi - bei 
            rezeptfabrik ist für jeden was dabei. Die Vielfalt erstreckt sich von Frühstück über Mittagessen bis hin
            zu Abendessen, man hat die Auswahl aus mit Fleisch, vegetarisch oder vegan.
            Auch Getränke, wie zum Beispiel Cocktails, Smoothies und Shakes findet ihr hier.<br/>
            Wenn ihr ein Rezept findet, dass ihr besonders toll findet, könnt ihr es zu euren Favoriten hinzufügen. 
            Ebenso könnt ihr alle Rezepte bewerten. 
            </p>
            <p>
            <h2>Was befindet sich auf der Home-Seite?</h2>
            Auf der Home-Seite siehst du eine kleine Zusammenstellung von ausgewählten Rezepten. Die Zusammenstellung 
            besteht aus einem Frühstück, einer Vorspeise, einer Hauptspeise, einem Dessert und einem Getränk. Diese 
            Rezepte wechseln jeden Tag nach einem Zufallsprinzip.      
            </p>
            <p>
             <h2>Wo finde ich meine persönlichen Daten und wo kann ich sie bearbeiten?</h2>
            Du kannst deine Daten jeder Zeit unter dem Link \"Profil\" ansehen. Zum Bearbeiten deiner Daten klicke 
            einfach auf den Button \"Daten bearbeiten\" und du wirst zu einem Formular weitergeleitet, in dem du 
            Vorname, Nachname, Benutzername und E-Mail Adresse ändern kannst, oder ein neues Passwort vergeben kannst.
            Wenn du fertig bist, klicke einfach auf den \"Daten aktualisieren\" Button und deine bearbeiteten Daten 
            werden gespeichert.       
            </p>
            <p>
            <h2>Wo kann ich die Rezepte-Sammlung ansehen?</h2>
            Du kannst alle Rezepte jeder Zeit unter dem Link \"Rezepte\" ansehen. Hier siehst du eine kurze Übersicht
            jedes einzelnen Rezeptes mit Bild und Bewertung. Du kannst nach Kategorie oder Typ filtern. Wenn dich ein 
            Rezept anspricht, klicke einfach auf den Titel und du bekommst das ganze Rezept angezeigt. Unter dem 
            Rezept hast du die Möglichkeit, es zu bewerten oder es zu deinen Favoriten hinzuzufügen.     
            </p>
            <p>
            <h2>Wie kann ich ein Rezept erstellen?</h2>
            Klicke auf den Link \"Rezept erstellen\" in der Navigationsleiste um zum Formular zu gelangen.
            Hier kannst du ein Rezept erstellen und speichern. Vergib einen Titel und wähle Kategorie und Typ aus.
            Es ist möglich, mehrere Zutaten mit Menge und Maßeinheit hinzufügen, sie werden dann in einer Liste angezeigt.
            Wenn du eine Zutat wieder entfernen möchtest, klicke auf das X. Darunter findest du einen Texteditor,
            in dem du die Zubereitung des Rezeptes beschreiben kannst. Hast die Auswahl zwischen fettem, kursivem oder
            unterstrichenem Text. Außerdem kannst du eine Liste mit Aufzählungszeichen oder Nummerierung erstellen. Wenn
            du möchstest, kannst du zum Schluss noch ein Foto hinzufügen. Dazu hast du aber später auch noch die 
            Möglichkeit. Wenn du alles korrekt ausgefüllt hast, kannst du auf den \"Speichern\" Button klicken. 
            Dein Rezept kann jetzt von anderen Benutzern bewundert werden!
            </p>
            <p>
             <h2>Wo finde ich meine Rezepte und wo kann ich sie bearbeiten?</h2>
            Du kannst deine Rezepte jeder Zeit unter dem Link \"Profil\" ansehen und bearbeiten. Suche das Rezept, das 
            du bearbeiten möchtest und klicke auf den Button \"Rezept bearbeiten\". Zuerst siehst du das Formular zum 
            Bearbeiten des Rezeptes. Dieses Formular ist gleich aufgebaut, wie das Formular zum Erstellen des Rezeptes. 
            Die Daten sind schon ausgefüllt und du musst nur noch die gewünschten Änderungen machen. Danach kannst du 
            auf den \"Änderungen speichern\" Button klicken und deine bearbeiteten Daten werden gespeichert. Hier kannst
            auch nachträglich ein Foto hochladen oder ein vorhandenes löschen. Außerdem hast du hier die Möglichkeit, 
            das Rezept zu löschen.            
            </p>
            <p>
            <h2>Wie kann ich ein Foto ändern oder nachträglich hinzufügen?</h2>
            Klicke auf den Link \"Profil\" und suche das Rezept, von dem du das Foto ändern willst, bzw. dem du ein 
            Foto hinzufügen willst. Klicke auf den Button \"Rezept bearbeiten\". Zuerst siehst du das Formular zum 
            Bearbeiten des Rezeptes, danach hast du die Möglichkeit, ein anderes Foto bzw. ein neues Foto hochzuladen. 
             </p>
            <p>
             <h2>Wie kann ich ein Rezept löschen?</h2>
            Klicke auf den Link \"Profil\" und suche das Rezept, das du löschen möchtest, dann klicke auf den Button 
            \"Rezept bearbeiten\". Zuerst wird das Formular zum Bearbeiten des Rezeptes angezeigt, darunter hast du die
            Möglichkeit, ein Foto hochzuladen, zum Schluss wird der Button \"Rezept löschen\" angezeigt. Wenn du darauf 
            klickst, kommst du zu einer Seite, wo du noch einmal bestätigen musst, dass du das Rezept wirklich löschen
            willst. Bestätigst du durch drücken des Buttons, wird das Rezept unwiderruflich gelöscht.            
            </p>
            <p>
             <h2>Wie kann ich ein Rezept bewerten?</h2>
            Wenn du ein Rezept bewerten willst, klicke einfach auf den Titel und du kommst auf eine Seite, wo das ganze 
            Rezept angezeigt wird. Darunter kannst du das Rezept bewerten, in dem du zwischen einer und fünf Koschhauben
            vergibst. Danach drücke einfach den \"Bewertung absenden\" Button.         
            </p>
             <p>
             <h2>Wie kann ich ein Rezept zu den Favoriten hinzufügen?</h2>
            Wenn du ein Rezept favorisieren willst, klicke einfach auf den Titel und du kommst auf eine Seite, wo das 
            ganze Rezept angezeigt wird. Darunter kannst du das Rezept zu deinen Favoriten hinzufügen, in dem du auf das
            rote Herz klickst. Wenn du es nicht mehr zu deinen Favoriten zählst, kannst du es dort jederzeit wieder 
            entfavorisieren.        
            </p>
            <br>
            <h3>
            Wir wünschen dir viel Spaß und gutes Gelingen beim ausprobieren der Rezepte!
            Falls du noch irgendwelche Fragen haben solltest oder ein Anliegen hast, schreib uns einfach eine E-mail!
            </h3>     
            ";
        } else {
            echo "
            <h1>Was ist rezeptfabrik</h1>
            <br/>
            <p>
            Jeder ist irgendwann mal auf der Suche nach etwas Neuem – zum Beispiel neue leckere Rezepte. <br/>
            rezeptfabrik beinhaltet eine tolle Sammlung an Rezepten vom Frühstück über Mittagessen bis hin zum
            Abendessen.
            Auch Getränke, wie zum Beispiel Cocktails, Smoothies und Shakes findet ihr hier.<br/>
            Meldet euch an, um die Vielfalt der Rezepte zu entdecken und auch selbst neue Rezepte mit
            anderen zu teilen.
            Ihr könnt eure Rezepte verwalten, die Rezepte der anderen bewerten und sie zu eurer Favoriten-Liste hinzufügen.
            Jeder sucht sich das, was zu ihm passt, von der Kategorie bis hin zur Art der Zubereitung – das, was einen
            anspricht.
        </p>";
        }
    echo"
    </div>";

    include 'inc/footer.php';
    ?>
    </div>

</body>
</html>


