INSERT INTO `SERIES` (`ID_SERIE`, `TITRE_SERIE`, `ANNEE_SERIE`, `PAYS_SERIE`, `SUM_SERIE`) VALUES
(0, 'The Walking Dead', 2010, 'USA', 'The Walking Dead est une série télévisée d''horreur / dramatique américaine, adaptée par Frank Darabont et Robert Kirkman, créateur de la bande dessinée du même nom.'),
(1, 'Game of Thrones', 2011, 'USA', 'Game of Thrones, également désignée par le titre français de l''œuvre romanesque dont elle est adaptée, Le Trône de fer, est une série télévisée américaine médiéval-fantastique créée par David Benioff et D. B.'),
(2, 'Daredevil', 2015, 'USA', ''),
(3, 'Vikings', 2013, 'USA', ''),
(4, 'House of Cards', 2013, 'USA', ''),
(5, 'The 100', 2014, 'USA', ''),
(6, '13 Reasons Why ', 2017, 'USA', ''),
(10, 'Breaking Bad', 2008, 'Etats-Unis', 'Walter White, 50 ans, est professeur de chimie dans un lycée du Nouveau-Mexique. Pour subvenir aux besoins de Skyler, sa femme enceinte, et de Walt Junior, son fils handicapé, il est obligé de travailler doublement.'),
(11, 'Tokyo Airport', 2012, 'Japon', 'Shinoda Kaori travaillait dans le personnel au sol de la compagnie aérienne Japan Airlines à l''aéroport international de Haneda, mais elle décide un jour de devenir contrôleuse aérienne. Lorsqu''elle fait ses débuts au simulateur sous la supervision de sa tutrice Takeuchi Yumi, Shinoda a tendance parfois à privilégier un tant soit peu le rendement sur la sécurité, pourtant priorité absolue dans son nouveau métier. Cependant à force de persévérance et d''observation, Shinoda va corriger ses défauts et parvenir à obtenir officiellement le droit de travailler dans la tour de contrôle de Haneda. Mais le plus dur est encore à venir.'),
(12, 'The defenders', 2017, 'USA', 'Adaptation du comic book Marvel homonyme, réunissant Daredevil, Luke Cage, Iron Fist et Jessica Jones.');

INSERT INTO `PHOTO_SERIE` (`ID_SERIE`, `URL`) VALUES
(0, 'http://images.affiches-et-posters.com//albums/3/4130/4130-affiche-serie-tv-the-walking-dead.jpg'),
(1, 'http://marvelll.fr/wp-content/uploads/2014/06/game-of-thrones-saison-4-poster.jpg'),
(2, 'https://i.annihil.us/u/prod/marvel/i/mg/8/f0/55141acf4ba76/standard_fantastic.jpg'),
(3, 'https://upload.wikimedia.org/wikipedia/commons/2/2c/Vikings_logo.png'),
(4, 'http://external-images.premiere.fr/var/premiere/storage/images/series/house-of-cards-us-2554460/38447439-4-fre-FR/House-of-Cards-US.jpg'),
(5, 'https://upload.wikimedia.org/wikipedia/en/6/6c/Logo_of_the_100.jpg'),
(6, 'http://www.gstatic.com/tv/thumb/tvbanners/13762579/p13762579_b_v8_aa.jpg'),
(10, '../img/breaking_bad.jpg'),
(11, '../img/tokyo_airport.jpg'),
(12, 'http://fr.web.img5.acsta.net/c_160_214/pictures/16/10/25/14/34/023324.jpg');

INSERT INTO `GENRES` (`NOM_GENRE`) VALUES
('Action'),
('Aventure'),
('Comédie'),
('Drame'),
('Fantaisie'),
('Romance'),
('Science-fiction'),
('Tous');

INSERT INTO `ETRE_DU_GENRE` (`NOM_GENRE`, `ID_SERIE`) VALUES
('Drame', 10),
('Science-Fiction', 10),
('Drame', 11),
('Science-Fiction', 11);

INSERT INTO `EPISODES` (`ID_EP`, `NOM_EP`, `DUREE_EP`, `DATE_EP`, `SUM_EP`, `SAISON_EP`, `ID_SERIE`) VALUES
(0, 'Passé décomposé (Days Gone Bye)	', 60, '2010-10-31', NULL, 1, 0),
(2, 'L''hiver vient (Winter is Coming)', 60, '2011-04-17', NULL, 0, 1),
(3, 'Sur le ring (Into the Ring)', 60, '2015-04-10', NULL, 0, 2),
(4, 'Cap à l''ouest', 60, '2013-03-03', NULL, 0, 3),
(5, 'L''Échiquier politique', 60, '2013-02-01', NULL, 0, 4),
(6, 'L’exil', 60, '2014-03-19', NULL, 0, 5),
(10, 'Vivre libre ou mourir ', 51, '2012-07-15', 'Walter a changé d''identité. Pour survivre, il doit retrouver les vidéos de Gus et s''assurer qu''elles ne tomberont pas entre les mains de Hank. Il lui faut entrer en contact avec Mike, qui est le seul à savoir où sont ces précieux enregistrements. Hélas, la police a déjà saisi les vidéos et les a mises sous scellés...', 1, 10),
(11, '1', 46, '2012-10-14', 'Episode 1', 1, 11);

INSERT INTO `INDIVIDUS` (`ID_IND`, `NOM_IND`, `PREN_IND`, `CREATEUR`, `PRODUCTEUR`, `ACTEUR`, `REALISATEUR`) VALUES
(0, ' Lee Cranston', 'Bryan', 'X', 'X', '-', '-'),
(10, 'Gilligan', 'Vince', 'X', '-', '-', '-'),
(11, 'Tokunaga', 'Yuichi', 'X', '-', '-', '-'),
(12, 'Uda', 'Manabu', '-', 'X', '-', '-'),
(13, 'Hayafune', 'Kaeko', '-', 'X', '-', '-'),
(14, 'Cranston', 'Bryan', '-', '-', 'X', '-'),
(15, 'Gunn', 'Anna', '-', '-', 'X', '-'),
(16, 'Gould', 'Peter', '-', '-', '-', 'X'),
(17, 'Johnson', 'Mark', '-', '-', '-', 'X');

INSERT INTO `PHOTO_INDIVIDU` (`ID_IND`, `URL`) VALUES
(10, '../img/Vince_Gilligan.jpg'),
(11, '../img/tokunaga_yuichi.jpg'),
(12, '../img/uda_manabu.jpg'),
(13, '../img/hayafune_kaeko.jpg'),
(14, '../img/Bryan_Cranston.jpg'),
(15, '../img/Anna_Gunn.jpg'),
(16, '../img/Peter_Gould.jpg'),
(17, '../img/johnson_mark.jpg');

INSERT INTO `PRODUIRE` (`ID_IND`, `ID_SERIE`) VALUES
(12, 10),
(13, 10),
(12, 11),
(13, 11);

INSERT INTO `CREER` (`ID_IND`, `ID_SERIE`, `DATE_CREATION`) VALUES
(10, 10, '2008-01-20'),
(10, 11, '2012-10-14'),
(11, 6, '0000-00-00'),
(11, 10, '2008-01-20'),
(11, 11, '2012-10-14');

INSERT INTO `JOUER` (`ID_IND`, `ID_EP`, `SAISON_EP`, `ID_SERIE`) VALUES
(14, 10, 1, 10),
(15, 10, 1, 10),
(14, 11, 1, 11),
(15, 11, 1, 11);

INSERT INTO `REALISER` (`ID_IND`, `ID_EP`, `SAISON_EP`, `ID_SERIE`) VALUES
(16, 10, 1, 10),
(17, 10, 1, 10),
(16, 11, 1, 11),
(17, 11, 1, 11);
