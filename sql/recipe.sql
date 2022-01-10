INSERT INTO `recipe` (`id`, `title`, `content`, `slug`, `user_id`, `category_id`, `type_id`, `photo_url`,
                      `published_date`, `rating_count`, `rating`)
VALUES (1, 'GlÃ¼hwein',
        'Der GlÃ¼hwein ist ein Klassiker im Winter und schmeckt nicht nur auf WeihnachtsmÃ¤rkten, sonder auch selbst zubereitet toll.\r\n1. Rotwein mit den GewÃ¼rzen und den Zitruszesten der Orange und Zitrone 1 Stunde zugedeckt erhitzen, aber nicht kochen lassen.\r\n2. Danach den GlÃ¼hwein noch mind. eine halbe Stunde ziehen lassen. AnschlieÃŸend durch ein Sieb gieÃŸen, und vor dem Genuss eventuell nochmals erwÃ¤rmen.\r\n3. Mit einer Zitronenspalte am Glasrand servieren.',
        'glÃ¼hwein', 1, 5, 1, '1_1.png', '2022-01-10 08:38:32', 0, 0),
       (2, 'Wiener Schnitzel',
        'Das klassische Wiener Schnitzel - Rezept wird am liebsten sonnatgs mit Petersilkartoffeln oder Reis serviert.\r\n1. Schnitzel zwischen Frischhaltefolie behutsam klopfen. Fleisch beidseitig salzen, in Mehl wenden, abklopfen, durch die Eier ziehen und in den BrÃ¶seln wenden.\r\n2. Schnitzel ca 2 Finger hoch Backfett goldgelb backen. WÃ¤hrend der Backens die Pfanne ein wenig rÃ¼tteln, damit die Schnitzel gleichmÃ¤ÃŸig goldbraun werden. Schnitzel herhausheben, auf KÃ¼chenpapier abtropfen lassen.\r\n3. Zitrone in Spalten schneiden und fetigen Wiener Schnitzel mit Zitronenspalten garnieren.',
        'wiener - schnit', 1, 4, 1, '1_2.png', '2022-01-10 08:56:24', 0, 0),
       (3, 'Brokkoli Suppe',
        'Suppen sind immer willkommen. Das Rezept fÃ¼r Brokkoli Suppe wÃ¤rmt unseren KÃ¶rper und spendet Kraft.\r\n1. FÃ¼r die Brokkolisuppe zuerst Brokkoli, Knoblauch und Zwiebeln fein hacken und in OlivenÃ¶l einige Minuten in einem Topf gut anbraten.\r\n2. Mit GemÃ¼sesuppe aufgieÃŸen und ca. 20 Minuten bei niedriger Hitze kÃ¶cheln lassen.\r\n3. AbschlieÃŸend mit einem Stabmixer kurz durchmixen und nach belieben mit Salz und Pfeffer abschmecken.\r\n4. Zum verfeinern kann noch Schlagobers untergrerÃ¼hrt werden.',
        'brokkoli - supp', 1, 2, 2, '1_3.png', '2022-01-10 09:30:56', 0, 0),
       (4, 'Polenta Grundrezept',
        'Dieses Rezept wird auf ein Backblech aufgestrichen, gebacken und anschlieÃŸend in StÃ¼cke geschnitten.\r\n1. Zuerst das Wasser in einem Topf zum Kochen bringen, das Salz zugeben und den MaisgrieÃŸ langsam einrÃ¼hren.\r\n2. Die Polenta, bei schwacher Hitze, rund 0 Minuten kÃ¶chln lasen- dabei Ã¶fters umrÃ¼hren.\r\n3. Danach nochmal 15 min ziehen lassen.\r\n4. Die Polenta kann so genossen werden oder man kann sie auf ein Backblech streichen, kaslt werden lassen, in StÃ¼cke scheiden und in Ã–l rausbraten.',
        'polenta - grund', 1, 4, 3, '', '2022-01-10 09:55:33', 0, 0);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes fÃ¼r die Tabelle `recipe`
--
ALTER TABLE `recipe`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `title` (`title`),
    ADD UNIQUE KEY `slug` (`slug`);

--
-- AUTO_INCREMENT fÃ¼r exportierte Tabellen
--

--
-- AUTO_INCREMENT fÃ¼r Tabelle `recipe`
--
ALTER TABLE `recipe`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 5;
COMMIT;
