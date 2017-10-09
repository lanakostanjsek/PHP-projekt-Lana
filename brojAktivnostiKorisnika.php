<?php
session_start();
include 'baza.php';

if (!isset($_SESSION['prijava'])){
    header("Location: prijava.php");
} else if ($_SESSION['tip'] != "administrator"){
    header("Location: korisnikAktivnosti.php");
}

$sort = "DESC";
$prema = 1;
if(isset($_GET['sort'])){
    if ($_GET['sort'] == "DESC"){
        $sort = "ASC";
    }
}

if(isset($_GET['prema'])){
    $prema = $_GET['prema'];
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Broj aktivnosti korisnika</title>
    <link href="lana.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<header>
    <h1>Broj aktivnosti korisnika</h1>
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
            <th>Slika</th>
            <th><?php echo "<a href='brojAktivnostiKorisnika.php?prema=2&sort=".$sort."'>Korisničko ime</a>" ?></th>
            <th>Korisnik</th>
            <th>Email</th>
            <th><?php echo "<a href='brojAktivnostiKorisnika.php?prema=1&sort=".$sort."'>Broj aktivnosti</a>" ?></th>
            </thead>
            <tbody>
            <?php
            $upit = "SELECT count(*) as korisnikAktivnost, k.korisnicko_ime, k.slika, k.ime, k.prezime, k.email FROM korisnik k, sudionik s WHERE k.korisnik_id = s.korisnik_id GROUP BY s.korisnik_id ORDER BY {$prema} {$sort}";
            $rezultat = radiSBazom($upit);
            while ($korisnik = mysqli_fetch_assoc($rezultat)){
                echo "<tr>";
                echo "<td><img src='".$korisnik['slika']."' width='50' height='75'/></td>";
                echo "<td>".$korisnik['korisnicko_ime']."</td>";
                echo "<td>".$korisnik['ime']." ".$korisnik['prezime']."</td>";
                echo "<td>".$korisnik['email']."</td>";
                echo "<td>".$korisnik['korisnikAktivnost']."</td>";
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
