<?php
    session_start();
    include 'baza.php';
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Popis udruga</title>
    <link href="lana.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<header>
    <h1>Popis udruga</h1>
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
                <th></th>
            </thead>
            <tbody>
                <?php
                    $upit = "SELECT udruga_id, naziv FROM udruga";
                    $rezultat = radiSBazom($upit);
                    while ($udruga = mysqli_fetch_assoc($rezultat)){
                        echo "<tr>";
                        echo "<td>".$udruga['naziv']."</td>";
                        echo "<td><a href='opciPodaciUdruge.php?udruga_id=".$udruga['udruga_id']."'><button class='vise'>Više...</button></a></td>";
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
