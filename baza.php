<?php

function radiSBazom($upit){
    $server = "localhost";
    $korisnicko_ime = "";
    $lozinka = "";
    $baza = "";

    $veza = mysqli_connect($server, $korisnicko_ime, $lozinka, $baza);
    $veza->set_charset("utf8");
    $rezultat = $veza->query($upit);

    $veza->close();
    return $rezultat;
}

?>