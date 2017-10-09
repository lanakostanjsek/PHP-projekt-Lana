<?php
session_start();
include 'baza.php';

if (!isset($_SESSION['prijava'])){
    header("Location: prijava.php");
} else if ($_SESSION['tip'] != "administrator"){
    header("Location: korisnikAktivnosti.php");
}

?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Pregled svih udruga</title>
    <link href="lana.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<header>
    <h1>Pregled svih udruga</h1>
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
        <table>
            <thead>
            <th>Naziv</th>
            <th>Opis</th>
            <th>Moderator</th>
            <th></th>
            </thead>
            <tbody>
            <?php
            $upit = "SELECT u.*, k.ime, k.prezime FROM udruga u, korisnik k WHERE u.moderator_id=k.korisnik_id";
            $rezultat = radiSBazom($upit);
            while ($udruga = mysqli_fetch_assoc($rezultat)){
                echo "<tr>";
                echo "<td>".$udruga['naziv']."</td>";
                echo "<td>".$udruga['opis']."</td>";
                echo "<td>".$udruga['ime']." ".$udruga['prezime']."</td>";
                echo "<td><a href='azurirajUdrugu.php?udruga_id=".$udruga['udruga_id']."'><button>Ažuriraj</button></a></td>";
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
