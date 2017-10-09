<?php
    session_start();
    include 'baza.php';

    if (!isset($_SESSION['prijava'])){
        header("Location: prijava.php");
    } else if ($_SESSION['tip'] == "korisnik"){
        header("Location: korisnikAktivnosti.php");
    }

?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Pregled svih aktivnosti</title>
    <link href="lana.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<header>
    <h1>Pregled svih aktivnosti</h1>
</header>
<section>
    <div id="nav">
        <ul>
            <?php
                include 'izbornik.php';
            ?>
        </ul>
    </div>
    <div id=sadrzaj>
        <table border="1px solid">
            <thead style="background-color: darkseagreen">
                <th>Naziv aktivnosti</th>
                <th>Naziv udruge</th>
                <th>Opis aktivnosti</th>
                <th>Datum održavanja</th>
                <th>Vrijeme održavanja</th>
                <th>Sudionici</th>
                <th></th>
            </thead>
            <tbody>
                <?php
                    $upit = "SELECT a.*, u.naziv as udrugaNaziv FROM aktivnost a, udruga u WHERE u.udruga_id = a.udruga_id AND u.moderator_id={$_SESSION['korisnik_id']}";
                    $rezultat = radiSBazom($upit);
                    while ($aktivnost = mysqli_fetch_assoc($rezultat)){
                        echo "<tr>";
                        echo "<td>".$aktivnost['naziv']."</td>";
                        echo "<td>".$aktivnost['udrugaNaziv']."</td>";
                        echo "<td>".$aktivnost['opis']."</td>";
                        echo "<td>".date("d.m.Y", strtotime($aktivnost['datum_odrzavanja']))."</td>";
                        echo "<td>".date("H:i:s", strtotime($aktivnost['vrijeme_odrzavanja']))."</td>";

                        $upit = "SELECT k.* FROM korisnik k, sudionik s WHERE s.aktivnost_id={$aktivnost['aktivnost_id']} AND s.korisnik_id=k.korisnik_id";
                        $popisKorisnika = radiSBazom($upit);
                        echo "<td><ol>";
                        while ($korisnik = mysqli_fetch_assoc($popisKorisnika)){
                            echo "<li>".$korisnik['ime']." ".$korisnik['prezime']."</li>";
                        }
                        echo "</ol></td>";
                        echo "<td><a href='azurirajAktivnost.php?aktivnost_id=".$aktivnost['aktivnost_id']."'><button>Ažuriraj</button></a></td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</section>
<footer>
    <p><b>Lana Kostanjšek</b></p>
    <p>&copy;Sportske udruge</p>
</footer>
</body>
</html>
