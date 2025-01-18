-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 01:42 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itproj`
--

-- --------------------------------------------------------

--
-- Table structure for table `atsiliepimas`
--

CREATE TABLE `atsiliepimas` (
  `id` int(11) NOT NULL,
  `komentaras` varchar(255) COLLATE utf8_lithuanian_ci NOT NULL,
  `fk_vartotojas_slapyvardis` varchar(255) COLLATE utf8_lithuanian_ci NOT NULL,
  `fk_objektas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `atsiliepimas`
--

INSERT INTO `atsiliepimas` (`id`, `komentaras`, `fk_vartotojas_slapyvardis`, `fk_objektas_id`) VALUES
(21, 'Labai gražus vaizdas', 'keliautojas', 2),
(22, 'Puiki vieta atsipalaiduoti ir pasimėgauti gamta.', '756povilas', 2),
(23, 'Labai patiko atmosfera ir ramybė, kurią suteikia šis ežeras.', 'Mokinukas', 2),
(24, 'Nepakartojama vieta pasivaikščiojimams su šeima.', 'rokaazz552', 3),
(25, 'Įspūdinga vieta su nuostabiu gamtos grožiu.', 'asd123', 3),
(26, 'Istorija čia jaučiama kiekviename kampe.', 'keliautojas', 4),
(27, 'labai patiko', 'Mokinukas', 5),
(28, 'Skulptūra su didele reikšme ir istorija, verta aplankyti.', '756povilas', 5),
(29, 'Labai informatyvus ir įdomus muziejus.', 'rokaazz552', 6),
(30, 'Gausybė eksponatų ir puiki ekskursija.', 'asd123', 7),
(31, 'Labai smagus nuotykis vaikams ir suaugusiems.', 'Mokinukas', 9),
(32, 'Labai patiko ir norime grįžti dar kartą!', 'keliautojas', 9),
(33, 'Puiki vieta atsipalaiduoti ir pasimėgauti SPA procedūromis.', 'asd123', 10),
(34, 'Rami vieta, kurioje galima pasisemti vidinės ramybės.', '756povilas', 11),
(35, 'Atmosfera nepakartojama – verta aplankyti!', 'rokaazz552', 12),
(36, 'Tiltas su įdomia architektūra ir istorija.', 'keliautojas', 13),
(37, 'Labai įdomus pramogų parkas su adrenalino doze!', 'Mokinukas', 15),
(38, 'Super ežeras', 'keliautojas', 2),
(39, 'Gražu', 'keliautojas', 5);

-- --------------------------------------------------------

--
-- Table structure for table `nakvyne`
--

CREATE TABLE `nakvyne` (
  `id` int(11) NOT NULL,
  `pavadinimas` varchar(255) COLLATE utf8_lithuanian_ci NOT NULL,
  `koordinatex` int(5) NOT NULL,
  `koordinatey` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `nakvyne`
--

INSERT INTO `nakvyne` (`id`, `pavadinimas`, `koordinatex`, `koordinatey`) VALUES
(1, 'Kauno viešbutis', 0, 1),
(2, 'Vilniaus nakvynės namai', 32, 30),
(3, 'Nakvynės namai \"Pas Joną\"', -20, -22),
(4, 'Viešbutis \"Stars\"', -15, 40),
(5, 'Šiaulių viešbutis \"Saulė\"', 45, 60),
(6, 'Klaipėdos poilsio namai \"Jūra\"', -55, 25),
(7, 'Druskininkų svečių namai \"Ramybė\"', 10, -45),
(8, 'Panevėžio nakvynės namai \"Centro\"', -30, 15),
(9, 'Alytaus viešbutis \"Dzūkija\"', 75, -10),
(10, 'Trakų kaimo turizmo sodyba \"Ežero krantas\"', -100, 50),
(11, 'Marijampolės svečių namai \"Sūduva\"', -65, -40),
(12, 'Birštono viešbutis \"Mineralas\"', 85, 70),
(13, 'Utenos kaimo turizmo sodyba \"Ežerų šalis\"', -120, 55),
(14, 'Plungės nakvynės namai \"Rietavo dvaras\"', 20, -80),
(15, 'Nidos poilsio kompleksas \"Smėlio oazė\"', 110, -30);

-- --------------------------------------------------------

--
-- Table structure for table `objektas`
--

CREATE TABLE `objektas` (
  `id` int(11) NOT NULL,
  `pavadinimas` varchar(255) COLLATE utf8_lithuanian_ci NOT NULL,
  `koordinatex` int(5) NOT NULL,
  `koordinatey` int(5) NOT NULL,
  `tipas` enum('gamtinis','istorinis','kultūrinis','pramoginis','religinis','architektūrinis') COLLATE utf8_lithuanian_ci NOT NULL,
  `trukme` int(5) NOT NULL,
  `aprasymas` varchar(255) COLLATE utf8_lithuanian_ci NOT NULL,
  `paveikslelis` varchar(255) COLLATE utf8_lithuanian_ci DEFAULT 'paveiksleliai/empty.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `objektas`
--

INSERT INTO `objektas` (`id`, `pavadinimas`, `koordinatex`, `koordinatey`, `tipas`, `trukme`, `aprasymas`, `paveikslelis`) VALUES
(2, 'Juodasis ežeras', -3, -10, 'gamtinis', 15, 'Paslaptingas ežeras, apsuptas tankių miškų, puikiai tinkantis ramiems pasivaikščiojimams ir gamtos mėgėjams.', 'paveiksleliai/juodasis.jpg'),
(3, 'Didysis panevėžio akmuo', 0, -16, 'gamtinis', 10, 'Įspūdingas gamtos paminklas, traukiantis turistus dėl savo dydžio ir istorinių legendų.', 'paveiksleliai/did_akmuo.jpg'),
(4, 'Kauno pilis', -19, 0, 'istorinis', 30, 'Senovinė gynybinė pilis, sauganti Kauno miesto istoriją ir viduramžių atmosferą.', 'paveiksleliai/kauno_pilis.jpg'),
(5, 'Tomo Tomausko paminklas', -18, 2, 'istorinis', 5, 'Skulptūra, pagerbianti žymųjį veikėją, palikusį ryškų pėdsaką Lietuvos istorijoje.', 'paveiksleliai/tomo_paminklas.jpg'),
(6, 'Palangos karo muziejus', -48, 15, 'istorinis', 45, 'Muziejus, pristatantis Lietuvos karinės istorijos raidą ir svarbiausius mūšius.', 'paveiksleliai/empty.jpg'),
(7, 'Velnių muziejus', -18, -1, 'kultūrinis', 30, 'Unikali kultūros įstaiga, kurioje saugoma didžiausia velnių skulptūrų kolekcija pasaulyje.', 'paveiksleliai/velniu_muziejus.jpg'),
(8, 'Žalgirio baseinas', -18, -1, 'pramoginis', 60, 'Modernus pramoginis centras, siūlantis baseinus, SPA ir aktyvaus poilsio pramogas visai šeimai.', 'paveiksleliai/zalgirio_baseinas.jpg'),
(9, 'Kukurūzų labirintas', -27, -10, 'pramoginis', 40, 'Pramoginis objektas, suteikiantis įdomų iššūkį klaidžiojant kukurūzų laukuose.', 'paveiksleliai/kukuruzu_labirintas.jpg'),
(10, 'Druskininkų spa centras', -20, -32, 'pramoginis', 60, 'Prabangus poilsio ir sveikatinimo centras, garsėjantis mineralinio vandens procedūromis.', 'paveiksleliai/druskininku_spa.jpg'),
(11, 'Vilniaus šventykla \"Malda\"', -4, 4, 'religinis', 20, 'Rami ir šventa vieta, skirta dvasinei ramybei ir vidinei harmonijai pasiekti.', 'paveiksleliai/empty.jpg'),
(12, 'Vilniaus kapinės', -3, 0, 'religinis', 30, 'Istorinės kapinės, kuriose ilsisi žymūs Lietuvos veikėjai.', 'paveiksleliai/vilniaus_kapines.jpg'),
(13, 'Kauno senasis tiltas', -20, -2, 'architektūrinis', 20, 'Vienas seniausių tiltų Kaune, sujungiantis miesto istoriją su šiuolaikine architektūra.', 'paveiksleliai/kauno_tiltas.jpg'),
(14, 'Kauno prašmatnieji rūmai', -18, 0, 'architektūrinis', 35, 'Prabangūs rūmai, išsiskiriantys savo puošnumu ir įdomia architektūrine istorija.', 'paveiksleliai/empty.jpg'),
(15, 'Marijampolės siaubo parkas', -33, -13, 'pramoginis', 55, 'Adrenalino mėgėjams skirtas pramogų parkas, garsėjantis savo šiurpiomis atrakcijomis.', 'paveiksleliai/siaubo_parkas_marijampole.jpg'),
(39, 'Trakų pilis', 2, 10, 'istorinis', 90, 'Viduramžių pilis, apsupta Galvės ežero, garsėjanti savo istorija ir vaizdingais peizažais.', 'paveiksleliai/traku_pilis.jpg'),
(40, 'Vilniaus katedra', 9, 4, 'religinis', 50, 'Pagrindinė Vilniaus miesto bažnyčia, garsėjanti savo architektūra ir istorija.', 'paveiksleliai/vilniaus_katedra.jpg'),
(41, 'Kryžių kalnas', -100, 26, 'kultūrinis', 90, 'Unikali kultūrinė vieta su tūkstančiais kryžių, simbolizuojančių lietuvių tikėjimą ir istoriją.', 'paveiksleliai/kryziu_kalnas.jpg'),
(42, 'Palangos gintaro muziejus', 100, 13, 'kultūrinis', 90, 'Muziejus, įsikūręs Tiškevičių rūmuose, kuriame eksponuojami gintaro dirbiniai.', 'paveiksleliai/gintaro_muziejus.jpg'),
(44, 'Didysis Ąžuolas', -40, 23, 'gamtinis', 15, 'Pats didžiausias ir seniausias Ąžuolas esantis Lietuvoje.', 'paveiksleliai/didysis_azuolas.jpg'),
(45, 'Saulės laikrodis', -68, 38, 'kultūrinis', 25, 'Istorinis Saulės laikrodis, kuris simbolizuoja laiką ir tradicijas.', 'paveiksleliai/saules_laikrodis.jpg'),
(46, 'Gedimino kalnas', 20, -21, 'istorinis', 60, 'Istorinė vietovė su gražia panorama ir pilies griuvėsiais.', 'paveiksleliai/gedimino_kalnas.jpg'),
(47, 'Smėlio kopos', 16, -79, 'gamtinis', 70, 'Unikalus gamtos objektas, garsėjantis smėlio kopomis ir pajūrio kraštovaizdžiu.', 'paveiksleliai/smelio_kopos.jpg'),
(48, 'Vilniaus teatro aikštė', 31, 28, 'kultūrinis', 45, 'Aikštė, kurioje vyksta įvairūs kultūriniai renginiai ir festivaliai.', 'paveiksleliai/teatro_aikste.jpg'),
(49, 'Molėtų observatorija', 12, -64, 'pramoginis', 40, 'Astronomijos mėgėjams skirta vieta su didžiausiais teleskopais Lietuvoje.', 'paveiksleliai/moletu_observatorija.jpg'),
(50, 'Juodkrantės švyturys', -44, 49, 'architektūrinis', 30, 'Aukštas švyturys, kuris saugojo laivus nuo nelaimių.', 'paveiksleliai/juodkrantes_svyturys.jpg'),
(51, 'Tauragės krašto muziejus', -54, 21, 'istorinis', 50, 'Muziejus, kuriame eksponuojami Tauragės krašto istoriniai artefaktai.', 'paveiksleliai/taurages_muziejus.jpg'),
(52, 'Anykščių medžių lajų takas', 18, 64, 'gamtinis', 60, 'Populiarus turistinis takas virš medžių lajų su puikiais gamtos vaizdais.', 'paveiksleliai/laju_takas.jpg'),
(53, 'Klaipėdos senamiestis', -14, 41, 'kultūrinis', 35, 'Senovinis miesto rajonas su autentiška architektūra ir siauromis gatvelėmis.', 'paveiksleliai/klaipedos_senamiestis.jpg'),
(54, 'Šilutės žvejų kaimelis', -38, -49, 'kultūrinis', 25, 'Mažas žvejų kaimelis su senoviškais nameliais ir žuvies patiekalais.', 'paveiksleliai/zveju_kaimelis.jpg'),
(55, 'Aukštaitijos nacionalinis parkas', 0, 85, 'gamtinis', 120, 'Saugomas parkas, garsėjantis ežerais ir miškais.', 'paveiksleliai/aukstaitijos_parkas.jpg'),
(56, 'Biržų pilis', -64, -69, 'istorinis', 90, 'Renesanso laikų pilis su muziejumi ir požemiais.', 'paveiksleliai/birzu_pilis.jpg'),
(57, 'Perkūno namas', -15, -15, 'architektūrinis', 20, 'Gotikinis pastatas, išsiskiriantis unikaliu fasadu.', 'paveiksleliai/perkuno_namas.jpg'),
(58, 'Raudonės pilis', -80, -33, 'istorinis', 70, 'Istorinė pilis su parku, garsėjanti savo legendomis ir istorija.', 'paveiksleliai/raudones_pilis.jpg'),
(59, 'Panemunės regioninis parkas', 33, -51, 'gamtinis', 80, 'Gamtos parkas su upių slėniais, miškais ir kalvomis.', 'paveiksleliai/panemunes_parkas.jpg'),
(60, 'Nidos kopų muziejus', 51, 10, 'kultūrinis', 30, 'Muziejus, pasakojantis apie smėlio kopų istoriją ir gyvenimą šioje unikalioje vietoje.', 'paveiksleliai/nidos_kopos.jpg'),
(61, 'Parnidžio kopa su Saulės laikrodžiu', -76, 59, 'gamtinis', 45, 'Gamtos objektas su įspūdinga panorama ir Saulės laikrodžiu.', 'paveiksleliai/parnidzio_kopa.jpg'),
(62, 'Plokščių bažnyčia', -30, 79, 'religinis', 30, 'Istorinė bažnyčia, pastatyta iš akmens, su įdomia architektūra.', 'paveiksleliai/ploksciu_baznycia.jpg'),
(63, 'Kretingos dvaro parkas', 27, 44, 'kultūrinis', 50, 'Parkas su botanikos sodu ir senoviniais dvaro pastatais.', 'paveiksleliai/kretingos_parkas.jpg'),
(64, 'Šventosios švyturys', -92, -18, 'architektūrinis', 35, 'Senoji Šventosios švyturio konstrukcija, sauganti žvejus ir jūreivius.', 'paveiksleliai/sventosios_svyturys.jpg'),
(65, 'Raseinių istorijos muziejus', 53, -100, 'istorinis', 50, 'Muziejus, kuriame pristatoma Raseinių miesto istorija ir kultūra.', 'paveiksleliai/raseiniu_muziejus.jpg'),
(66, 'Dainavos kalnas', -92, 85, 'gamtinis', 60, 'Įspūdingas kalnas su vaizdinga panorama ir žygeivių takais.', 'paveiksleliai/dainavos_kalnas.jpg'),
(67, 'Kupiškio kultūros centras', 22, -67, 'kultūrinis', 40, 'Kultūros centras, kuriame vyksta įvairūs renginiai ir parodos.', 'paveiksleliai/kupiskio_centras.jpg'),
(68, 'Šalčininkų bažnyčia', -66, 54, 'religinis', 35, 'Istorinė bažnyčia, garsėjanti savo architektūra ir išskirtiniais vitražais.', 'paveiksleliai/salcininku_baznycia.jpg'),
(69, 'Joniškio miesto parkas', 4, -85, 'gamtinis', 30, 'Ramus parkas su pasivaikščiojimo takais ir poilsio zonomis.', 'paveiksleliai/joniskio_parkas.jpg'),
(70, 'Zarasų ežeras', -38, 95, 'gamtinis', 20, 'Vienas iš gražiausių ežerų Zarasų regione, mėgstamas poilsiautojų.', 'paveiksleliai/zarasu_ezeras.jpg'),
(71, 'Pabradės žvejų kaimelis', 51, -18, 'kultūrinis', 25, 'Autentiškas žvejų kaimelis su tradiciniais namais ir žvejybos muziejumi.', 'paveiksleliai/pabrades_kaimelis.jpg'),
(72, 'Pakruojo dvaro rūmai', -60, 62, 'istorinis', 55, 'Didžiausias dvaras Lietuvoje, garsėjantis savo prabangiais rūmais ir parku.', 'paveiksleliai/pakruojo_dvaras.jpg'),
(73, 'Ignalinos slidinėjimo centras', 14, -46, 'pramoginis', 70, 'Žiemos pramogų centras, siūlantis slidinėjimą ir snieglenčių trasas.', 'paveiksleliai/ignalinos_silidinimas.jpg'),
(74, 'Širvintų miesto rotušė', -14, 95, 'architektūrinis', 45, 'Istorinis pastatas, kuriame įsikūrusi Širvintų miesto rotušė.', 'paveiksleliai/sirvintu_rotuse.jpg'),
(75, 'Šiaulių televizijos bokštas', -68, 49, 'architektūrinis', 30, 'Vienas aukščiausių televizijos bokštų Lietuvoje, siūlantis panoraminius vaizdus.', 'paveiksleliai/siauliu_bokstas.jpg'),
(76, 'Elektrėnų pramogų parkas', -20, 74, 'pramoginis', 60, 'Modernus parkas su pramogų atrakcionais ir poilsio zonomis.', 'paveiksleliai/elektrenu_parkas.jpg'),
(77, 'Jonavos miesto teatras', -40, -79, 'kultūrinis', 35, 'Modernus teatras, kuriame rodomos įvairios teatro trupės.', 'paveiksleliai/jonavos_teatras.jpg'),
(78, 'Plungės pilis', 12, 69, 'istorinis', 70, 'XIX a. pilis su parku ir muziejumi, pasakojanti Plungės miesto istoriją.', 'paveiksleliai/plunges_pilis.jpg'),
(79, 'Birštono vandens bokštas', 61, -28, 'architektūrinis', 15, 'Aukštas vandens bokštas, išsiskiriantis unikalia architektūra.', 'paveiksleliai/birstono_bokstas.jpg'),
(80, 'Jurbarko pėsčiųjų takas', -52, -95, 'gamtinis', 25, 'Gražus pasivaikščiojimo takas palei upę su nuostabiais gamtos vaizdais.', 'paveiksleliai/jurbarko_takas.jpg'),
(81, 'Telšių katedra', 2, -54, 'religinis', 45, 'Žymus sakralinis pastatas, garsėjantis savo barokiniu stiliumi.', 'paveiksleliai/telsiu_katedra.jpg'),
(82, 'Rokiškio dvaro parkas', 35, 46, 'kultūrinis', 40, 'Dvaro parkas su išpuoselėtais sodais ir autentiškais pastatais.', 'paveiksleliai/rokiskio_parkas.jpg'),
(83, 'Mažeikių istorinis muziejus', -48, 41, 'istorinis', 50, 'Muziejus, pasakojantis Mažeikių krašto istoriją ir kultūrą.', 'paveiksleliai/mazeikiu_muziejus.jpg'),
(84, 'Pasvalio šaltiniai', 45, -51, 'gamtinis', 20, 'Unikalūs šaltiniai, garsėjantys savo gydomosiomis savybėmis.', 'paveiksleliai/pasvalio_saltiniai.jpg'),
(85, 'Ukmergės senamiestis', 57, 26, 'kultūrinis', 55, 'Autentiškas senamiestis su siaurų gatvelių labirintais ir istoriniu žavesiu.', 'paveiksleliai/ukmerges_senamiestis.jpg'),
(86, 'Vilkaviškio meno galerija', 33, -44, 'kultūrinis', 30, 'Meno galerija, pristatanti vietinius ir tarptautinius meno kūrinius.', 'paveiksleliai/vilkaviskio_galerija.jpg'),
(87, 'Švenčionių krašto muziejus', -76, -90, 'istorinis', 35, 'Muziejus, pristatantis Švenčionių krašto istoriją nuo seniausių laikų.', 'paveiksleliai/svencioniu_muziejus.jpg'),
(88, 'Raseinių pėsčiųjų trasa', 16, 13, 'gamtinis', 40, 'Ilga pasivaikščiojimo trasa, vedanti per gražiausias Raseinių apylinkes.', 'paveiksleliai/raseiniu_trasa.jpg'),
(89, 'Biržų ežero pakrantė', -34, 100, 'gamtinis', 20, 'Ramios pakrantės su vaizdingomis vietovėmis ir poilsio zonomis.', 'paveiksleliai/birzu_pakrante.jpg'),
(90, 'Visagino kultūros rūmai', 53, -41, 'kultūrinis', 45, 'Modernūs rūmai, kuriuose vyksta koncertai, spektakliai ir parodos.', 'paveiksleliai/visagino_rumai.jpg'),
(91, 'Anykščių piliakalnis', 37, 59, 'istorinis', 25, 'Istorinė vieta su nuostabia panorama ir senovės gyvenvietės liekanomis.', 'paveiksleliai/anyksciu_piliakalnis.jpg'),
(92, 'Šakių miesto aikštė', 51, 38, 'architektūrinis', 30, 'Didelė miesto aikštė, kurioje vyksta įvairūs renginiai ir mugės.', 'paveiksleliai/sakiu_aikste.jpg'),
(93, 'Skuodo žuvininkystės muziejus', -54, -31, 'kultūrinis', 30, 'Muziejus, pasakojantis apie Skuodo žvejybos ir žuvininkystės istoriją.', 'paveiksleliai/skuodo_muziejus.jpg'),
(94, 'Kelmės miesto parkas', -28, 36, 'gamtinis', 20, 'Ramus parkas su ežerėliais, žaidimų aikštelėmis ir poilsio vietomis.', 'paveiksleliai/kelmes_parkas.jpg'),
(95, 'Vilniaus atrakcionų parkas', 24, -85, 'pramoginis', 50, 'Didžiausias atrakcionų parkas Vilniuje, siūlantis įvairias pramogas visai šeimai.', 'paveiksleliai/vilniaus_atrakcionai.jpg'),
(96, 'Alytus Nuotykių parkas', -72, 90, 'pramoginis', 40, 'Pramogų parkas su laipiojimo trasomis ir zip line pramogomis.', 'paveiksleliai/alytus_nuotykiu_parkas.jpg'),
(97, 'Prienų vandens pramogų centras', 37, -33, 'pramoginis', 70, 'Vandens pramogų centras su baseinais, čiuožyklomis ir pirčių zona.', 'paveiksleliai/prienu_vandens_centras.jpg'),
(98, 'Radviliškio kartingų trasa', -80, 46, 'pramoginis', 30, 'Moderni kartingų trasa, kurioje galima išbandyti greičio aistras.', 'paveiksleliai/radviliskio_kartingai.jpg'),
(99, 'Šilalės batutų parkas', 0, 54, 'pramoginis', 20, 'Batutų parkas, siūlantis šokinėjimo zonas tiek vaikams, tiek suaugusiems.', 'paveiksleliai/silales_batutai.jpg'),
(100, 'Raseinių siaubo kambarys', -92, -38, 'pramoginis', 35, 'Adrenalino mėgėjams skirtas siaubo kambarys su įtempta atmosfera.', 'paveiksleliai/raseiniu_siaubo_kambarys.jpg'),
(101, 'Tauragės lazerių žaidimų arena', 20, 69, 'pramoginis', 45, 'Moderni lazerių žaidimų arena, puikiai tinkanti komandinėms pramogoms.', 'paveiksleliai/taurages_lazeriai.jpg'),
(102, 'Utenos mini golfas', -44, 64, 'pramoginis', 25, 'Mini golfo aikštynas su 18 įdomių takelių įvairaus sudėtingumo.', 'paveiksleliai/utenos_mini_golfas.jpg'),
(103, 'Kėdainių ledo arena', 16, -23, 'pramoginis', 60, 'Ledo arena, kurioje galima čiuožti, žaisti ledo ritulį ar stebėti renginius.', 'paveiksleliai/kedainiu_ledo_arena.jpg'),
(104, 'Kazlų Rūdos nuotykių miškas', -62, -72, 'pramoginis', 50, 'Nuotykių parkas miške su kliūčių trasomis ir laipiojimo siena.', 'paveiksleliai/kazlu_nuotykiu_miskas.jpg'),
(105, 'Vilniaus Kalėdinis miestelis', 92, -30, 'kultūrinis', 30, 'Šventinė vieta su Kalėdine eglute, mugėmis ir renginiais.', 'paveiksleliai/kaledinis_miestelis.jpg'),
(106, 'Druskininkų skulptūrų parkas', -88, 24, 'kultūrinis', 40, 'Unikalus skulptūrų parkas su kūriniais iš vietinių menininkų.', 'paveiksleliai/skulpturu_parkas.jpg'),
(107, 'Jonavos vandens bokštas', -77, 53, 'architektūrinis', 15, 'Modernus vandens bokštas, išsiskiriantis unikaliu dizainu.', 'paveiksleliai/jonavos_bokstas.jpg'),
(108, 'Panevėžio paupio takas', 58, 72, 'gamtinis', 25, 'Pasivaikščiojimo takas palei upę su vaizdinga gamta.', 'paveiksleliai/panevezio_takas.jpg'),
(109, 'Alytaus dainų parkas', -35, -92, 'pramoginis', 30, 'Parkas, kuriame vyksta gyvi koncertai ir įvairūs renginiai.', 'paveiksleliai/dainu_parkas.jpg'),
(110, 'Kėdainių senasis malūnas', 74, -58, 'istorinis', 50, 'Senasis malūnas, tapęs Kėdainių miesto simboliu.', 'paveiksleliai/kedainiu_malunas.jpg'),
(111, 'Šalčininkų kultūros namai', -91, 18, 'kultūrinis', 45, 'Kultūros centras su įvairiais teatro ir muzikos renginiais.', 'paveiksleliai/salcininku_namai.jpg'),
(112, 'Pakruojo senasis šulinys', -49, 88, 'istorinis', 15, 'Legendinis šulinys, žinomas dėl savo paslaptingos istorijos.', 'paveiksleliai/pakruojo_sulinys.jpg'),
(113, 'Vilniaus požemių labirintas', 23, -99, 'istorinis', 60, 'Požeminis labirintas, pasakojantis miesto istoriją per ekskursijas.', 'paveiksleliai/pozemiu_labirintas.jpg'),
(114, 'Širvintų senoji rotušė', 64, -40, 'architektūrinis', 30, 'Senoji miesto rotušė su istoriniu fasadu.', 'paveiksleliai/senaji_rotuse.jpg'),
(115, 'Mažeikių žaliųjų kalvų parkas', -60, -100, 'gamtinis', 20, 'Vaizdingas parkas su kalvomis ir takais poilsiui.', 'paveiksleliai/zaliosios_kalvos.jpg'),
(116, 'Rokiškio ežero takas', 83, 41, 'pramoginis', 45, 'Pėsčiųjų takas su vaizdais į Rokiškio ežerą.', 'paveiksleliai/rokiskio_takas.jpg'),
(117, 'Skuodo senoji mokykla', 31, -88, 'kultūrinis', 30, 'Istorinis pastatas, kuriame veikia muziejus.', 'paveiksleliai/senoji_mokykla.jpg'),
(118, 'Plungės gamtos muziejus', -95, 67, 'gamtinis', 40, 'Muziejus, skirtas gamtos paveldo išsaugojimui.', 'paveiksleliai/gamtos_muziejus.jpg'),
(119, 'Tauragės kultūros paviljonas', 56, -65, 'kultūrinis', 50, 'Paviljonas, kuriame vyksta kultūros renginiai ir parodos.', 'paveiksleliai/kulturos_paviljonas.jpg'),
(120, 'Birštono miesto fontanai', 99, -14, 'pramoginis', 25, 'Fontanų kompleksas su įspūdingais šviesų ir muzikos šou.', 'paveiksleliai/fontanai.jpg'),
(121, 'Anykščių istorinės sienos', -68, 73, 'istorinis', 55, 'Istorinės miesto sienos su gynybiniais bokštais.', 'paveiksleliai/istorines_sienos.jpg'),
(122, 'Marijampolės alėja', -100, 35, 'gamtinis', 30, 'Žalia alėja, tinkanti poilsiui ir pasivaikščiojimams.', 'paveiksleliai/marijampoles_aleja.jpg'),
(123, 'Kazlų Rūdos švyturys', 40, 92, 'architektūrinis', 35, 'Senovinis švyturys su panoraminiu vaizdu.', 'paveiksleliai/svyturys.jpg'),
(124, 'Vilkaviškio amatų centras', -75, -22, 'kultūrinis', 40, 'Centras, kuriame galima susipažinti su tradiciniais amatais.', 'paveiksleliai/amatų_centras.jpg'),
(125, 'Visagino ežero sala', 88, 53, 'pramoginis', 35, 'Populiari vieta poilsiui ir piknikams Visagino ežero saloje.', 'paveiksleliai/ežero_sala.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `vartotojas`
--

CREATE TABLE `vartotojas` (
  `slapyvardis` varchar(255) COLLATE utf8_lithuanian_ci NOT NULL,
  `slaptazodis` varchar(255) COLLATE utf8_lithuanian_ci NOT NULL,
  `tipas` enum('keliautojas','administratorius','kūrėjas') COLLATE utf8_lithuanian_ci NOT NULL,
  `būsena` enum('užblokuotas','neužblokuotas') COLLATE utf8_lithuanian_ci NOT NULL DEFAULT 'neužblokuotas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `vartotojas`
--

INSERT INTO `vartotojas` (`slapyvardis`, `slaptazodis`, `tipas`, `būsena`) VALUES
('756povilas', '94a547511ec01a9296751284c46f74bf', 'keliautojas', 'neužblokuotas'),
('admin', 'f22c4c03d459f07baf28134903277e41', 'administratorius', 'neužblokuotas'),
('asd123', '189704a4360e307ccecb255f4448e8f3', 'keliautojas', 'užblokuotas'),
('Aurimas75', '9ee8c9e1bda6fe2132b48b34b0125a02', 'administratorius', 'neužblokuotas'),
('keliautojas', 'f9896c6c1a132e866133567987ef7e2e', 'keliautojas', 'neužblokuotas'),
('kurejas', '3c9c69c3e6a45d1069eaa52868406b1a', 'kūrėjas', 'neužblokuotas'),
('mantelis8', 'cda75f4324a1669890488e283b014f77', 'kūrėjas', 'neužblokuotas'),
('Mokinukas', 'ef773d7d56a1d2069c8a9a9af66f8e88', 'keliautojas', 'neužblokuotas'),
('rokaazz552', '21fa369b84381876bff767d12d2a763e', 'keliautojas', 'neužblokuotas'),
('Tomasz', '7bf507840f3e25ba219c7900c1789ec7', 'kūrėjas', 'neužblokuotas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atsiliepimas`
--
ALTER TABLE `atsiliepimas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_vartotojo_atsiliepimas` (`fk_vartotojas_slapyvardis`),
  ADD KEY `fk_objekto_atsiliepimas` (`fk_objektas_id`);

--
-- Indexes for table `nakvyne`
--
ALTER TABLE `nakvyne`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `objektas`
--
ALTER TABLE `objektas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vartotojas`
--
ALTER TABLE `vartotojas`
  ADD PRIMARY KEY (`slapyvardis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atsiliepimas`
--
ALTER TABLE `atsiliepimas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `nakvyne`
--
ALTER TABLE `nakvyne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `objektas`
--
ALTER TABLE `objektas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `atsiliepimas`
--
ALTER TABLE `atsiliepimas`
  ADD CONSTRAINT `fk_objekto_atsiliepimas` FOREIGN KEY (`fk_objektas_id`) REFERENCES `objektas` (`id`),
  ADD CONSTRAINT `fk_vartotojo_atsiliepimas` FOREIGN KEY (`fk_vartotojas_slapyvardis`) REFERENCES `vartotojas` (`slapyvardis`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
