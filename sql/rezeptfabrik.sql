-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 17. Jan 2022 um 17:42
-- Server-Version: 10.4.22-MariaDB
-- PHP-Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `rezeptfabrik`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `category`
--
CREATE SCHEMA IF NOT EXISTS rezeptfabrik;

CREATE TABLE rezeptfabrik.category
(
    `id`   int(11) NOT NULL,
    `name` varchar(30) DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

--
-- Daten für Tabelle `category`
--

INSERT INTO rezeptfabrik.category (`id`, `name`)
VALUES (1, 'Frühstück'),
       (2, 'Vorspeise'),
       (3, 'Dessert'),
       (4, 'Hauptspeise'),
       (5, 'Getränk'),
       (6, 'Suppe'),
       (7, 'Abendessen');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ingredient`
--

CREATE TABLE rezeptfabrik.ingredient
(
    `id`   int(11) NOT NULL,
    `name` varchar(30) DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

--
-- Daten für Tabelle `ingredient`
--

INSERT INTO rezeptfabrik.ingredient (`id`, `name`)
VALUES (1, 'Wodka'),
       (2, 'Limette (ausgepresst)'),
       (3, 'Ginger Beer zum Auffüllen'),
       (4, 'Eiswürfel'),
       (5, 'Kalbsschitzel'),
       (6, 'Salz'),
       (7, 'Eier'),
       (8, 'Semmelbrösel'),
       (9, 'Backfett'),
       (10, 'Zitrone'),
       (11, 'Brokkoli'),
       (12, 'Knoblauchzehe (fein gehackt)'),
       (13, 'Zwiebeln (fein gehakt)'),
       (14, 'Olivenöl'),
       (15, 'Gemüsesuppe (klar)'),
       (16, 'Pfeffer'),
       (17, 'Schlagobers'),
       (18, 'Eigelb'),
       (19, 'Zucker'),
       (20, 'Mehl'),
       (21, 'Vanilleschoten'),
       (22, 'Milch'),
       (23, 'Langkornreis'),
       (24, 'Erbsen'),
       (25, 'Frühlingszwiebeln'),
       (26, 'grüner Paprika'),
       (27, 'rote Paprika'),
       (28, 'Maiskörner aus der Dose'),
       (29, 'Minze'),
       (30, 'Knoblauchzehe'),
       (31, 'Zitronensaft'),
       (32, 'Zimtstangen'),
       (33, 'Orange'),
       (34, 'Gewürznelken'),
       (35, 'Rotwein'),
       (36, 'Kristallzucker'),
       (37, 'Mascarpone'),
       (38, 'Vanillepuddingpulver'),
       (39, 'Staubzucker'),
       (40, 'Banane'),
       (41, 'Kalb- oder Schweineschnitzel'),
       (42, 'Öl'),
       (43, 'Butter'),
       (44, 'Suppe zum Aufgießen'),
       (45, 'Zwiebeln'),
       (46, 'Butterschmalz'),
       (47, 'Kürbis'),
       (48, 'Gemüsebrühe oder Rindsuppe'),
       (49, 'Muskatnuss'),
       (50, 'Thymian'),
       (51, 'Korianderkörner'),
       (52, 'Obers'),
       (53, 'Kichererbsen'),
       (54, 'Koriander'),
       (55, 'Zwiebel'),
       (56, 'Knoblauchzehen'),
       (57, 'Kreuzkümmel'),
       (58, '7 Korn- Flocken'),
       (59, 'Honig'),
       (60, 'Walnüsse'),
       (61, 'Apfel'),
       (62, 'Sauerrahm'),
       (63, 'Wasser'),
       (64, 'Zitronen'),
       (65, 'Rum'),
       (66, 'brauner Zucker'),
       (67, 'Weißwein'),
       (68, 'Karotten'),
       (69, 'Cayennepfeffer'),
       (70, 'Petersilie'),
       (71, 'Chilischote'),
       (72, 'Tomaten'),
       (73, 'Tomatenmark'),
       (74, 'Sellerie'),
       (75, 'Paprika'),
       (76, 'Mais'),
       (77, 'Kidneybohnen');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `recipe`
--

CREATE TABLE rezeptfabrik.recipe
(
    `id`             int(11)     NOT NULL,
    `title`          varchar(30) NOT NULL,
    `content`        text        NOT NULL,
    `slug`           varchar(50) NOT NULL,
    `user_id`        int(11)     NOT NULL,
    `category_id`    int(11)     NOT NULL,
    `type_id`        int(11)     NOT NULL,
    `photo_url`      text DEFAULT NULL,
    `published_date` datetime    NOT NULL,
    `rating_count`   int(11)     NOT NULL,
    `rating`         float       NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

--
-- Daten für Tabelle `recipe`
--

INSERT INTO rezeptfabrik.recipe (`id`, `title`, `content`, `slug`, `user_id`, `category_id`, `type_id`, `photo_url`,
                      `published_date`, `rating_count`, `rating`)
VALUES (1, 'Moscow Mule',
        '<p><strong>Dieser k&ouml;stliche Moscow Mule mit Wodka, Limettensaft und Ginger Beer, ist der neue Trend unter den Cocktails und wird gern im Kupferbecher serviert.</strong></p>\r\n<ol>\r\n<li>F&uuml;r den Moscow Mule zuerst die Limette auspressen.</li>\r\n<li>In den Kupferbecher den Wodka einf&uuml;llen, dann sofort mit Eisw&uuml;rfeln f&uuml;llen. Jetzt den Limettensaft &uuml;ber das Eis gie&szlig;en.</li>\r\n<li>Mit Ginger Beer auff&uuml;llen, vorsichtig mit einem Barl&ouml;ffel umr&uuml;hren.</li>\r\n<li>Limettenspalten sowie Minzbl&auml;tter zum Garnieren verwenden.</li>\r\n</ol>',
        'moscow-mule', 1, 5, 2, '1_1.png', '2022-01-12 14:40:17', 0, 0),
       (2, 'Wiener Schnitzel',
        '<p><strong>Das klassische Wiener Schnitzel - Rezept wird am liebsten sonntags mit Petersilkartoffeln oder Reis serviert</strong></p>\r\n<ol>\r\n<li>Schnitzel zwischen Frischhaltefolie behutsam klopfen. Fleisch beidseitig salzen, in Mehl wenden, abklopfen, durch die Eier ziehen und in den Br&ouml;seln wenden.</li>\r\n<li>Schnitzel im ca. 2 Finger hohen Backfett goldgelb backen. W&auml;hrend des Backens die Pfanne ein wenig r&uuml;tteln, damit die Schnitzel gleichm&auml;&szlig;ig goldbraun werden. Schnitzel herausheben, auf K&uuml;chenpapier abtropfen lassen.</li>\r\n<li>Zitrone in Spalten schneiden und die fertigen Wiener Schnitzel mit Zitronenspalten garnieren.</li>\r\n</ol>',
        'wiener-schnitzel', 1, 4, 1, '1_2.png', '2022-01-12 15:08:44', 0, 0),
       (3, 'Brokkoli Suppe',
        '<p><strong>Suppen sind immer willkommen. Das Rezept f&uuml;r Brokkoli Suppe w&auml;rmt unseren K&ouml;rper und spendet Kraft</strong></p>\r\n<ol>\r\n<li>F&uuml;r die Brokkolisuppe zuerst Brokkoli, Knoblauch und Zwiebeln fein hacken und in Oliven&ouml;l einige Minuten in einem Topf gut anbraten.</li>\r\n<li>Mit Gem&uuml;sesuppe aufgie&szlig;en und ca. 20 Minuten bei niedriger Hitze k&ouml;cheln lassen.</li>\r\n<li>Abschlie&szlig;end mit einem Stabmixer kurz durchmixen und nach belieben mit Salz und Pfeffer abschmecken.</li>\r\n<li>Zum Verfeinern kann noch Schlagobers (Rahm) unterger&uuml;hrt werden.</li>\r\n</ol>',
        'brokkoli-suppe', 1, 6, 3, '1_3.png', '2022-01-12 15:21:26', 0, 0),
       (4, 'Selbstgemachter Pudding',
        '<p><strong>Selbstgemachter Pudding geht gar nicht schwer und schmeckt vorz&uuml;glich. Das Rezept kann sowohl mit Vanilleschote als auch mit Kakaopulver zubereitet werden.</strong></p>\r\n<ol>\r\n<li>Zuerst Eier trennen und das Eigelb mit dem Zucker, Mehl und 50 ml Milch verr&uuml;hren.</li>\r\n<li>Nun die Vanilleschote der L&auml;nge nach aufschneiden und das Mark auskratzen. Die Schote und das Mark zur restlichen Milch geben, die gleich danach zum Kochen gebracht wird.</li>\r\n<li>Sobald die Milch einmal kurz aufkocht, kann die Vanilleschote entfernt werden. Danach das Zucker-Ei-Mehl-Gemisch vorsichtig einr&uuml;hren. Nun unter st&auml;ndigem r&uuml;hren (am besten daf&uuml;r eignet sich ein Schneebesen) ca. 3-4 Minuten leicht k&ouml;cheln lassen.</li>\r\n<li>Zum Schluss den Pudding in vorbereitete F&ouml;rmchen f&uuml;llen abk&uuml;hlen lassen.</li>\r\n</ol>',
        'selbstgemachter-pudding', 1, 3, 2, '1_4.png', '2022-01-12 15:48:14', 0, 0),
       (5, 'Reissalat',
        '<p><strong>Reissalat is das perfekte Gericht, wenn Sie viele G&auml;ste erwarten. Das Rezept ist rasch vorbereitet und schmeckt vorz&uuml;glich</strong></p>\r\n<ol>\r\n<li>F&uuml;r den Reissalat Wasser in einem gro&szlig;en Topf zum Kochen bringen und den Reis einr&uuml;hren. Aufkochen und 12-15 Min. k&ouml;cheln lassen, bis der Reis bissfest ist. Abtropfen und abk&uuml;hlen lassen.</li>\r\n<li>Erbsen ca. 2 min. in einem kleinen Topf mit siedendem Wasser kochen. Unter kaltem Wasser absp&uuml;len und gut abtropfen lassen.</li>\r\n<li>F&uuml;r das Dressing &Ouml;l, Zitronensaft, Knoblauch und Zucker in einer kleinen R&uuml;hrsch&uuml;ssel vermengen und gut verquirlen. Mit Salz und frisch gemahlenem schwarzen Pfeffer abschmecken.</li>\r\n<li>Reis, Erbsen, Fr&uuml;hlingszwiebeln, Paprika, Mais und Minze in eine gr&szlig;e Sch&uuml;ssel geben. Dressing zugeben und gut vermischen. Abdecken und 1 Std. in den K&uuml;hlschrank stellen.</li>\r\n</ol>',
        'reissalat', 1, 4, 3, '1_5.png', '2022-01-12 16:05:10', 0, 0),
       (7, 'glühwein',
        '<p><strong>Der Gl&uuml;hwein ist ein Klassiker im Winter und schmeckt nicht nur auf Weihnachtsm&auml;rkten, sondern auch selbst zubereitet toll.</strong></p>\r\n<ol>\r\n<li>Rotwein mit den Gew&uuml;rzen und den Zitruszesten der Orange und Zitrone 1 Stunde zugedeckt erhitzen, aber nicht kochen lassen.</li>\r\n<li>Danach den Gl&uuml;hwein noch mind. eine halbe Stunde ziehen lassen. Anschlie&szlig;end durch ein Sieb gie&szlig;en und vor dem Genuss eventuell nochmals erw&auml;rmen.</li>\r\n<li>Mit einer Zitronenspalte am Glasrand servieren.</li>\r\n</ol>',
        'glühwein', 2, 5, 2, '2_7.png', '2022-01-16 18:03:54', 0, 0),
       (8, 'Bananen Pudding Tiramisu',
        '<p><strong>Verf&uuml;hrerisches Bananen Pudding Tiramisu schmeckt himmlisch und ist ein einfaches Rezept zum Nachkochen f&uuml;r Jedermann</strong></p>\r\n<ol>\r\n<li>Das Puddingpulver in eine Sch&uuml;ssel geben. Von der kalten Milch 8 EL entnehmen und zum Puddingpulver zuf&uuml;gen. Gut verr&uuml;hren.</li>\r\n<li>Die restliche Milch in einen Topf geben und mit dem Zucker aufkochen lassen. (St&auml;ndig r&uuml;hren, damit nichts anbrennt.) Die kochende Milch von der Herdplatte nehmen und das Puddingpulver ca. 1 Min. kurz aufkochen lassen. Danach den Pudding p&uuml;rieren.</li>\r\n<li>in die Gl&auml;ser zuerst den Bananenpudding geben. Danach die Mascarpone dr&uuml;ber streichen und so lange die Creme abwechseln in die Gl&auml;ser schichten bis keine Puddingcreme und Mascarpone mehr &uuml;brig ist. F&uuml;r ca 30 Min. in den K&uuml;hlschrank stellen und danach verzehren.</li>\r\n</ol>',
        'bananen-pudding-tiramisu', 2, 3, 2, '2_8.png', '2022-01-16 18:19:32', 0, 0),
       (9, 'Naturschnitzel',
        '<p><strong>immer gerne serviert werden Naturschnitzel. Hier ein Rezept f&uuml;r das n&auml;chste Mittagessen am Sonntag</strong></p>\r\n<ol>\r\n<li>Die Schnitzel klopfen, am Rand einschneiden, salzen und pfeffern. Eine Seite in Mehl tauchen und mit dieser zuerst in hei&szlig;es Fett legen und beiderseits anbraten. Aus der Pfanne heben und warm halten.</li>\r\n<li>Ein St&uuml;ck Butter in die Pfanne geben, mit Suppe aufgie&szlig;en und aufkochen lassen. Die Schnitzel auf Tellern anrichten mit de Saft &uuml;bergie&szlig;en und mit Reis servieren.</li>\r\n</ol>',
        'naturschnitzel', 2, 4, 1, '2_9.png', '2022-01-17 07:36:26', 0, 0),
       (10, 'Kürbiscremesuppe',
        '<p><strong>Eine zarte, cremige K&uuml;rbiscremesuppe bereiten Sie mit folgendem Rezept einfach zu. Eine delikate Suppe die bestimmt schmeckt.</strong></p>\r\n<ol>\r\n<li>F&uuml;r diese k&ouml;stliche K&uuml;rbiscremesuppe zuerst den Zwiebel sch&auml;len, in feine St&uuml;ckchen schneiden und in einer hohen Pfanne in Butterschmalz kurz anschwitzen.</li>\r\n<li>Danach das gesch&auml;lte, gew&uuml;rfelte K&uuml;rbisfleisch zugeben, kurz mitbraten lassen und danach mit der Suppe aufgie&szlig;en.</li>\r\n<li>Die Suppe / Br&uuml;he gut w&uuml;rzen mit Salz, Pfeffer, Muskat, fein gehacktem Thymian und ein paar Korianderk&ouml;rner. Die K&uuml;rbisst&uuml;cke darin bei leichter Hitze weichkochen und anschlie&szlig;end mit einem P&uuml;rierstab p&uuml;rieren.</li>\r\n<li>Nochmals kurz abschmecken und nachw&uuml;rzen und das Gericht mit etwas Schlagobers verfeinern bzw. einr&uuml;hren.</li>\r\n</ol>',
        'kürbiscremesuppe', 2, 6, 2, '2_10.png', '2022-01-17 07:50:44', 0, 0),
       (11, 'Türkische Falafel',
        '<p><strong>T&uuml;rkische Falafel schmecken der ganzen Familie. Das vegetarische Rezept passt wunderbar f&uuml;r einen Tag ohne Fleisch</strong></p>\r\n<ol>\r\n<li>F&uuml;r die t&uuml;rkische Falafel schon am Vortag die Kichererbsen in reichlich Wasser einweichen. Am n&auml;chsten Tag das Wasser abgie&szlig;en.</li>\r\n<li>Dann den Koriander waschen, gut abtropfen lassen und fein hacken. Knoblauch und Zwiebel sch&auml;len und fein w&uuml;rfeln.</li>\r\n<li>Anschlie&szlig;end die ungekochten Kichererbsen mit dem Stabmixer p&uuml;rieren.</li>\r\n<li>Danach Koriander, Knoblauch und Zwiebel dazugeben und alles fein p&uuml;rieren. Mit Salz, Pfeffer und Kreuzk&uuml;mmel w&uuml;rzen, den Zitronensaft hinzugeben und alles gut vermischen.</li>\r\n<li>In einer tiefen Pfanne das &Ouml;l erhitzen. Dann aus der Masse B&auml;llchen formen (am besten mit leicht feuchten H&auml;nden) und rundum die B&auml;llchen goldbraun backen. Vor dem Servieren auf K&uuml;chenpapier abtropfen lassen.</li>\r\n</ol>',
        'türkische-falafel', 2, 4, 3, '2_11.png', '2022-01-17 08:07:38', 0, 0),
       (12, '7-Kornflocken mit Apfel',
        '<p><strong>Das Rezept 7-Kornflocken mit Apfel ist ein wunderbares Fr&uuml;hst&uuml;ck und darf jeden Tag auf den Tisch</strong></p>\r\n<ol>\r\n<li>F&uuml;r die 7-Kornflocken mit Apfel als erstes den Apfel waschen und in kleine W&uuml;rfel schneiden, mit den 7 Kornflocken, Milch, und Honig in ein verschlie&szlig;bares Glas geben und umr&uuml;hren.</li>\r\n<li>Die Walnuss-H&auml;lften dar&uuml;ber geben, das Glas verschlie&szlig;en und im K&uuml;hlschrank &uuml;ber Nacht ziehen lassen.</li>\r\n</ol>',
        '7-kornflocken-flocken-mit-apfel', 2, 1, 2, '2_12.png', '2022-01-17 08:17:07', 0, 0),
       (13, 'American Pancakes',
        '<p><strong>Das American Pancakes - Rezept ist perfekt f&uuml;r das Sonntagsfr&uuml;hst&uuml;ck!</strong></p>\r\n<ol>\r\n<li>Das Eiwei&szlig; mit Zucker zu Schnee schlagen. In einer zweiten Sch&uuml;ssel Eidotter und Sauerrahm glatt r&uuml;hren. Den Eischnee unterheben.</li>\r\n<li>Butter in einer Pfanne erhitzen und zergehen lassen. Jeweils 2-3 Essl&ouml;ffel des Teigs hineingeben und backen lassen. Wenn der Teig fest wird, wenden.</li>\r\n</ol>',
        'american-pancakes', 1, 1, 2, '1_13.png', '2022-01-17 08:24:29', 0, 0),
       (14, '3-Minuten Ei',
        '<p><strong>Ein 3-Minuten Ei oder auch liebevoll weiches Ei genannt, passt zum Fr&uuml;hst&uuml;ck und ist gesund. Das einfache Rezept f&uuml;r Jedermann.</strong></p>\r\n<ol>\r\n<li>F&uuml;r das 3-Minuten Ei wird das Wasser mit etwas Salz im Topf zum Kochen gebracht. Dann legt man die einzelnen Eier mit Hilfe eines Essl&ouml;ffels langsam in das Wasser.</li>\r\n<li>Nun genau auf die Uhr sehen und 3 Minuten im kochenden Wasser wallen lassen. Anschlie&szlig;end das Ei sofort aus dem Wasser nehmen und sofort mit kaltem Wasser abschrecken. Nun kann die obere Schalenh&auml;lfte vom Ei gel&ouml;st werden. Noch hei&szlig; in einem Eierbecher Servieren.</li>\r\n<li>Wird die Kochdauer dabei verl&auml;ngert z.B. 4 - 5 oder 6 Minuten, entsteht ein kernweiches oder auch hartes Ei.</li>\r\n</ol>',
        '3-minuten-ei ', 3, 1, 2, '3_14.png', '2022-01-17 08:34:02', 0, 0),
       (15, 'Orangenpunsch',
        '<p><strong>Ein hei&szlig;er Orangenpunsch ist in der kalten Jahreszeit immer willkommen. Mit Freunden in freier Natur genießen.</strong></p>\r\n<ol>\r\n<li>Orangen und Zitronen auspressen.</li>\r\n<li>In einen Topf gibt man das Wasser und den Wei&szlig;wein hinein. Den Orangen- und Zitronensaft zuf&uuml;gen und erhitzen.</li>\r\n<li>Nach f&uuml;nf Minuten gibt man die Gew&uuml;rze wie Nelken, Zucker, Zimtstange und Rum hinzu.</li>\r\n<li>F&uuml;r ca. 30 Minuten ziehen lassen. Danach durch ein feines Sieb in einen neuen Topf abseihen und jetzt einmal ganz kurz aufkochen lassen.</li>\r\n<li>In Tassen oder Gl&auml;ser f&uuml;llen und mit Orangenscheiben dekorieren.</li>\r\n</ol>',
        'orangenpunsch', 3, 5, 2, '3_15.png', '2022-01-17 08:40:47', 0, 0),
       (16, 'Chili Sin Carne',
        '<p><strong>Ein herzhaftes Chili sin Carne darf jeden Tag auf den Tisch. Das vegane Rezept schmeckt immer.</strong></p>\r\n<ol>\r\n<li>F&uuml;r das Chili Sin Carne, Karotten mit einem Sparsch&auml;ler sch&auml;len und klein w&uuml;rfelig schneiden. Zwiebel und Knoblauch sch&auml;len und fein hacken. Bohnen und mais jeweils aus der Dose geben und mit klarem Wasser absp&uuml;len und abtropfen lassen.</li>\r\n<li>Paprika waschen, in Schoten&nbsp; schneiden und die Schoten danach w&uuml;rfelig schneiden. Tomaten waschen und klein w&uuml;rfelig schneiden.</li>\r\n<li>Nun in einem Topf das &Ouml;l erhitzen, zuerst Zwiebel mit dem Knoblauch goldgelb anr&ouml;sten. Karotten, Paprika und Sellerie zuf&uuml;gen und kurz unter r&uuml;hren mitschwitzen lassen. Tomaten zuf&uuml;gen. Mit Suppe aufgie&szlig;en. Zum Schluss das Tomatenmark zuf&uuml;gen und f&uuml;r ca. 20 Min. auf kleiner Flamme leicht k&ouml;cheln lassen.</li>\r\n<li>W&auml;hrenddessen Petersilie und frische Chili fein hacken. Kurz vor Ende der Kochzeit Bohnen, Mais, Petersilie und Chili dem Gericht zuf&uuml;gen. Weiters mit Salz, Cayennepfeffer nach Geschmack w&uuml;rzen. Mit Petersilie verfeinern.</li>\r\n</ol>',
        'chili-sin-carne', 3, 4, 3, '3_16.png', '2022-01-17 08:59:40', 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `recipe_has_ingredient_has_unit_of_measurement`
--

CREATE TABLE rezeptfabrik.recipe_has_ingredient_has_unit_of_measurement
(
    `recipe_id`              int(11) NOT NULL,
    `ingredient_id`          int(11) NOT NULL,
    `unit_of_measurement_id` int(11) NOT NULL,
    `amount`                 float   NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

--
-- Daten für Tabelle `recipe_has_ingredient_has_unit_of_measurement`
--

INSERT INTO rezeptfabrik.recipe_has_ingredient_has_unit_of_measurement (`recipe_id`, `ingredient_id`, `unit_of_measurement_id`, `amount`)
VALUES (1, 1, 5, 5),
       (1, 2, 7, 0.5),
       (1, 3, 4, 320),
       (1, 4, 7, 10),
       (2, 5, 7, 4),
       (2, 6, 10, 1),
       (2, 7, 7, 2),
       (2, 8, 1, 300),
       (2, 9, 12, 1),
       (2, 10, 7, 1),
       (3, 11, 1, 250),
       (3, 12, 7, 1),
       (3, 13, 7, 2),
       (3, 14, 9, 2),
       (3, 15, 6, 1),
       (3, 6, 10, 1),
       (3, 16, 10, 1),
       (3, 17, 4, 100),
       (4, 18, 7, 4),
       (4, 19, 1, 50),
       (4, 20, 9, 2),
       (4, 21, 7, 2),
       (4, 22, 4, 400),
       (5, 23, 1, 300),
       (5, 24, 1, 80),
       (5, 25, 7, 3),
       (5, 26, 7, 1),
       (5, 27, 7, 1),
       (5, 28, 1, 300),
       (5, 29, 1, 15),
       (5, 30, 7, 1),
       (5, 14, 4, 125),
       (5, 31, 9, 2),
       (5, 19, 8, 1),
       (5, 16, 10, 1),
       (5, 6, 10, 1),
       (7, 32, 7, 3),
       (7, 10, 7, 1),
       (7, 33, 7, 1),
       (7, 34, 7, 6),
       (7, 35, 6, 1),
       (7, 36, 9, 4),
       (8, 37, 1, 400),
       (8, 38, 12, 1),
       (8, 22, 6, 0.5),
       (8, 39, 9, 3),
       (8, 40, 7, 2),
       (8, 17, 4, 200),
       (9, 41, 7, 4),
       (9, 6, 10, 1),
       (9, 20, 9, 2),
       (9, 42, 9, 2),
       (9, 43, 1, 20),
       (9, 44, 4, 250),
       (9, 16, 10, 1),
       (10, 45, 7, 1),
       (10, 46, 9, 1),
       (10, 47, 1, 500),
       (10, 48, 6, 1),
       (10, 6, 10, 1),
       (10, 16, 10, 1),
       (10, 49, 10, 1),
       (10, 50, 10, 1),
       (10, 51, 7, 3),
       (10, 52, 6, 0.25),
       (11, 53, 1, 250),
       (11, 54, 12, 1),
       (11, 55, 7, 1),
       (11, 56, 7, 3),
       (11, 57, 8, 1),
       (11, 31, 9, 2),
       (11, 16, 10, 1),
       (11, 6, 8, 0.5),
       (11, 42, 9, 5),
       (12, 58, 1, 50),
       (12, 22, 4, 200),
       (12, 59, 9, 1),
       (12, 60, 1, 50),
       (12, 61, 1, 100),
       (13, 7, 7, 4),
       (13, 19, 1, 50),
       (13, 62, 1, 150),
       (13, 20, 1, 100),
       (13, 43, 1, 30),
       (14, 7, 7, 2),
       (14, 63, 4, 150),
       (14, 6, 10, 1),
       (15, 33, 7, 9),
       (15, 64, 7, 2),
       (15, 32, 7, 1),
       (15, 65, 4, 60),
       (15, 34, 7, 4),
       (15, 66, 1, 80),
       (15, 63, 4, 300),
       (15, 67, 4, 500),
       (16, 68, 1, 400),
       (16, 69, 10, 1),
       (16, 70, 12, 0.5),
       (16, 71, 7, 1),
       (16, 15, 4, 200),
       (16, 42, 11, 1),
       (16, 72, 1, 400),
       (16, 73, 9, 2),
       (16, 74, 1, 60),
       (16, 75, 7, 1),
       (16, 76, 1, 200),
       (16, 77, 1, 300),
       (16, 56, 7, 1),
       (16, 55, 7, 1),
       (16, 6, 10, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `role`
--

CREATE TABLE rezeptfabrik.role
(
    `name` varchar(30) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

--
-- Daten für Tabelle `role`
--

INSERT INTO rezeptfabrik.role (`name`)
VALUES ('ADMIN'),
       ('Chefkoch'),
       ('Hobbykoch'),
       ('USER');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `type`
--

CREATE TABLE rezeptfabrik.type
(
    `id`   int(11) NOT NULL,
    `name` varchar(30) DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

--
-- Daten für Tabelle `type`
--

INSERT INTO rezeptfabrik.type (`id`, `name`)
VALUES (1, 'mit Fleisch'),
       (2, 'vegetarisch'),
       (3, 'vegan');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `unit_of_measurement`
--

CREATE TABLE rezeptfabrik.unit_of_measurement
(
    `id`   int(11) NOT NULL,
    `name` varchar(15) DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

--
-- Daten für Tabelle `unit_of_measurement`
--

INSERT INTO rezeptfabrik.unit_of_measurement (`id`, `name`)
VALUES (1, 'g'),
       (2, 'dag'),
       (3, 'kg'),
       (4, 'ml'),
       (5, 'cl'),
       (6, 'l'),
       (7, 'Stück'),
       (8, 'TL'),
       (9, 'EL'),
       (10, 'Prise'),
       (11, 'Schuss'),
       (12, 'Pkg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE rezeptfabrik.user
(
    `id`        int(11)      NOT NULL,
    `firstname` varchar(30)  NOT NULL,
    `lastname`  varchar(30)  NOT NULL,
    `user_name` varchar(30)  NOT NULL,
    `email`     varchar(255) NOT NULL,
    `password`  text         NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

--
-- Daten für Tabelle `user`
--

INSERT INTO rezeptfabrik.user (`id`, `firstname`, `lastname`, `user_name`, `email`, `password`)
VALUES (1, 'andi', 'andi', 'andi', 'andi@andi.com', '$2y$10$S/xA0FROTgfsgtyoEbIvluuqGLX25MJmwOiRH58TdRgoV/gpRqLWa'),
       (2, 'fabi', 'fabi', 'fabi', 'fabi@fabi.com', '$2y$10$vmPg81nOobLDAVGiRGRfreGvEXoWh.obTr9bKYQfRc2EuDeh.XHAG'),
       (3, 'maxi', 'maxi', 'maxi', 'maxi@maxi.com', '$2y$10$jCQDkMd9O5Ng6L86wSMsyuQyK9sQctVLdwBYY/QKDNaYmMLPNTkjC'),
       (4, 'peter', 'peter', 'peter', 'peter@peter.com',
        '$2y$10$3Zduf3VFa0hnyVW9YJ9bHOd9e0BzLQKQmR2qCeXb6SZ0wqJ85zIUi'),
       (5, 'petra', 'petra', 'petra', 'petra@petra.com',
        '$2y$10$CXDTDX5FRGvX6LyPoQIVl.H/8n.6cAloUkSlquAQk23icmrD0YkdO');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_has_favorites`
--

CREATE TABLE rezeptfabrik.user_has_favorites
(
    `user_id`   int(11) NOT NULL,
    `recipe_id` int(11) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_has_role`
--

CREATE TABLE rezeptfabrik.user_has_role
(
    `user_id`   int(11)     NOT NULL,
    `role_name` varchar(30) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

--
-- Daten für Tabelle `user_has_role`
--

INSERT INTO rezeptfabrik.user_has_role (`user_id`, `role_name`)
VALUES (1, 'ADMIN'),
       (1, 'USER'),
       (2, 'ADMIN'),
       (2, 'USER'),
       (3, 'USER'),
       (4, 'USER'),
       (5, 'USER');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `category`
--
ALTER TABLE rezeptfabrik.category
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `ingredient`
--
ALTER TABLE rezeptfabrik.ingredient
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `recipe`
--
ALTER TABLE rezeptfabrik.recipe
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `title` (`title`),
    ADD UNIQUE KEY `slug` (`slug`);

--
-- Indizes für die Tabelle `recipe_has_ingredient_has_unit_of_measurement`
--
ALTER TABLE rezeptfabrik.recipe_has_ingredient_has_unit_of_measurement
    ADD KEY `fk_riuom_rid` (`recipe_id`),
    ADD KEY `fk_riuom_iid` (`ingredient_id`),
    ADD KEY `fk_riuom_uomid` (`unit_of_measurement_id`);

--
-- Indizes für die Tabelle `role`
--
ALTER TABLE rezeptfabrik.role
    ADD PRIMARY KEY (`name`);

--
-- Indizes für die Tabelle `type`
--
ALTER TABLE rezeptfabrik.type
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `unit_of_measurement`
--
ALTER TABLE rezeptfabrik.unit_of_measurement
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE rezeptfabrik.user
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `user_name` (`user_name`),
    ADD UNIQUE KEY `email` (`email`);

--
-- Indizes für die Tabelle `user_has_favorites`
--
ALTER TABLE rezeptfabrik.user_has_favorites
    ADD PRIMARY KEY (`user_id`, `recipe_id`),
    ADD KEY `fk_ufr_rid` (`recipe_id`);

--
-- Indizes für die Tabelle `user_has_role`
--
ALTER TABLE rezeptfabrik.user_has_role
    ADD PRIMARY KEY (`user_id`, `role_name`),
    ADD KEY `fk_uhr_rid` (`role_name`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `category`
--
ALTER TABLE rezeptfabrik.category
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 8;

--
-- AUTO_INCREMENT für Tabelle `ingredient`
--
ALTER TABLE rezeptfabrik.ingredient
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 78;

--
-- AUTO_INCREMENT für Tabelle `recipe`
--
ALTER TABLE rezeptfabrik.recipe
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 17;

--
-- AUTO_INCREMENT für Tabelle `type`
--
ALTER TABLE rezeptfabrik.type
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 4;

--
-- AUTO_INCREMENT für Tabelle `unit_of_measurement`
--
ALTER TABLE rezeptfabrik.unit_of_measurement
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 13;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE rezeptfabrik.user
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 6;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `recipe_has_ingredient_has_unit_of_measurement`
--
ALTER TABLE rezeptfabrik.recipe_has_ingredient_has_unit_of_measurement
    ADD CONSTRAINT `fk_riuom_iid` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`id`) ON UPDATE CASCADE,
    ADD CONSTRAINT `fk_riuom_rid` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`) ON UPDATE CASCADE,
    ADD CONSTRAINT `fk_riuom_uomid` FOREIGN KEY (`unit_of_measurement_id`) REFERENCES `unit_of_measurement` (`id`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `user_has_favorites`
--
ALTER TABLE rezeptfabrik.user_has_favorites
    ADD CONSTRAINT `fk_ufr_rid` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`),
    ADD CONSTRAINT `fk_ufr_uid` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints der Tabelle `user_has_role`
--
ALTER TABLE rezeptfabrik.user_has_role
    ADD CONSTRAINT `fk_uhr_rid` FOREIGN KEY (`role_name`) REFERENCES `role` (`name`) ON UPDATE CASCADE,
    ADD CONSTRAINT `fk_uhr_uid` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
