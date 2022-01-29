-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Dic 08, 2020 alle 10:03
-- Versione del server: 10.4.14-MariaDB
-- Versione PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zenaster_db`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotti`
--

CREATE TABLE `prodotti` (
  `gid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `genere` varchar(25) DEFAULT NULL,
  `dataUscita` date DEFAULT NULL,
  `prezzo` decimal(7,2) DEFAULT NULL,
  `descrizione` text DEFAULT NULL,
  `path_img` varchar(200) DEFAULT NULL,
  `tipo` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `prodotti`
--

INSERT INTO `prodotti` (`gid`, `title`, `genere`, `dataUscita`, `prezzo`, `descrizione`, `path_img`, `tipo`) VALUES
(1, 'The Last Of Us Part II', 'Avventura', '2020-06-16', '74.99', 'The Last of Us Parte II è un videogioco di sopravvivenza con elementi action e stealth e sfumature horror ambientato in un mondo chiuso. Il giocatore può usare armi da fuoco e armi improvvisate per difendersi contro gli esseri umani ostili, i cannibali o creature infettate dal Cordyceps. La piu\' bella saga del mondo, easy.', 'photos/games/1.jpg', 'games'),
(4, 'Spider-Man', 'Avventura', '2018-09-07', '39.99', 'Spider-Man è un videogioco d\'avventura dinamica ambientato in un moderno open world a New York e giocato da una prospettiva in terza persona. Presenta sistemi di combattimento come quello aereo, i riflessi grazie al \"senso di ragno\", il lancia-ragnatele e le mosse finali. L\'Uomo Ragno può spingere i nemici fuori dagli edifici tessendoli sul lato dell\'edificio. Peter Parker (al di fuori della sua identità dell\'Uomo Ragno), Miles Morales e Mary Jane Watson sono anche giocabili in alcune parti del gioco. ', 'photos/games/4.jpg', 'games'),
(5, 'Iron Man VR', 'Avventura', '2020-07-03', '39.99', 'The game\'s story revolves around Iron Man\'s conflict with a mysterious computer hacker and terrorist known only as Ghost, who targets Tony Stark and his company while seeking revenge for the deaths caused by the weapons the company manufactured prior to Stark becoming Iron Man. ', 'photos/games/5.jpg', 'games'),
(14, 'Assassin\'s Creed IV: Black Flag', 'Avventura', '2016-10-29', '19.99', 'Assassin\'s Creed IV: Black Flag è un videogioco d\'avventura del 2013, sviluppato da Ubisoft Montréal e pubblicato da Ubisoft.  Si tratta del sesto capitolo principale della serie Assassin\'s Creed.', 'photos/games/2.jpg', 'games'),
(15, 'Death Stranding', 'Avventura', '2019-11-08', '19.99', 'Per spiegare molto cripticamente la natura del videogioco, Kojima ha citato lo scrittore Kōbō Abe: «Il bastone è stato il primo strumento creato dall\'umanità per mettere una distanza tra sé e le cose minacciose, per proteggersi. Il secondo strumento creato dall\'umanità è stato la corda. Una corda è usata per legare cose importanti e tenerle vicine»; Kojima ha aggiunto pertanto che la maggior parte dei videogiochi d\'azione utilizza un approccio \"da bastoni\" nel gameplay, mentre il suo scopo è rendere Death Stranding un videogioco in cui sia importante anche un approccio \"da corde\". Kojima ha paragonato Death Stranding al primo gioco della saga di Metal Gear, – ora considerato come videogioco stealth – il quale fu chiamato \"gioco d\'azione\" al tempo della sua uscita, poiché il genere stealth non esisteva ancora.', 'photos/games/3.jpg', 'games'),
(184, 'Sekiro: Shadows Die Twice', 'Avventura', '2019-03-22', '69.99', 'E\' un videogioco action in stile souls-like. Il gioco segue le vicende di uno shinobi, il \"Lupo\", mentre tenta di salvare il giovane signore a cui ha giurato fedeltà.', 'photos/games/6.jpg', 'games'),
(185, 'The Last of Us', 'Avventura', '2014-08-21', '19.99', 'Il 9 aprile 2014 viene annunciata sul PlayStation Blog una versione del gioco \"rimasterizzata\" per PS4, intitolata The Last of Us Remastered. Questa presenta texture più definite, luci ed ombre migliorate, una risoluzione nativa di 1080p ed un framerate di 60 fps. Contiene inoltre un documentario sulle cinematiche di gioco e tutti i contenuti scaricabili inclusi nel gioco originale, con l\'aggiunta di un nuovo capitolo giocabile solo al termine dell\'avventura principale. Il capitolo è intitolato Left Behind. A differenza degli altri capitoli della storia, parte di questo è cronologicamente avvenuta prima degli eventi di The Last of Us. L\'uscita per PlayStation 4 è avvenuta il 29 luglio 2014.', 'photos/games/7.jpg', 'games'),
(186, 'Detroit: Become Human', 'Avventura', '2019-05-25', '19.99', 'Detroit (Michigan), anno 2038. Sono passati circa 20 anni da quando la CyberLife, un\'azienda tecnologica fondata nel 2018 dall\'eccentrico inventore Elijah Kamski, ha lanciato sul mercato gli androidi, delle vere e proprie macchine antropomorfe progettate per ogni tipo di lavoro; tuttavia l\'esorbitante numero di androidi ha molto innalzato il tasso di disoccupazione, causando il malcontento della popolazione americana.\r\n\r\nGli androidi sono programmati per eseguire gli ordini degli umani e non sono in grado di provare alcuna emozione o stanchezza fisica; da qualche tempo, però, sono sempre più frequenti i casi di alcune macchine, classificate come \"devianti\", che riescono a manifestare sentimenti umani come paura, rabbia e amore, suscitando preoccupazione all\'interno della CyberLife.\r\n\r\nDurante la storia, il giocatore segue le vicende di tre diversi androidi: Markus, Connor e Kara. ', 'photos/games/8.jpg', 'games'),
(187, 'Spyro: Reignited Trilogy', 'Animazione', '2018-11-13', '34.99', 'Spyro è un giovane drago viola che vive nelle terre dei draghi. Quando il malvagio orco Nasty Norc (mezzo gnomo e mezzo orco), nemico giurato dei draghi, attacca il suo mondo trasformando tutti i draghi in statue di cristallo, Spyro decide di viaggiare attraverso le terre dei draghi in compagnia della libellula Sparx per liberare i suoi simili e arrivare allo scontro finale con Nasty. ', 'photos/games/9.jpg', 'games'),
(188, 'Crash Bandicoot N. Sane Trilogy', 'Animazione', '2017-06-30', '34.99', 'Crash Bandicoot, il tuo marsupiale preferito, è tornato! Più bello e scatenato che mai, è pronto a lanciarsi nelle danze nella collezione Trilogia N. Sane. Un Crash Bandicoot™ come non l\'avevi mai visto prima! Gira, salta e balla affrontando sfide e avventure epiche nei tre giochi che hanno dato inizio alla leggenda: Crash Bandicoot, Crash Bandicoot 2: Il Ritorno di Cortex e Crash Bandicoot™: Teletrasportato. Rivivi i tuoi momenti preferiti in tutto lo splendore grafico dell\'HD completamente rimasterizzato per un divertimento in grande stile!', 'photos/games/10.jpg', 'games'),
(189, 'Ralph spacca Internet', 'Animazione', '2018-01-01', '19.99', 'La pellicola, 57º classico Disney, è il sequel del film del 2012 Ralph Spaccatutto, e vede Ralph immergersi nel mondo di internet, dove incontrerà le principesse Disney e altri celebri personaggi di universi cinematografici come Guerre stellari e Marvel.[', 'photos/films/1.png', 'film'),
(202, 'Matrix', 'Fantascienza', '1999-01-01', '9.99', 'Non puoi non sapere cos\'e\' Matrix ....', 'photos/films/2.png', 'film'),
(203, 'Frozen Collezione Film', 'Animazione', '2013-01-01', '19.99', 'Liberamente ispirato alla fiaba di Hans Christian Andersen La regina delle nevi, è un lungometraggio animato al computer, prodotto dalla Walt Disney Animation Studios e distribuito dalla Walt Disney Pictures. Il 2 marzo 2014 si aggiudica due premi Oscar: miglior film d\'animazione e miglior canzone (Let It Go in originale, All\'alba sorgerò in italiano). ', 'photos/films/3.png', 'film'),
(204, 'Il re leone', 'Animazione', '1994-08-04', '9.99', ' La storia ha luogo in un regno di leoni in Africa, e fu influenzata dall\'opera teatrale di William Shakespeare Amleto. Il film racconta la storia di Simba, un giovane leone che dovrà prendere il posto di suo padre Mufasa come re. Tuttavia, dopo che Scar, lo zio di Simba, uccide Mufasa, il principe deve impedire allo zio di conquistare le Terre del Branco e vendicare suo padre. ', 'photos/films/4.png', 'film'),
(205, 'Inception', 'Fantascienza', '2010-01-01', '14.99', 'Inception è un film del 2010 diretto da Christopher Nolan. La vicenda ha inizio quando il magnate giapponese Saito assolda Dominic ‘Dom’ Cobb (Leonardo DiCaprio) e il socio Arthur (Joseph Gordon-Levitt) per innestare nel rivale Fisher l’idea di disgregare il suo impero economico. I due soci sono esperti della tecnica dell’estrazione, che consiste nell’infiltrarsi nella mente vulnerabile di chi dorme. Questa volta, tuttavia, saranno loro a dover generare nella vittima un nuovo ricordo. In cambio della collaborazione, Saito offre a Dom la possibilità di tornare in America, da dove è fuggito poiché accusato dell’omicidio della moglie Mal (Marion Cotillard).', 'photos/films/5.png', 'film'),
(206, 'Alla ricerca di Nemo', 'Animazione', '2003-01-01', '9.99', 'Alla Ricerca di Nemo è un film di animazione del 2003 diretto da Andrew Stanton e Lee Unkrich.\r\nIn un anemone lungo la barriera corallina vivono Marlin (voce originale Albert Brooks, voce italiana Luca Zingaretti) e Coral, due pesci pagliaccio che stanno per diventare genitori. Mentre attendono la schiusa delle uova con trepidazione, la loro casa viene attaccata da uno spaventoso barracuda, che uccide Coral e gran parte delle uova deposte: l’unico uovo a sopravvivere e schiudersi verrà chiamato Nemo.\r\nIl piccolo Nemo cresce e durante una gita scolastica decide di allontanarsi dalla zona sicura per toccare il “motoschifo”: in quel momento spunta un sub che lo cattura e sparisce. Inizia così l’incredibile avventura di Marlin, che parte alla ricerca di suo figlio, in compagnia di Dory (voce originale Ellen DeGeneres, voce italiana Carla Signoris), una pesciolina blu che soffre di perdita della memoria a breve termine. Nel loro viaggio incontrano alcuni personaggi molto particolari che li aiuteranno, tra cui la tartaruga Scorza.\r\nNel frattempo Nemo, prigioniero nell’acquario di un dentista, fa la conoscenza di un gruppo di pesci e altre creature dell’oceano, fra cui il mitico Branchia (voce originale Willem Dafoe), con cui progetta un’evasione.', 'photos/films/6.png', 'film'),
(207, 'Harry Potter e la pietra filosofale', 'Fantascienza', '2001-01-01', '9.99', 'La storia narra del primo anno di Harry Potter a Hogwarts dove scopre di essere un mago famoso e inizia la sua istruzione magica. Nel film compaiono Daniel Radcliffe nel ruolo di Harry Potter assieme a Rupert Grint ed Emma Watson in quelli dei migliori amici di Harry, Ron Weasley e Hermione Granger. Il film ha avuto sette seguiti il primo dei quali è stato La camera dei segreti.', 'photos/films/7.jpg', 'film'),
(208, 'Harry Potter e la camera dei segreti', 'Fantascienza', '2002-01-01', '9.99', 'Film del 2002 diretto da Chris Columbus, adattamento cinematografico dell\'omonimo romanzo, secondo episodio della saga di Harry Potter, scritta da J. K. Rowling.', 'photos/films/8.jpg', 'film'),
(209, 'Harry Potter e il prigioniero di Azkaban', 'Fantascienza', '2004-01-01', '9.99', 'Film del 2004 diretto da Alfonso Cuarón, adattamento cinematografico dell\'omonimo romanzo, terzo episodio della saga di Harry Potter, scritta dall\'autrice britannica J. K. Rowling.', 'photos/films/9.jpg', 'film'),
(210, 'Harry Potter e il calice di fuoco', 'Fantascienza', '2005-01-01', '9.99', 'Film del 2005 diretto da Mike Newell, adattamento cinematografico dell\'omonimo romanzo, quarto episodio della serie di Harry Potter, scritta da J. K. Rowling.', 'photos/films/10.jpg', 'film');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `prodotti`
--
ALTER TABLE `prodotti`
  ADD PRIMARY KEY (`gid`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `prodotti`
--
ALTER TABLE `prodotti`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
