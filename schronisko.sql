-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 06 Gru 2019, 02:04
-- Wersja serwera: 10.4.8-MariaDB
-- Wersja PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `schronisko`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `adopcje`
--

CREATE TABLE `adopcje` (
  `id` int(11) NOT NULL,
  `id_zwierze` int(11) DEFAULT NULL,
  `id_uzytkownik` int(11) DEFAULT NULL,
  `oplacone_do` date DEFAULT NULL,
  `id_ost_platnosci` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `zdjecie` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `adopcje`
--

INSERT INTO `adopcje` (`id`, `id_zwierze`, `id_uzytkownik`, `oplacone_do`, `id_ost_platnosci`, `status`, `zdjecie`) VALUES
(8, 4, 2, '2020-03-05', 7, 'oplacone', '/img/animals_photo/dog4.jpg'),
(9, 12, 2, '2019-12-05', NULL, 'nieoplacone', '/img/animals_photo/cat3.jpeg'),
(10, 10, 2, '2020-03-06', 8, 'oplacone', '/img/animals_photo/cat1.jpeg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `historia_platnosci`
--

CREATE TABLE `historia_platnosci` (
  `id` int(11) NOT NULL,
  `id_klienta` int(11) DEFAULT NULL,
  `id_adopcji` int(11) DEFAULT NULL,
  `data_platnosci` date DEFAULT NULL,
  `kwota` int(11) DEFAULT NULL,
  `ile_miesiecy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `historia_platnosci`
--

INSERT INTO `historia_platnosci` (`id`, `id_klienta`, `id_adopcji`, `data_platnosci`, `kwota`, `ile_miesiecy`) VALUES
(7, 2, 8, '2019-12-05', 450, 3),
(8, 2, 10, '2019-12-06', 240, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownik`
--

CREATE TABLE `uzytkownik` (
  `id` int(255) NOT NULL,
  `imie` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `data_urodzenia` date NOT NULL,
  `email` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `login` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `haslo` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `zdjecie` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `rola` varchar(255) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownik`
--

INSERT INTO `uzytkownik` (`id`, `imie`, `nazwisko`, `data_urodzenia`, `email`, `login`, `haslo`, `zdjecie`, `rola`) VALUES
(1, 'admin', 'adminowy', '0000-00-00', 'kontakt@schronisko.pl', 'admin', '21232f297a57a5a743894a0e4a801fc3', '/img/site.png', 'admin'),
(2, 'sad', 'sad222', '2222-02-22', 'aemafqweqweqweqewul@gmail.com', 'asd11', '$2y$10$OvXvbUsKJD2OJwf2S0t0ZOxCzB/S.0GJUfyrVy/jK5xKWsVKYGgQu', '/C:xampphtdocsasd11.jpeg', 'user'),
(3, 'asdasd', 'asdasd', '2222-02-22', 'aemsadfasfdaful@gmail.com', 'asd22', '$2y$10$IesWr/JZaJoTUk0Bhs00peGSMyYxtvXuB6th645b8ylfCh9DD9etS', '/C:xampphtdocsasd22.jpeg', 'user'),
(4, 'Krzysztof', 'Kania', '0022-02-22', 'aeaaaaaaaamaful@gmail.com', 'asd333', '$2y$10$wepkCAbiO1ObJBLBs5M15.xG1iXg50Pk4BhIRZsihQhrER8DnXWcq', '/img/users/asd333.jpeg', 'user');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zwierzeta`
--

CREATE TABLE `zwierzeta` (
  `id` int(11) NOT NULL,
  `imie` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `gatunek` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `rasa` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `plec` enum('pies','suka','kot','kotka') COLLATE utf8_polish_ci DEFAULT NULL,
  `wiek` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `status` enum('do adopcji','w domu','died','zaadoptowany wirtualnie') COLLATE utf8_polish_ci DEFAULT NULL,
  `opis` text COLLATE utf8_polish_ci DEFAULT NULL,
  `zdjecie` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `kastracja` enum('tak','nie') COLLATE utf8_polish_ci DEFAULT NULL,
  `szczepienia` enum('tak','nie') COLLATE utf8_polish_ci DEFAULT NULL,
  `koszta_miesiac` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `zwierzeta`
--

INSERT INTO `zwierzeta` (`id`, `imie`, `gatunek`, `rasa`, `plec`, `wiek`, `status`, `opis`, `zdjecie`, `kastracja`, `szczepienia`, `koszta_miesiac`) VALUES
(1, 'Zgredek', 'Pies', 'Kundel', 'pies', '11 lat', 'do adopcji', 'Zgredek… Czy jest stary? Tak. Czy nie potrafi już zachować czystości? Tak. Czy jest głuchy i niedowidzący? Tak. CZY POTRZEBUJE BYĆ KOCHANY? TAK!!!\r\n\r\nZgredzio to już starszy pies, który ma problem z wzrokiem i słuchem. Zachowanie czystości tez zostawia wiele do życzenia, jednak chce być tak samo kochany jak inne psy! Śmierć w schronisku to najgorsze co może spotkać zwierzęta… Zima nadchodzi wielkimi krokami, dla młodych zwierząt nie ma to większego znaczenia ale dla starszych MA OGROMNE! Czy przeżyje zimę w schronisku? Nikt nie może być tego pewien.\r\n\r\nAdoptuj starszego psa! One kochają tak samo mocno i będą wam za to wdzięczne nawet jeśli nie będą w stanie wam tego pokazać.', '/img/animals_photo/dog1.jpg', 'tak', 'tak', 150),
(2, 'Gloria', 'Pies', 'Kundel', 'suka', '5 lat', 'do adopcji', 'Historia Glorii nie należy do tych niezwykłych, do zamieszczonego postu nie dodajemy zdjęć psa który swoją historią może się wybić na skale internetu… Tak naprawdę jej zdjęcia mogą nie poruszyć nikogo, bo przecież kto popatrzy zza kraty na zwykłego, przeciętnego kundelka? Nie mam jak opisać jej historii, żeby w waszych oczach pojawiły się łzy.. Bo łzy ciekły wam po policzkach, wystarczy popatrzeć temu psu głęboko w oczy, próbując przeprosić za ludzką rasę… Gloria- całe życie niepotrzebna, przeganiana, nikomu nie potrzebna… Dzisiaj czeka na iskierkę nadziei w schronisku.', '/img/animals_photo/dog2.jpg', 'tak', 'tak', 100),
(3, 'Aro', 'Pies', 'Kundel', 'pies', '7 lat', 'do adopcji', 'Aro przeżył w swoim dotychczasowym życiu bardzo dużo, spędził 8 lat u boku swojej kochającej rodziny niestety sytuacja życiowa nie pozwoliła na dalszą opiekę nad nim Aro wyruszył do nowego domu, wydawałoby się że już do końca życia, niestety został brutalnie wyrzucony i podrzucony pod schronisko… Dzisiaj czeka na nowy dom <3 Aro jest bardzo wesołym, inteligentnym psiakiem, nie ma problemu z innymi zwierzętami, psami ani dziećmi', '/img/animals_photo/dog3.jpg', 'tak', 'tak', 200),
(4, 'Gabi', 'Pies', 'Jamnik', 'suka', '6 lat', 'w domu', 'Gabi siedziała i patrzyła na swoją śmierć… Ona czekała, patrzyła i prosiła żeby ktoś po nią wrócił, siedząc na poboczu drogi zawiodła się na ludziach… Zostawili ją samą, bezsilną, skrajnie wychudzoną i przerażoną! Powiedzcie nam kim byli ci ludzie bez empati? Została po latach wierności wyrzucona jak śmieć! Czy to się nazywa ludzka godność? Patrząc w jej oczy z całego serca próbujemy ją po prostu przeprosić… Gabi jest kochaną, prawdziwą pieszczotką która zza kratami boksu po prostu płacze, prawdopodobnie była wykorzystywana w celach myśliwskich, dlatego też szuka domu bez małych zwierząt.', '/img/animals_photo/dog4.jpg', 'nie', 'tak', 150),
(5, 'Puszek', 'Pies', 'Kundel', 'pies', '10 lat', 'do adopcji', 'Puszek to już straszy psiak, który jedyne czego potrzebuje to spokój i miłość własnego człowieka. Spokojny, nienachalny, grzeczny. Na smyczy nie ciągnie, a z psami dogaduje się bez żadnych problemów. Puszek bardzo wiele przeszedł w swoim życiu i marzy nam się, aby swoje ostatnie lata spędził w kochającym domu, a nie w schronisku. Jest bardzo łagodny dla ludzi, nigdy nie zrobił nikomu krzywdy.', '/img/animals_photo/dog5.jpg', 'tak', 'tak', 100),
(6, 'Diana', 'Pies', 'Kundel', 'suka', '6 lat', 'do adopcji', 'Diana to bardzo grzeczna i ułożona sunia. Nienachalna, ale mocno kochająca człowieka. Pięknie chodzi na smyczy. Potrzebuje spokojnego opiekuna, która podaruje suni miłość i dobro, na jakie w pełni zasługuje.', '/img/animals_photo/dog6.jpg', 'nie', 'tak', 80),
(7, 'Deksiu', 'Pies', 'Kundel', 'pies', '8 lat', 'do adopcji', 'To człowiek zgotował mu taki los, zostawił bez pożegnania… bez choćby jednego słowa… Przez ludzką nieodpowiedzialność Deksiu od kilku lat siedzi wpatrzony w kraty, traci nadzieję i umiera z samotności… Całe życie pilnował firmy, dzień za dniem samotnie przesiadywał godziny w zamkniętym kojcu… Przez te wszystkie lata oddawał całe swoje serce każdemu, kto chociażby popatrzał przez płot w jego oczy. Na sam koniec oddany. Firma przestała działać, a pies był jak zbędna, niepotrzebna rzecz. To człowiek zabrał Deksiowi szczęśliwe dzieciństwo i godne życie i tylko człowiek może to wszystko naprawić , wystarczy przygarnąć go do DOMU, ciepłego domu, którego Deksiu nigdy nie miał. To tak mało, a jednak dla niego tak dużo. Deksiu szuka domu na już. Potrzebny człowiek o wielkim sercu i anielska cierpliwością do charakteru Deksia. Może to właśnie ty?', '/img/animals_photo/dog7.jpg', 'tak', 'tak', 100),
(8, 'Joga', 'Pies', 'Kundel', 'suka', '10 lat', 'do adopcji', 'Joga i Piorun czyli dwa kochające się bez granic psy, zostały w spadku, po swoim zmarłym właścicielu  niestety zbyt „przejęta,, rodzina nie wzięła ich pod uwagę, zostały więc same na posesji swojego pana. Mijały dni, tygodnie, rzeczy z domu ubywało a o psach nadal nikt nie wspomniał, kiedy te zaczęły wadzić odbył się telefon do schroniska… I właśnie takim sposobem dwójka małych, przerażonych psów trafiła do nas. Niestety szanse na znalezienie wspólnego domu są znikome, dlatego postanowiliśmy dla ich dobra o rozdzielenie w przypadku znalezienia domu.', '/img/animals_photo/dog8.jpg', 'nie', 'tak', 100),
(9, 'Kajtuś', 'Pies', 'Kundel', 'pies', '6 lat', 'do adopcji', 'Wrócił z adopcji, bo… „jest niewdzięczny”. Nieważne, że kochał całym sercem. Że był łagodny i przepełniony miłościa. Że dzielnie dotrzymywał towrzystwa i maszerował każdego dnia obok ukochanych ludzi. Według nich był niewdzięczny… Kajtuś po 3 latach wrócił do schroniska. Wszystko , co kochał nagle zmieniło się w zimny, schroniskowy boks. Jest tylko smutek i cierpienie. Kajtuś jest bardzo łagodny. Człowieka kocha ponad wszystko. Pilnie poszukujemy nowego, odopowiedzialnego domu, ponieważ Kajtuś bardzo źle znosi pobyt w schronisku ', '/img/animals_photo/dog9.jpg', 'tak', 'tak', 150),
(10, 'Ida', 'Kot', 'Mieszaniec', 'kotka', '2 lata', 'w domu', 'Ida to jedna z 7 kotów które zostały odebrane z bardzo złych warunków podczas interwencji. Nie miały one ani kuwety ani kontaktu z człowiekiem… Dlatego wszystkie koty są nieco wycofane a dotyk człowieka na początku paraliżuje je, jednak po chwili zaczynają nieco się rozluźniać. Nie przejawiają żadnej agresji. Na pewno potrzebują trochę czasu aby mogły się zaaklimatyzować w nowym miejscu. Ida jest około 3 letnią kotką i wkrótce przejdzie zabieg sterylizacji.', '/img/animals_photo/cat1.jpeg', 'nie', '', 80),
(11, 'Roger', 'Kot', 'Mieszaniec', 'kot', '3 lata', 'do adopcji', 'Roger to jeden z 7 kotów które zostały odebrane z bardzo złych warunków podczas interwencji. Nie miały one ani kuwety ani kontaktu z człowiekiem… Dlatego wszystkie koty są nieco wycofane a dotyk człowieka na początku paraliżuje je, jednak po chwili zaczynają nieco się rozluźniać. Nie przejawiają żadnej agresji. Na pewno potrzebują trochę czasu aby mogły się zaaklimatyzować w nowym miejscu. Roger jest około 3 letnim wykastrowanym kocurem o dość dużych rozmiarach. Jest zainteresowany nowym otoczeniem i nie ma problemu z głaskaniem.', '/img/animals_photo/cat2.jpeg', 'tak', 'tak', 80),
(12, 'Pola', 'Kot', 'Mieszaniec', 'kotka', '10 lat', 'w domu', 'Pola to jedna z 7 kotów które zostały odebrane z bardzo złych warunków podczas interwencji. Nie miały one ani kuwety ani kontaktu z człowiekiem… Dlatego wszystkie koty są nieco wycofane a dotyk człowieka na początku paraliżuje je, jednak po chwili zaczynają nieco się rozluźniać. Nie przejawiają żadnej agresji. Na pewno potrzebują trochę czasu aby mogły się zaaklimatyzować w nowym miejscu. Pola to ponad 10 letnia kotka której został już tylko jeden ząb, bardzo spokojna jej charakter różni się nieco od pozostałych kotów ponieważ bardzo lubi się głaskać i czasami sama podchodzi aby się pomiziać.', '/img/animals_photo/cat3.jpeg', 'tak', 'tak', 80),
(13, 'Cleo', 'Kot', 'Mieszaniec', 'kotka', '7 miesięcy', 'do adopcji', 'Cleo to kocia indywidualistka. Przychodzi się tulić wtedy, kiedy ona chce i bardzo głośno wtedy wokalizuje domagając się glaskow. W stosunku do innych kotów jest neutralna, nie zaczyna bójek. Jest zupełnie bezproblemowa.\r\nKicia przebywa w domku tymczasowym.', '/img/animals_photo/cat4.jpg', 'nie', 'tak', 80),
(14, 'Sylwester', 'Kot', 'Mieszaniec', 'kot', '8 lat', 'do adopcji', 'O nim zapomniał świat. Ile przeżyłeś pięknych chwil w ciągu 8 lat? Dostałeś nowa pracę? Byłeś na super wakacjach? Poznałeś nowych ludzi? Dostałeś super prezent, odwiedziłeś daleką rodzinę? Cokolwiek? A Sylwester? Sylwester przez 8 lat nie doznał ani jednej szczęśliwej chwili. Praktycznie od początku swojego życia mieszka w schronisku. Każdy jego dzień wygląda tak samo. Siedzi sobie cichutko w kąciku i czeka na….no własnie. Na co on może jeszcze czekać? Przez 8 lat nie znalazła się ani jedna osoba, która zechciałaby dać mu dom, odmienić jego życie. Czeka więc na poranne karmienie, kiedy dostaje miseczkę mokrej karmy. Na nic innego czekać nie może. Nic innego nie dostanie od życia. Mijają dni, miesiące, lata. Pogoda za oknem się zmienia. Zmieniają się koty w boksach obok. Reszta zostaje taka sama, cisza, smutek i samotność.\r\nSylwester jest płochliwym kotkiem, boi się człowieka, jednak nie ma w nim cienia agresji. Czasem musimy Sylwusia złapać, żeby podać mu tabletkę na odrobaczenie lub preparat na pchły. Kotek jest przestraszony, jednak nie broni się, czeka zlękniony aż zakończymy pielęgnację i ucieka skulony do swojego pudełeczka. Sylwester przez 8 lat nie oswoił się i raczej już się nie oswoi. Może jednak być szczęśliwym kotem, żyć obok człowieka. Jedyne czego mu trzeba to zapewniony ciepły kąt do spania i codziennie pełna miseczka. Szukamy dla niego domu wychodzącego z dala od ruchliwej ulicy.', '/img/animals_photo/cat5.jpg', 'tak', 'tak', 150),
(15, 'Mieszko', 'Kot', 'Mieszaniec', 'kot', '2 lata', 'do adopcji', 'Mieszko to młody, niespełna roczny kocurek, który przeszedł już w życiu wiele trudności. Mieszko jest odrobinę wycofanym kotkiem, potrzebuje czasu żeby zaufać komuś nowemu. Nie do końca wie czy wyciągana do niego ręka jest zagrożeniem czy oznaką przyjaźni. Czeka spięty, jednak gdy poczuje na swoim grzbiecie głaskanie zaczyna słodko mruczeć, „gadać” i prężyć się z zadowoleniem. Jednak gdy człowiek w tym głaskaniu przekroczy pewne granice, dostanie po łapach. Mieszko nie lubi dotykania w brzuszek czy w łapki. Na to pozwoli tylko i wyłącznie komuś, komu bezgranicznie zaufa. Szukamy dla Mieszka odpowiedzialnego, doświadczonego opiekuna. Kotek nie nadaje się do domu z małymi dziećmi.', '/img/animals_photo/cat7.jpg', 'tak', 'tak', 90),
(16, 'Ząbek', 'Kot', 'Mieszaniec', 'kot', '2 lata', 'do adopcji', 'Kocurek jest strachliwy, nie da się zabrać na ręce, ale jest ciekawy człowieka. Podchodzi, pozwala się zbliżyć ale boi się krzywdy, więc się wycofuje. Gdyby tylko ktoś dał mu bezpieczny domek, to kotek poczułby, że nikt go nie skrzywdzi i może by się przekonał do człowieka.', '/img/animals_photo/cat8.jpg', 'tak', 'tak', 80),
(17, 'Elena', 'Kot', 'Mieszaniec', 'kotka', '2 lata', 'w domu', 'Wspaniała, spokojna koteczka szuka kochającego domu. Ma kilka lat, lubi się głaskać, chociaż nigdy na siłę. Generalnie kicia jest bardzo gadatliwa, szczególnie wtedy, gdy roznosimy jedzonko. Jest już po zabiegu sterylizacji.', '/img/animals_photo/cat9.jpg', 'tak', 'tak', 80),
(18, 'Helenka', 'Kot', 'Mieszaniec', 'kotka', '6 lat', 'w domu', 'Bardzo mocno doświadczona przez życie koteczka szuka swojego człowieka. Helenka to ok. 6-letnia kicia. Bardzo spokojna i wdzięczna. Większość dnia przesypia na kołderce. Jest niesamowicie delikatna i wrażliwa. Uwielbia, jak człowiek siada obok niej i głaska, jest wtedy najszczęśliwszym kotem na świecie. Czułaby się idealnie obok osoby starszej lub samotnej. Kicia miałaby problem odnaleźć się w domu z dziećmi,', '/img/animals_photo/cat10.jpg', 'tak', 'tak', 80),
(19, 'Iga', 'Kot', 'Mieszaniec', 'kotka', '2 miesiące', 'w domu', 'Iga to około 2mc kotka które została znaleziona kiedy sama i głodna błąkała się po ulicy. Całkowicie oswojona, pierwsza podchodzi do człowieka po odrobinę czułości.\r\n\r\nWarunkiem adopcji jest sterylizacja.', '/img/animals_photo/cat11.jpg', 'nie', 'tak', 80),
(20, 'Tola', 'Kot', 'Mieszaniec', 'kotka', '5 miesięcy', 'w domu', 'Tola to 5-miesięczna koteczka, która trafił do nas wraz ze swoim braciszkiem – Tolkiem. Kicia niestety boi się człowieka, ale po dłużej chwili spędzonej w boksie otwiera swoje serduszko i pokazuje, jaki ma wspaniały charakter. Na pewno w swoim domu będzie potrzebowała troszkę czasu, by przyzwyczaić się do nowych warunków.\r\n\r\nKotka jest wysterylizowana.', '/img/animals_photo/cat12.jpg', 'tak', 'tak', 0),
(21, 'Snupi', 'Pies', 'Kundel', 'pies', '9 lat', 'w domu', 'Snupi przypuszczalnie został porzucony. Samotnie stał pod bramą jednego z domów, jego łapki trzęsły się z zimna a on sam był w wielkim szoku… Zaniedbany, brudny i wychudzony czekał na pomoc z strony człowieka, nie wiemy czy mieszkał kiedyś w domu, czy może od zawsze mieszkał sam na podwórku? Wiemy jednak że został potraktowany jak pewien problem… Zamknięty w kojcu płaczę i próbuje się wydostać. Schronisko to na pewno nie jest odpowiednie miejsce dla niego, Snupi toleruję inne psy i dzieci reakcja do kotów i małych zwierząt nie była sprawdzana.', '/img/animals_photo/dog10.jpg', 'tak', 'tak', 150),
(22, 'Simba', 'Pies', 'Kundel', 'suka', '4 lata', 'w domu', 'Po co ratować psa z łańcucha, skoro potem kilka lat siedzi w boksie w oczekiwaniu na dom? Zawsze mamy nadzieję, że ciężka przeszłość wzruszy jakąś dobrą duszyczkę, która postanowi przygarnąć psiaka pod swój dach i odmienić życie. Tak jednak się nie dzieje… Simba od roku poszukuje swojego człowieka. Dla takiego wesołego i energicznego psiaka, zamknięcie w boksie jest prawdziwym koszmarem. Simba ma 4 latka. Jest łagodny do innych psiaków i ludzi. Kocha dłuugie spacery. Byłby bardzo szczęśliwy u boku ludzi lubiących aktywny tryb życia. Waży ok. 12 kg.\r\nCzy los się do niego uśmiechnie i zdąży do domu przed zimą ?', '/img/animals_photo/dog11.jpg', 'tak', 'tak', 150),
(23, 'Polo', 'Kot', 'Mieszaniec', 'kot', '4 miesiące', 'w domu', 'Polo – ostatni z trójki rodzeństwa, których życie uratowała nasza wolontariuszka. Kociak jest juz całkowicie zdrowy. Jego bracia znalazły już cudowne domki… Został tylko on. Całkiem sam. Dowieziemy kociaka do nowego domku, jeśli będzie trzeba. Kolor futerka przecież nie ma znaczenia, on kocha tak samo, jak kochają inne koty. Miesiąc spędził w klinice, także bardzo brakuje mu człowieka i ciepłego domku. Pokochaj Polo !', '/img/animals_photo/cat13.jpg', 'nie', 'tak', 50),
(24, 'Misiu', 'Pies', 'Kundel', 'pies', '7 lat', 'died', 'Dziś pożegnaliśmy się z Misiem, psiakiem, który spędził w schronisku prawie rok, a koniec końców nigdy nie trafił na osobę, która podarowałaby mu ciepły kąt… Odszedł, patrząc na schroniskowe kraty.\r\nZabrany z piekła, nie zdążył za życia do raju. Do domu…\r\n\r\nMisiu został odebrany interwencyjne z okropnych warunków, dosłownie tonął we własnych odchodach, a w miseczce była tylko woda z namoczonym chlebem. Zabraliśmy Misia z tego piekła, ale do prawdziwego, kochającego domku nie zdążył. I już nie zdąży… Mimo to mamy nadzieję, ze ten rok spędzony z nami był dla niego najlepszym w całym jego życiu. Poczuł jak to jest być kochanym. To u nas poznał,co to są spacery, pełna miska dobrego jedzenia, cieplutka buda. Niestety do szczęścia zabrakło tylko człowieka, który zabrałby Misia do domku. Dlaczego?\r\n\r\nStarość jest taka smutna i przeraża tak wielu z nas. Chcielibysmy jednak, aby historia Misia, poruszyła choćby kilka ludzkich serc. Śmierć w schronisku to jedna z najsmutniejszych rzeczy nie tylko dla nas, wolontariuszy, ale przede wszystkim dla nich: dla naszych czworonożnych bezdomniaków. Często ludzie patrzą bardzo egoistycznie na adopcje, szukają towarzysza, który nie odejdzie w najbliższym czasie, aby to ONI nie musieli przeżywać śmierci przyjaciela. Ale te starsze zwierzęta również zasługują na to, by odejść w ciepłym domku, wtulone do kogoś, kogo kochają, komu ufają. Schronisko powinno być tylko miejscem tymczasowym, ale niestety część zwierząt spędza w nim swoje ostatnie lata i to jest bardzo smutne.\r\nŻegnaj Misiu. Biegaj już za Tęczowym Mostem bez bólu i cierpienia.\r\nPrzepraszamy, że nie udało nam się mimo takiego zaangażowania znaleźć Ci domku. Skruszyć żadnego z ludzkich serc ?', '/img/animals_photo/dog12.jpg', 'tak', 'tak', 100),
(25, 'Biszkopt', 'Kot', 'Mieszaniec', 'kot', '3 miesiące', 'died', 'Cudowny burasek szuka kochającego i odpowiedzialnego domu. Biszkopt poza ślicznym wyglądem , ma również wspaniały charakter. Zachęcamy do adopcji tego 3 miesięcznego kocurka.', '/img/animals_photo/cat13.jpeg', 'nie', 'nie', 50),
(26, 'Aja', 'Pies', 'Kundel', 'suka', '12 lat', 'died', 'Niestety Aja nie poczuła czym jest prawdziwy dom i miłość własnego człowieka… ?\r\n\r\n \r\n\r\nTa interwencja była dla naszych inspektorów ciężkim przeżyciem. 12-letnia suczka owczarka niemieckiego Aja przypięta łańcuchem do fragmentu karoserii starego poloneza. Krwawiaca, ledwo stała na łapkach. Nie moglismy jej tak zostawic. Wokół bieda aż piszczy, brak prądu. Zrzeczenie podpisujemy przy swieczkach. Właściciel starszy Pan, tyle co wrócil ze szpitala… Suczka ma rodowód. Tyle lat wiernej służby. Przynosiła przecież komuś kiedys dochód… Rozmnazana wielokrotnie. I taki smutny koniec… Szukamy domku na ostatnie lata życia tej ślicznej suni. Aja jest bardzo łagodnym psem, dla które głównym celem w życiu jest miłość do człowieka. Uwielbia się tulić i głaskać.', '/img/animals-photo/dog14.jpg', 'tak', 'tak', 150),
(27, 'Aja', 'Pies', 'Kundel', 'suka', '12 lat', 'died', 'Niestety Aja nie poczuła czym jest prawdziwy dom i miłość własnego człowieka…\r\nTa interwencja była dla naszych inspektorów ciężkim przeżyciem. 12-letnia suczka owczarka niemieckiego Aja przypięta łańcuchem do fragmentu karoserii starego poloneza. Krwawiaca, ledwo stała na łapkach. Nie moglismy jej tak zostawic. Wokół bieda aż piszczy, brak prądu. Zrzeczenie podpisujemy przy swieczkach. Właściciel starszy Pan, tyle co wrócil ze szpitala… Suczka ma rodowód. Tyle lat wiernej służby. Przynosiła przecież komuś kiedys dochód… Rozmnazana wielokrotnie. I taki smutny koniec… Szukamy domku na ostatnie lata życia tej ślicznej suni. Aja jest bardzo łagodnym psem, dla które głównym celem w życiu jest miłość do człowieka. Uwielbia się tulić i głaskać.', '/img/animals_photo/dog14.jpg', 'tak', 'tak', 100),
(28, 'Denio', 'Kot', 'Mieszaniec', 'kot', '4 miesiące', 'died', 'Denio był zbyt maleńki, by wygrać walkę z chorobą ? Tak nam przykro, że te najmniejsze i najbardziej bezbronne kociaki odchodzą, gdy jeszcze nie zdążyły zaznać, czym jest prawdziwy, kochający dom ?', '/img/animals_photo/cat14.jpg', 'nie', 'nie', 50),
(29, 'Denio', 'Kot', 'Mieszaniec', 'kot', '4 miesiące', 'died', 'Denio był zbyt maleńki, by wygrać walkę z chorobąTak nam przykro, że te najmniejsze i najbardziej bezbronne kociaki odchodzą, gdy jeszcze nie zdążyły zaznać, czym jest prawdziwy, kochający dom', '/img/animals_photo/cat14.jpg', 'nie', 'nie', 50),
(30, 'Biegun', 'Pies', 'Kundel', 'pies', '12 lat', 'died', 'Biegun odszedł za tęczowy most, wypełnił nasze serca smutkiem, żalem i bezsilnością. To był wspaniały, mądry pies, do samego końca mieliśmy nadzieję, że znajdzie dom, że znajdzie osobę, która go pokocha i przygarnie pod swój dach, jednak tak się nie stało. My kochaliśmy go całym sercem, ale nie mogliśmy zapewnić mu domu serce nam pęka :(. Starość plus ogromnej wielkości guz, który po konsultacjach z weterynarzami okazał się nie operacyjny po kolei zajmował coraz większy obszar jego ciała.. ? Biegaj piesku za tęczowym mostem razem z Azą, Areskiem, Florkiem i innymi ?', '/img/animals_photo/dog15.jpg', 'tak', 'tak', 150),
(31, 'Biegun', 'Pies', 'Kundel', 'pies', '12 lat', 'died', 'Biegun odszedł za tęczowy most, wypełnił nasze serca smutkiem, żalem i bezsilnością. To był wspaniały, mądry pies, do samego końca mieliśmy nadzieję, że znajdzie dom, że znajdzie osobę, która go pokocha i przygarnie pod swój dach, jednak tak się nie stało. My kochaliśmy go całym sercem, ale nie mogliśmy zapewnić mu domu serce nam pęka :(. Starość plus ogromnej wielkości guz, który po konsultacjach z weterynarzami okazał się nie operacyjny po kolei zajmował coraz większy obszar jego ciała.. Biegaj piesku za tęczowym mostem razem z Azą, Areskiem, Florkiem i innymi ', '/img/animals_photo/dog15.jpg', 'tak', 'tak', 150),
(32, 'piesio', '', 'ploc', 'suka', '4 lata', 'do adopcji', 'Fajny pies -ryba polecam', '/img/animals_photo/piesio.jpg', 'tak', 'tak', 100);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `adopcje`
--
ALTER TABLE `adopcje`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_zwierze` (`id_zwierze`),
  ADD KEY `id_uzytkownik` (`id_uzytkownik`) USING BTREE;

--
-- Indeksy dla tabeli `historia_platnosci`
--
ALTER TABLE `historia_platnosci`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_klienta` (`id_klienta`) USING BTREE,
  ADD KEY `id_adopcji` (`id_adopcji`) USING BTREE;

--
-- Indeksy dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zwierzeta`
--
ALTER TABLE `zwierzeta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `adopcje`
--
ALTER TABLE `adopcje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `historia_platnosci`
--
ALTER TABLE `historia_platnosci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `zwierzeta`
--
ALTER TABLE `zwierzeta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
