<?php
    session_start();
    include 'baza.php';

    if (isset($_GET['udruga_id'])){
        $upit = "SELECT * FROM udruga WHERE udruga_id='{$_GET['udruga_id']}'";
        $rezultat = radiSBazom($upit);
        $udruga = mysqli_fetch_assoc($rezultat);
    } else {
        header("Location: index.php");
    }

?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Opći podaci o udruzi</title>
    <link href="lana.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<header>
    <h1>Opći podaci i aktivnosti udruge</h1>
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
            <tr>
                <td>Naziv</td>
                <td><?php echo $udruga['naziv']; ?></td>
            </tr>
            <tr>
                <td>Opis</td>
                <td><?php echo $udruga['opis']; ?></td>
            </tr>
            <tr>
                <td>Aktivnosti</td>
                <td>
                    <?php
                        $upit = "SELECT * FROM aktivnost WHERE udruga_id='{$_GET['udruga_id']}'";
                        $rezultat = radiSBazom($upit);

                        echo "<ul>";
                        while ($aktivnost = mysqli_fetch_assoc($rezultat)){
                            echo "<li>".$aktivnost['naziv']."</li>";
                        }
                        echo "</ul>";
                    ?>
                </td>
            </tr>
        </table>
    </div>
</section>
<footer>
    <p><b>Lana Kostanjšek</b></p>
    <p>&copy;Sportske udruge</p>
</footer>
</body>
</html>
