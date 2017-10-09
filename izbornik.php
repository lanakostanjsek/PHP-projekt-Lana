<?php
$izbornik = "";

if(!isset($_SESSION['prijava'])){
    $izbornik .= "<li><a href='index.php'>Početna</a></li>";
    $izbornik .= "<li><a href='o_autoru.html'>O autoru</a></li>";
    $izbornik .= "<li><a href='prijava.php'>Prijava</a></li>";
} else {
    switch ($_SESSION['tip']){
        case "korisnik": $izbornik .= "<li><a href='index.php'>Početna</a></li>";
                $izbornik .= "<li><a href='o_autoru.html'>O autoru</a></li>";
                $izbornik .= "<li><a href='korisnikAktivnosti.php'>Korisničke aktivnosti</a></li>";
                $izbornik .= "<li><a href='odjava.php'>Odjava</a></li>";
            break;
        case "moderator": $izbornik .= "<li><a href='index.php'>Početna</a></li>";
                $izbornik .= "<li><a href='o_autoru.html'>O autoru</a></li>";
                $izbornik .= "<li><a href='korisnikAktivnosti.php'>Korisničke aktivnosti</a></li>";
                $izbornik .= "<li><a href='pregledSvihAktivnosti.php'>Pregled svih aktivnosti</a></li>";
                $izbornik .= "<li><a href='dodajNovuAktivnost.php'>Dodaj novu aktivnost</a></li>";
                $izbornik .= "<li><a href='odjava.php'>Odjava</a></li>";
            break;
        case "administrator": $izbornik .= "<li><a href='index.php'>Početna</a></li>";
                $izbornik .= "<li><a href='o_autoru.html'>O autoru</a></li>";
                $izbornik .= "<li><a href='korisnikAktivnosti.php'>Korisničke aktivnosti</a></li>";
                $izbornik .= "<li><a href='pregledSvihAktivnosti.php'>Pregled svih aktivnosti</a></li>";
                $izbornik .= "<li><a href='dodajNovuAktivnost.php'>Dodaj novu aktivnost</a></li>";
                $izbornik .= "<li><a href='pregledSvihKorisnika.php'>Pregled svih korisnika</a></li>";
                $izbornik .= "<li><a href='dodajNovogKorisnika.php'>Dodaj novog korisnika</a></li>";
                $izbornik .= "<li><a href='brojAktivnostiKorisnika.php'>Broj aktivnosti korisnika</a></li>";
                $izbornik .= "<li><a href='pregledSvihUdruga.php'>Pregled svih udruga</a></li>";
                $izbornik .= "<li><a href='dodajNovuUdrugu.php'>Dodaj novu udrugu</a></li>";
                $izbornik .= "<li><a href='brojAktivnostiUdruge.php'>Broj aktivnosti udruge</a></li>";
                $izbornik .= "<li><a href='odjava.php'>Odjava</a></li>";
            break;
    }
}

echo $izbornik;
?>