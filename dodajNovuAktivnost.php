<?php
    session_start();
    include 'baza.php';

    if (!isset($_SESSION['prijava'])){
        header("Location: prijava.php");
    } else if ($_SESSION['tip'] == "korisnik"){
        header("Location: korisnikAktivnosti.php");
    }

    if(isset($_POST['dodaj'])){
        $datum = date("Y-m-d");
        $vrijeme = date("H:i:s");
        $datumOdrzavanja = date("Y-m-d", strtotime($_POST['datum']));
        $vrijemeOdrzavanja = date("H:i:s", strtotime($_POST['vrijeme']));
        $upit = "INSERT INTO aktivnost(udruga_id, datum_kreiranja, vrijeme_kreiranja, datum_odrzavanja, vrijeme_odrzavanja, naziv, opis) VALUES ('{$_POST['udruga_id']}', '{$datum}', '{$vrijeme}', '{$datumOdrzavanja}', '{$vrijemeOdrzavanja}', '{$_POST['naziv']}', '{$_POST['opis']}')";
        $rezultat = radiSBazom($upit);

        $upit = "SELECT aktivnost_id FROM aktivnost ORDER BY aktivnost_id DESC LIMIT 1";
        $rezultat = radiSBazom($upit);
        $aktivnost = mysqli_fetch_assoc($rezultat);

        $sudioniciAktivnosti = $_POST['sudioniciAktivnosti'];
        for($i=0; $i<count($sudioniciAktivnosti); $i++){
            $upit = "INSERT INTO sudionik(aktivnost_id, korisnik_id) VALUES ('{$aktivnost['aktivnost_id']}', '{$sudioniciAktivnosti[$i]}')";
            $rezultat = radiSBazom($upit);
        }
    }

?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Dodavanje nove aktivnosti</title>
    <link href="lana.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<header>
    <h1>Dodavanje nove aktivnosti</h1>
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
        <form method="post" action="dodajNovuAktivnost.php">
            <label for="naziv">Naziv aktivnosti</label>
            <input type="text" id="naziv" name="naziv" required><br/>
            <label for="udruga_id">Odaberite udrugu</label>
            <select name="udruga_id" id="udruga_id">
            <?php
                $upit = "SELECT udruga_id, udruga.naziv FROM udruga WHERE moderator_id={$_SESSION['korisnik_id']}";
                $rezultat = radiSBazom($upit);
                while ($udruga = mysqli_fetch_assoc($rezultat)){
                    echo "<option value='".$udruga['udruga_id']."'>".$udruga['naziv']."</option>";
                }
            ?>
            </select><br/>
            <label for="datum">Datum i vrijeme održavanja</label>
            <input style="width: 20%;" type="text" name="datum" id="datum" required placeholder="dd.mm.yyyy">
            <input style="width: 20%;" type="text" name="vrijeme" required placeholder="hh:mm:ss"><br/>
            <label for="opis">Opis aktivnosti</label>
            <textarea name="opis" id="opis" cols="40" rows="3"></textarea><br/>
            <table>
                <tr>
                    <td>Odaberite sudionike</td>
                    <td>
                        <?php
                            $upit = "SELECT * FROM korisnik";
                            $rezultat = radiSBazom($upit);
                            while ($korisnik = mysqli_fetch_assoc($rezultat)){
                                echo "<input style='clear: both;' type='checkbox' name='sudioniciAktivnosti[]' value='{$korisnik['korisnik_id']}' />".$korisnik['ime']." ".$korisnik['prezime']."<br/>";
                            }
                        ?>
                    </td>
                </tr>
            </table>
            <input type="submit" name="dodaj" value="Dodaj aktivnost">
        </form>
    </div>
</section>
<footer>
    <p><b>Lana Kostanjšek</b></p>
    <p>&copy;Sportske udruge</p>
</footer>
</body>
</html>
