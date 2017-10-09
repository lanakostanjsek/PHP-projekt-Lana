<?php
    session_start();
    include 'baza.php';

    if (!isset($_SESSION['prijava'])){
        header("Location: prijava.php");
    }
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Korisničke aktivnosti</title>
    <link href="lana.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<header>
    <h1>Moje aktivnosti</h1>
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
        <div style="width: 100%;">
            <form method="post" action="korisnikAktivnosti.php">
                <label for="filter">Filtriraj prema</label>
                <select id="filter" name="filter">
                    <option value="1">nazivu udruge</option>
                    <option value="2">datumu održavanja aktivnosti</option>
                </select><br/>
                <label for="naziv">Naziv udruge</label>
                <input type="text" id="naziv" name="naziv"><br/>
                <label for="datum_od">Datum od</label>
                <input type="text" id="datum_od" name="datum_od" placeholder="dd.mm.yyyy" /><br/>
                <label for="datum_do">Datum do</label>
                <input type="text" id="datum_do" name="datum_do" placeholder="dd.mm.yyyy" /><br/>
                <input type="submit" name="filtriraj" value="Filtriraj">
            </form>
        </div>
        <div>
            <table>
                <thead>
                    <th>Aktivnost</th>
                    <th>Udruga</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php
                        $upit = "SELECT a.aktivnost_id, a.naziv as nazivAktivnosti, u.naziv as nazivUdruge FROM aktivnost a, udruga u, sudionik s WHERE s.korisnik_id='{$_SESSION['korisnik_id']}' AND s.aktivnost_id=a.aktivnost_id AND a.udruga_id=u.udruga_id";

                        if (isset($_POST['filtriraj'])){
                            if ($_POST['filter'] == 1){
                                $upit = "SELECT a.aktivnost_id, a.naziv as nazivAktivnosti, u.naziv as nazivUdruge FROM aktivnost a, udruga u, sudionik s WHERE s.korisnik_id='{$_SESSION['korisnik_id']}' AND s.aktivnost_id=a.aktivnost_id AND a.udruga_id=u.udruga_id AND u.naziv LIKE '%{$_POST['naziv']}%'";
                            } else {
                                if (empty($_POST['datum_od'])){
                                    $datum_od = date("Y-m-d", strtotime("1970-01-01"));
                                } else {
                                    $datum_od = date("Y-m-d", strtotime($_POST['datum_od']));
                                }

                                if (empty($_POST['datum_do'])){
                                    $datum_do = date("Y-m-d", strtotime("2020-12-31"));
                                } else {
                                    $datum_do = date("Y-m-d", strtotime($_POST['datum_do']));
                                }

                                $upit = "SELECT a.aktivnost_id, a.naziv as nazivAktivnosti, u.naziv as nazivUdruge FROM aktivnost a, udruga u, sudionik s WHERE s.korisnik_id='{$_SESSION['korisnik_id']}' AND s.aktivnost_id=a.aktivnost_id AND a.udruga_id=u.udruga_id AND a.datum_odrzavanja BETWEEN '{$datum_od}' AND '{$datum_do}'";
                            }
                        }

                        $rezultat = radiSBazom($upit);
                        while ($aktivnost = mysqli_fetch_assoc($rezultat)){
                            echo "<tr>";
                            echo "<td><a target='_blank' href='detaljiAktivnosti.php?aktivnost_id=".$aktivnost['aktivnost_id']."'>".$aktivnost['nazivAktivnosti']."</a></td>";
                            echo "<td>".$aktivnost['nazivUdruge']."</td>";
                            echo "<td><a target='_blank' href='sudioniciAktivnosti.php?aktivnost_id=".$aktivnost['aktivnost_id']."'><button>Prikaži sudionike</button></a></td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<footer>
    <p><b>Lana Kostanjšek</b></p>
    <p>&copy;Sportske udruge</p>
</footer>
</body>
</html>
