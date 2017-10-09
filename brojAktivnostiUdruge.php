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
            <th><?php echo "<a href='brojAktivnostiUdruge.php?prema=2&sort=".$sort."'>Naziv udruge</a>" ?></th>
            <th><?php echo "<a href='brojAktivnostiUdruge.php?prema=1&sort=".$sort."'>Broj aktivnosti</a>" ?></th>
            </thead>
            <tbody>
            <?php
            $upit = "SELECT count(*) as udrugaAktivnost, u.naziv FROM aktivnost a, udruga u WHERE u.udruga_id=a.udruga_id GROUP BY a.udruga_id ORDER BY {$prema} {$sort}";
            $rezultat = radiSBazom($upit);
            while ($udruga = mysqli_fetch_assoc($rezultat)){
                echo "<tr>";
                echo "<td>".$udruga['naziv']."</td>";
                echo "<td>".$udruga['udrugaAktivnost']."</td>";
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
