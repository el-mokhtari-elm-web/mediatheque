-- MySQL dump 10.13  Distrib 8.0.26, for macos11.3 (x86_64)
--
-- Host: localhost    Database: media_library
-- ------------------------------------------------------
-- Server version	8.0.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `book_rentals`
--

DROP TABLE IF EXISTS `book_rentals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `book_rentals` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `book_id` int NOT NULL,
  `rental_start` datetime NOT NULL,
  `rental_finish` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=361 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_rentals`
--

LOCK TABLES `book_rentals` WRITE;
/*!40000 ALTER TABLE `book_rentals` DISABLE KEYS */;
INSERT INTO `book_rentals` VALUES (346,140,6,'2021-10-21 04:59:25',NULL),(359,140,5,'2021-10-21 12:44:24',NULL),(360,140,2,'2021-10-21 12:50:41',NULL);
/*!40000 ALTER TABLE `book_rentals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `books` (
  `id` int NOT NULL AUTO_INCREMENT,
  `this_file_id` int NOT NULL,
  `book_title` varchar(70) NOT NULL,
  `synopsis` text NOT NULL,
  `genre` varchar(70) NOT NULL,
  `author` varchar(70) NOT NULL,
  `release_date` date NOT NULL,
  `statut` tinyint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (2,19,'da vinci code','Da Vinci Code est un roman écrit par l\'Américain Dan Brown, publié en 2003, composé de 105 chapitres et composant le deuxième volet de la pentalogie du personnage de fiction Robert Langdon. Le titre de la première édition francophone était Le Code de Vinci. Il fut adapté au cinéma en 2006 par Ron Howard.','thriller','dan brown','2003-03-18',0),(3,20,'catharis','La vie des cathares languedociens de 1200 à 1350, dans les comtés de Toulouse et de Foix et dans les quatre vicomtés de Trencavel (Carcassonne, Béziers, Albi et Nîmes). En effet, c\'est dans ces régions, qui furent le principal théâtre de la fameuse « Croisade contre les Albigeois », que l\'on saisit le mieux dans leur continuité historique l\'existence, le déclin et la tragédie du catharisme.','histoire','nelli rené','1989-07-06',1),(4,21,'game','Dans les secrets de la performance des meilleures équipes de foot du monde.Quelle est la recette secrète menant à la victoire ?\r\nLa question obsède tous les acteurs du ballon rond, qui explorent sans cesse de nouveaux univers pour la découvrir. Politique sportive, recrute-ment, méthodologie d\'entraînement, analyse vidéo, data, stratégie tactique, préparation physique et mentale, coaching...','sport','phillipe gargov','1985-07-11',1),(5,22,'flocon d\'amour','Dans un café bondé de pom-pom girls ou au détour d\'une route enneigée, les rencontres inattendues se multiplient. Les couples de font, se défont et se refondent. Louvoyant entre les flocons, les flèches de Cupidon qui pleuvent sur la ville ne laisseront personne de glaces !','romance','john green','1985-11-14',0),(6,23,'harry potter','Le jour de ses onze ans, Harry Potter, un orphelin élevé par un oncle et une tante qui le détestent, voit son existence bouleversée. Un géant vient le chercher pour l\'emmener au collège Poudlard, école de sorcellerie où une place l\'attend depuis toujours. Qui est donc Harry Potter?','fantastique','Joanne Rowling','1986-07-10',0),(7,24,'l\'hiver de la sorcière','La 4e de couverture indique : &quot;Moscou se relève difficilement d\'un terrible incendie. Le grand-prince est fou de rage et les habitants exigent des explications. Ils cherchent, surtout, quelqu\'un sur qui rejeter la faute. Vassia, avec ses étranges pouvoirs, fait une coupable idéale. ...','fantastique','katherine arden','2019-01-08',1),(8,25,'l\'aube sera grandiose','Ce soir, Nine, seize ans, n\'ira pas à la fête de son lycée. Titania, sa mère, en a décidé autrement. Elle embarque sa fille vers une destination inconnue, une cabane isolée, au bord d\'un lac. Il est temps pour elle de lui révéler l\'existence d\'un passé soigneusement caché. Commence alors une nuit entière de révélations...','romance','anne laure bondoux','2017-09-21',1),(9,26,'art et sport','La devise des Jeux Olympiques nous invite à repousser toujours plus loin nos limites... mais quand l\'art se met au sport, ce n\'est pas forcément le plus rapide, le plus agile ou le plus fort qui gagne ! Les artistes préfèrent souvent s\'échapper et tracer leur propre chemin. Ils trichent un peu avec la réalité et transforment les athlètes en robots ou en oiseaux, en marionnettes ou en extraterrestres.','sport','nicolas martins','2008-06-16',1),(10,27,'afrique','Découverte de l\'Afrique : par qui, et pour qui ? Les gens d\'ailleurs, Romains, Arabes, Européens, sont les premiers qui ont écrit sur l\'Afrique : leurs témoignages reflètent, au moins autant que l\'Afrique réelle de leur temps, l\'Afrique imaginaire dont ils ont contribué à &quot;fabriquer&quot; durablement le modèle.','decouverte','catherine Coquery-Vidrovitch','1965-07-08',1),(11,28,'1984','1984, le chef-d’œuvre de George Orwell, fait partie des plus grands textes du XXe siècle. Les lecteurs de tous âges connaissent Big Brother et Winston Smith, car plus qu’un roman politique et dystopique, 1984 a nourri notre imaginaire sans jamais perdre de son actualité. L’atmosphère envoûtante et le dessin aux teintes fantastiques de l’illustrateur brésilien Fido Nesti, alliés à la modernité de la traduction de Josée Kamoun, nous offrent aujourd’hui une magnifique édition de 1984, la première version graphique du texte','romance','george orwell','2020-11-04',1),(13,30,'la ligne verte','Paul Edgecombe, ancien gardien-chef d’un pénitencier dans les années 1930, entreprend d’écrire ses mémoires.\r\nIl revient sur l’affaire John Caffey – ce grand Noir au regard absent, condamné à mort pour le viol et le meurtre de deux fillettes – qui défraya la chronique en 1932.\r\nLa Ligne verte décrit un univers étouffant et brutal, où la défiance est la règle. Personne ne sort indemne de ce bâtiment coupé du monde, où cohabitent une étrange souris apprivoisée par un Cajun pyromane, le sadique Percy Wetmore, et Caffey, prisonnier sans problème. Assez rapidement convaincu de l’innocence de cet homme doté de pouvoirs surnaturels, Paul fera tout pour le sauver de la chaise électrique.','fantastique','stephen king','1996-08-29',1),(14,31,'litterartures française 1','Ouvrage de Littérature en français langue étrangère (FLE) dans la collection Progressive destiné aux grands adolescents et adultes niveau avancé (B2/C1).\r\nCet ouvrage a pour but de faire découvrir, comprendre et apprécier un choix de textes pami les plus représentatifs de la littérature française avec une ouverture sur la francophonie.','education','nicole blondeau','2008-02-09',1),(15,32,'litterartures française 2','Ouvrage de Littérature en français langue étrangère (FLE) dans la collection Progressive destiné aux grands adolescents et adultes niveau avancé (B2/C1). ce livert et le deuxième tome,\r\nCet ouvrage a pour but de faire découvrir, comprendre et apprécier un choix de textes pami les plus représentatifs de la littérature française avec une ouverture sur la francophonie.','education','nicole blondeau','2008-05-09',1),(16,33,'litterartures française 3','Ouvrage de Littérature en français langue étrangère (FLE) dans la collection Progressive destiné aux grands adolescents et adultes niveau avancé (B2/C1). ce livert et le troisième tome,\r\nCet ouvrage a pour but de faire découvrir, comprendre et apprécier un choix de textes pami les plus représentatifs de la littérature française avec une ouverture sur la francophonie.','education','nicole blondeau','2008-05-09',1),(17,34,'mort sur le nil','Mort sur le Nil est un roman policier d\'Agatha Christie publié le 1ᵉʳ novembre 1937 au Royaume-Uni chez Collins Crime Club, mettant en scène une des plus célèbres enquêtes du détective belge Hercule Poirot. Il est publié l\'année suivante aux États-Unis, et huit ans plus tard, en 1945, en France.','thriller','agatha christie','1937-11-01',1),(18,35,'night ocean','Night Ocean est un recueil de nouvelles de l\'auteur américain H. P. Lovecraft appartenant aux genres fantastique et science-fiction publié en France aux Éditions Belfond en 1986, avec une traduction de Jean-Paul Mourlon. Ce recueil est sans équivalent en langue anglaise.','sciences-fiction','Howard Phillips Lovecraft','1986-07-11',1),(19,36,'surface','Ici, personne ne veut plus de cette capitaine de police. Là-bas, personne ne veut de son enquête. Un grand roman, baigné d\'une profonde humanité.','thriller','Olivier Norek','2019-04-04',1),(20,37,'initiation à la poesie','En proposant une grande diversité des formes et motifs poétiques (vers libres ou variés, calligrammes, haïkus, chansons…), cet ouvrage permettra aux élèves de s’initier à la poésie en découvrant certains des plus beaux poèmes d’hier et d’aujourd’hui.','poesie','Josiane Grinfas','2014-05-02',1),(21,38,'poésie indienne','À l\'exception de Tagore et d\'une poignée d\'autres, I\'Inde poétique reste pour nous une immense terra incognita. C\'est donc à un voyage fascinant que nous conduit cette anthologie, la première à présenter la poésie indienne depuis ses origines védiques (il y a plus de trois mille ans) jusqu\'à aujourd\'hui.','poesie','des Védas','2020-03-12',1),(22,39,'poesie française','Vous les avez appris à l\'école ou vous souhaitez les redécouvrir ? Après le succès de sa première Petite Anthologie de la poésie française, Jean-Joseph Julaud vous emmène sur les traces des plus grands : Hugo, Verlaine, Rimbaud, Apollinaire et bien d\'autres vous souffleront dans l\'oreille ces doux vers qui font le patrimoine de notre littérature.','poesie','jean joseph julaud','2015-01-22',1),(23,40,'le cent plus beaux poème','Jean Orizet Les cent plus beaux poèmes de la langue française « Le titre de cette anthologie pourrait, à bon droit, sembler outrecuidant et sujet à caution s\'il reflétait le seul choix, forcément arbitraire, d\'un individu. Ce n\'est pas le cas ici.','poesie','jean orizet','2002-05-16',1),(24,41,'anthologie poésie française','Aux pages d\'anthologie de la poésie française se rencontrent les cinquante-deux meilleurs poètes de l\'histoire de la literature française. Les poètes: Eustache Deschamps (1346-1406) Charles d\' Orleans (1394-1465) François Villon (1431 - 1463) Clément Marot (1496-1544) Maurice Scève (1510-1564) Joachim Du Bellay (1522-1560) Pierre de Ronsard (1524-1585) Louise Labè (1526-1566)','poesie','Eustache Deschamps','2014-05-20',1),(25,42,'songe à la douceur','Quand Tatiana rencontre Eugène, elle a 14 ans, il en a 17 ; c’est l’été, et il n’a rien d’autre à faire que de lui parler. Il est sûr de lui, charmant, et plein d’ennui, et elle timide, idéaliste et romantique. Inévitablement, elle tombe amoureuse de lui, et lui, semblerait-il... aussi. Alors elle lui écrit une lettre ; il la rejette, pour de mauvaises raisons peut-être.','romance','Clémentine Beauvais','2016-08-24',1),(27,44,'aidez les élèves à apprendre','Quels processus déclenche-t-il lorsqu’il apprend une leçon, essaie de faire un devoir, tente de comprendre un cours ?\r\n\r\nGérard De Vecchi propose aux enseignants du premier et du second degré, avant toute démarche pédagogique volontariste, d’aider les élèves à se connaître, de les aider à construire des méthodes de travail adaptées à ce qu’ils sont réellement.','education','gérard de vecchi','2014-04-02',1),(28,45,'technologies d\'apprentissage','Aujourd\'hui plus que jamais, personne ne semble plus douter de la capacité des technologies à soutenir l\'enseignement et l\'apprentissage. Les enseignants et les apprenants n\'hésitent plus à distiller le savoir et à s\'en abreuver à travers Wikipédia, YouTube, Google et d\'autres outils technologiques très modernes.','education','alain claude ngouem','2015-07-08',1),(29,46,'café myrtille','Ellen Branford, ravissante avocate new-yorkaise, se doit d\'exaucer le voeu qu\'a formulé sa grand-mère avant de mourir : retrouver son amour de jeunesse et lui remettre sa dernière lettre. Ellen part sur la route, pour s\'arrêter à Beacon, petite ville côtière du Maine.','romance','mary simses','2013-11-14',1),(30,47,'discipline positive','Aujourd’hui, de nombreux parents et enseignants sont frustrés, voire désemparés, devant le comportement des enfants, bien éloigné des manières qu’ils ont connues. La Discipline Positive offre de façon pragmatique un ensemble d’outils et une démarche ni permissive, ni punitive, dans un cadre à la fois ferme et bienveillant.','education','Jane Nelson','2019-08-21',1),(32,49,'rome antique','Jamais encore la longue et fascinante histoire de Rome n\'avait été pensée et racontée par le recours à la datavisualisation. Nourri par l\'érudition de John Scheid, appuyé par Milan Melocco, et remarquablement mis en scène par Nicolas Guillerat, ce livre offre à tous une plongée dans le monde romain antique, de la naissance de la République au système politique impérial, des guerres civiles à la confrontation avec Carthage, de la religion à l\'économie de l\'Urbs.','histoire','Nicolas Guillerat','2020-10-07',1),(33,50,'la guerre de gaule','Ce livre est une oeuvre du domaine public éditée au format numérique par Ebooks libres et gratuits. L’achat de l’édition Kindle inclut le téléchargement via un réseau sans fil sur votre liseuse et vos applications de lecture Kindle.','histoire','jules cesar','2011-09-29',1),(34,51,'dosadi','Sur Dosadi, il ne reste qu\'une ville, Chu. Elle compte plus de quatre-vingt-dix millions d\'habitants et autour de ses murs, sur la Bordure, s\'en pressent au moins trois fois autant. Le reste. Le reste de la planète est désert. Parce que le sol, les plantes et les animaux, l\'air et l\'eau contiennent des poisons pour les deux races intelligentes qui peuplent Chu, les humains et les Gowadchins. Le seul espoir de survie réside dans les usines purificatrices de Chu.','sciences-fiction','frank herbert','2006-10-18',1),(35,52,'outsphere','Après avoir quitté une Terre mourante du fait des erreurs de nos sociétés, l\'Arche, premier vaisseau à coloniser une exoplanète, arrive au bout d\'un long voyage de 80 ans. Les colons sortent de leurs caissons cryogéniques et découvrent ce qui doit devenir un nouveau commencement pour l\'humanité. Une nouvelle planète, un monde principalement végétal baptisé Eden.','sciences-fiction','Guy-Roger Duvert','2021-03-02',1),(36,53,'aurora','Brillamment conçu et merveilleusement écrit, un roman majeur d\'une des voix les plus puissantes de la science-fiction moderne. Aurora raconte l\'histoire incroyable de notre premier voyage au-delà du système solaire, pour trouver un nouveau foyer.','sciences-fiction','kim stanley robinson','2021-01-06',1),(37,54,'les fourmis','Le temps que vous lisiez ces lignes, sept cents millions de fourmis seront nées sur la planète. Sept cents millions d\'individus dans une communauté estimée à un milliard de milliards, et qui a ses villes, sa hiérarchie, ses colonies, son langage, sa production industrielle, ses esclaves, ses mercenaires... Ses armes aussi. Terriblement destructrices.','decouverte','Bernard Werber','1997-05-01',1),(38,55,'les dinosaures','Avec une grande attention apportée aux détails, chaque dinosaure est fidèlement représenté sous la forme d\'un dessin spectaculaire, très réaliste et en grand format, accompagnée d\'une fiche qui repertorie l\'habitat, le poids, l\'alimentation, etc. et une echelle qui permet de comparer sa taille a celle de l\'homme... Extraordinaire, non ?','decouverte','jackson tom','2017-09-22',1),(39,56,'sport automobile','Le sport d’automobiles est une discipline fascinante ! Grâce à ce documentaire illustré, apprends à la connaître parfaitement : les premières courses, les voitures les plus rapides, le déroulement d’une course de formule 1…','sport','cathy franco','2021-01-08',1),(40,57,'la liste','L\'adjudant Maxime Monceau, spécialiste du langage non verbal, se voit chargé d\'enquêter sur une affaire mystérieuse qui met la Brigade de recherches dans une impasse. Un homme étrange s\'est présenté de lui-même à la gendarmerie pour s\'accuser d\'assassinat.','thriller','Florian Dennisson','2019-12-15',1),(41,58,'la maison du lac','Cette fois-ci, tout irait bien. Une nouvelle vie commençait pour Laura. Une magnifique colocation dans la montagne, la maison du lac et de nouveaux amis. Enfin la sérénité dans ce cadre idyllique. C’était exactement ce dont elle avait besoin et qu’elle espérait trouver ici…','thriller','isabelle mistler','2021-06-06',1),(42,59,'on se revarra','Qui est cet homme assis sur la plage en pleine tempête, sur le lieu d’un crime commis vingt ans plus tôt ? Il n’a pas de nom, pas de manteau, et a perdu la mémoire. Alice prend l’inconnu sous son aile et décide de l’héberger, sans savoir qu’il va bouleverser sa vie à jamais.','thriller','lisa jewell','2018-11-14',1),(43,60,'l\'empathie','Il resta plus d\'une heure debout, face au lit du couple. Il toisait la jeune femme qui dormait nue, sa hanche découverte. Puis il examina l\'homme à ses côtés. Sa grande idée lui vint ici, comme les pièces d\'un puzzle qu\'il avait sous les yeux depuis des années et qu\'il parvenait enfin à assembler. On en parlerait. Une apothéose.','thriller','antoine renand','2020-02-13',1),(44,29,'christophe colomb','En 1465, Christophe Colomb a une quinzaine d\'années quand il devient marin. Il étudie la cartographie et est convaincu d\'une chose : la Terre est ronde ! Voilà comment il trace un nouvel itinéraire qui doit le conduire jusqu\'en Chine. C\'est le début de sa première expédition... Embarquons avec lui et découvrons comment on vivait à bord des caravelles, comment on se repérait en pleine mer et affrontait les tempêtes.','decouverte','Viviane Koenig','2021-02-24',1),(45,62,'secret Japon','Mêlant carnets de croquis, dessins et photos des sites parmi les plus intrigants au monde, ce 3 ème Tome continue de faire parcourir au lecteur la piste des Anciens cette fois en se dirigeant au Sud du Japon. Nous y découvrirons pour la première fois au monde le corpus complet des mystérieuses tablettes de pierre d\'Okinawa reproduit, des vues des structures englouties de l\'île de Yonaguni et bien d\'autres merveilles comme la pyramide préhistorique de Gunung Padang.','decouverte','Franck Ferrandis','2020-10-19',1),(46,63,'jordan','Ce livre retrace toutes les étapes de cette ascension fulgurante en n’omettant aucun détail. L’enfance de Michael, son passage à l’université de North Carolina, son arrivée chez les Chicago Bulls, sa domination écrasante en NBA, la « Dream Team » des Jeux olympiques de Barcelone, son business, les affaires extra sportives, les conflits familiaux...','sport','roland lazenby','2008-02-29',1),(47,64,'constantin premier','Constantin (v. 273/274-337) est le premier empereur romain chrétien, celui qui a engagé l’empire dans la voie du christianisme mais dont la conversion personnelle suscite toujours bien des interrogations : en 312, avant la bataille du Pont Milvius, Constantin aurait reçu en songe l’injonction d’adopter un signe chrétien sur les boucliers de son armée afin de remporter la victoire.','histoire','vincent puech','2004-11-26',1),(48,65,'rugby','Les joueurs de la décennie 1980 étaient une fratrie, ils ont ébloui les amoureux du rugby par leur talent et leur imprévisibilité. En dépit du temps qui passe, l\'expression du French Flair s\'est ancrée et est demeurée inextricable dans ma mémoire comme un premier amour.','sport','david beresford','2001-07-05',1),(49,66,'mohammad ali','Le nom de Mohamed Ali semble désormais évoquer à lui seul le combat des hommes, l’insoumission. Comme si la vie était un ring. C’est pourquoi il fascine tant  jusqu’aux générations qui n’étaient pas nées,  et jusqu’au bout du monde.','sport','judith perignon','1991-11-14',1);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `files` (
  `id` int NOT NULL AUTO_INCREMENT,
  `this_filename` varchar(70) NOT NULL,
  `file_size` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` VALUES (19,'da-vinci-code.png','165.69 KB'),(20,'catharis.png','66.46 KB'),(21,'game.png','144.58 KB'),(22,'flocon-d-amour.jpg','87.19 KB'),(23,'harry-potter.gif','77.45 KB'),(24,'hiver-sorciere.png','195.05 KB'),(25,'aube-grandiose.png','148.13 KB'),(26,'art-et-sport.jpg','73.98 KB'),(27,'afrique.png','166.96 KB'),(28,'1984.png','165.77 KB'),(29,'christophe-colomb.jpg','98.67 KB'),(30,'la-ligne-verte.png','153.53 KB'),(31,'litterature-1.png','159.77 KB'),(32,'litterature-2.png','163.29 KB'),(33,'litterature-3.png','158.94 KB'),(34,'mort-sur-le-nil.png','92.38 KB'),(35,'night-ocean.png','212.37 KB'),(36,'noirek.png','139.68 KB'),(37,'poesie-1.jpg','177.12 KB'),(38,'poesie-2.svg','31.38 KB'),(39,'poesie-3.png','187.48 KB'),(40,'poesie-4.gif','65.80 KB'),(41,'poesie-5.png','134.05 KB'),(42,'songe-douceur.png','158.60 KB'),(43,'west.png','217.22 KB'),(44,'apprentissage-eleve.png','42.97 KB'),(45,'techno-apprentissage.png','55.63 KB'),(46,'cafe-myrtille.png','163.99 KB'),(47,'discipline-positive.png','74.62 KB'),(48,'','0'),(49,'rome.png','79.36 KB'),(50,'guerre-gaule.png','73.99 KB'),(51,'dosadi.png','132.69 KB'),(52,'outsphere.png','130.11 KB'),(53,'aurora.png','123.38 KB'),(54,'fourmis.png','85.45 KB'),(55,'dinosaure.png','148.55 KB'),(56,'sport-auto.png','140.35 KB'),(57,'la-liste.png','122.91 KB'),(58,'maison-du-lac.png','84.98 KB'),(59,'on-se-reverra.png','126.64 KB'),(60,'empathie.png','132.68 KB'),(61,'christophe-colomb.jpg','98.67 KB'),(62,'secret-japon.png','112.14 KB'),(63,'jordan.png','102.57 KB'),(64,'constantin.png','184.35 KB'),(65,'rugby.png','87.32 KB'),(66,'boxe.png','143.35 KB');
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `to_user_id` int NOT NULL,
  `notification_name` varchar(70) NOT NULL,
  `notification_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registrations`
--

DROP TABLE IF EXISTS `registrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registrations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `by_user_id` int DEFAULT NULL,
  `to_user_id` int NOT NULL,
  `recording_type` varchar(17) NOT NULL,
  `registration_date` date DEFAULT NULL,
  `termination_date` date DEFAULT NULL,
  `by_full_name` varchar(70) DEFAULT NULL,
  `to_full_name` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registrations`
--

LOCK TABLES `registrations` WRITE;
/*!40000 ALTER TABLE `registrations` DISABLE KEYS */;
INSERT INTO `registrations` VALUES (62,135,135,'administrateur','2021-10-08',NULL,'youssef - el mokhtari','youssef - el mokhtari'),(64,135,140,'employe','2021-10-13',NULL,'youssef - el mokhtari','atilla - le hunt'),(70,135,146,'employe','2021-10-19',NULL,'youssef - el mokhtari','khaled - ibn walid'),(73,135,149,'employe','2021-10-14','2021-10-21','youssef - el mokhtari','tarantino - albert'),(74,135,150,'user_subscriber','2021-10-21',NULL,'youssef - el mokhtari','troiyan - maxense'),(75,135,151,'user_subscriber','2021-10-21',NULL,'youssef - el mokhtari','el mokrane - moncef'),(76,140,152,'user_subscriber','2021-10-14',NULL,'atilla - le hunt','beranger - saunier'),(77,135,153,'user_subscriber','2021-10-21',NULL,'youssef - el mokhtari','beracour - albert'),(78,NULL,154,'user_subscriber','2021-10-14',NULL,NULL,'xdwvdfs - dwsfbvdfxbv'),(82,135,158,'employe','2021-10-20','2021-10-21','youssef - el mokhtari','nicol - kiddman'),(87,140,163,'user_subscriber','2021-10-21',NULL,'atilla - le hunt','svsrgvrs - sdvsvg'),(88,140,164,'user_subscriber','2021-10-21',NULL,'atilla - le hunt','albert - norbert'),(89,140,165,'user_subscriber','2021-10-21','2021-10-21','atilla - le hunt','qdvsdv - qvsdvf'),(90,140,166,'user_subscriber','2021-10-21','2021-10-21','atilla - le hunt','sdvsbvg - sdvdsvgs'),(91,135,167,'user_subscriber','2021-10-21',NULL,'youssef - el mokhtari','sdbvsfv - sdbvsfbsf'),(92,140,168,'user_subscriber','2021-10-21',NULL,'atilla - le hunt','sd bfdvsf - dfbdfvgf');
/*!40000 ALTER TABLE `registrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email_user` varchar(50) NOT NULL,
  `pass_user` varchar(50) NOT NULL,
  `type_user` varchar(16) NOT NULL,
  `level_user` int NOT NULL,
  `statut_user` varchar(13) NOT NULL,
  `date_of_birth` date NOT NULL,
  `postal_code` int NOT NULL,
  `adress` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (135,'youssef','el mokhtari','contact.elmweb@gmail.com','c11fa46c4291e28af68fba6c407f2430','administrateur',1,'actif','1977-02-05',59600,'place du village fleuri imm 2 apt 212 59600 Maubeuge'),(140,'atilla','le hunt','contact.atilla@gmail.com','c11fa46c4291e28af68fba6c407f2430','employe',2,'actif','1991-07-11',75005,'33, place rome antique'),(146,'khaled','ibn walid','contact.khaled@gmail.com','c11fa46c4291e28af68fba6c407f2430','employe',2,'actif','2004-03-04',87500,'56, rue des martyrs'),(149,'tarantino','albert','contact.albert@gmail.com','c11fa46c4291e28af68fba6c407f2430','employe',2,'non actif','2006-02-01',90870,'33, place des bateliers grenoble'),(150,'troiyan','maxense','contact.maxense@gmail.com','c11fa46c4291e28af68fba6c407f2430','user_subscriber',3,'actif','1972-06-15',75002,'33, rue marcadet poissonnier Paris'),(151,'el mokrane','moncef','contact.moncef@gmail.com','c11fa46c4291e28af68fba6c407f2430','user_subscriber',3,'actif','1989-03-09',76500,'10, avenue du général de gaule'),(152,'beranger','saunier','contact.saunier@gmail.com','c11fa46c4291e28af68fba6c407f2430','user_subscriber',3,'non actif','1976-06-09',78600,'33, rue de l\'église Rennes le Château'),(153,'beracour','albert','contact.albert@gmail.com','c11fa46c4291e28af68fba6c407f2430','user_subscriber',3,'actif','1961-06-14',79600,'33, rue de maubeuge'),(158,'nicol','kiddman','contact.kiddman@gmail.com','c11fa46c4291e28af68fba6c407f2430','employe',2,'non actif','1998-01-29',45300,'33, place de New York'),(163,'svsrgvrs','sdvsvg','contact.web@gmail.com','c11fa46c4291e28af68fba6c407f2430','user_subscriber',3,'actif','2021-09-28',98000,'dsvsbsbsgf'),(164,'albert','norbert','contact.norbert@gmail.com','c11fa46c4291e28af68fba6c407f2430','user_subscriber',3,'actif','2005-06-08',87000,'33, boulevard pasteur Nantes'),(165,'qdvsdv','qvsdvf','contact.eli@gmail.com','c11fa46c4291e28af68fba6c407f2430','user_subscriber',3,'non actif','2021-09-29',98000,'qvcsvsvsfgvbg'),(166,'sdvsbvg','sdvdsvgs','contact.elweb@gmail.com','c11fa46c4291e28af68fba6c407f2430','user_subscriber',3,'non actif','2021-09-30',98000,'svsvgvsrbsgbgs'),(167,'sdbvsfv','sdbvsfbsf','contact.elmw@gmail.com','c11fa46c4291e28af68fba6c407f2430','user_subscriber',3,'actif','2021-10-06',76000,'svsvbsfbfbdfbfdgbfdgbg'),(168,'sd bfdvsf','dfbdfvgf','contact.eleb@gmail.com','c11fa46c4291e28af68fba6c407f2430','user_subscriber',3,'actif','2021-10-15',98000,'sfbvdbdbdbdgbngh');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-21 14:12:33
