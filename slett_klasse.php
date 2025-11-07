<meta charset="UTF-8">
<title>Sletting av klasse</title> 

<h>Sletting av klasse</h>
<?php include ("db.php"); ?>
<script type="text/javascript">
    function bekreft() {
        return confirm("Er du sikker?")
    }
</script>
<br><br>
<form method="post" id="slettKlasse" name="slettKlasse" onSubmit="return bekreft()">
    Velg klasse <select id="k" name="k" required>
        <?php $sqlSetning="SELECT * FROM klasse ORDER BY klassekode;";
        $sqlResultat=mysqli_query($db,$sqlSetning) or die ("kunne ikke hente data fra databasen");
        $antallRader=mysqli_num_rows($sqlResultat);

        for ($r=1;$r<=$antallRader;$r++) {
            $rad=mysqli_fetch_array($sqlResultat);
            $k=$rad["klassekode"];
            print ("<option value='$klassekode'>$klassekode</option>");
        }
        ?>
        </select><br>
    <input type="submit" value="Slett klasse" id="slettklasseKnapp" name="slettklasseKnapp">
</form>

<?php
if (isset($_POST ["slettklasseKnapp"])) {

    $k=$_POST ["k"];

    $sqlSetning="SELECT * FROM student where klassekode='$k';";
    $sqlResultat=mysqli_query($db,$sqlSetning);
    $antallRader=mysqli_num_rows($sqlResultat);

    if ($antallRader!=0) {
        print("Det finnes fortsatt studenter i klassen $k. Klassen kan ikke slettes!");
    }
    else {
        $sqlSetning="DELETE FROM klasse WHERE klassekode='$k';";
        mysqli_query($db,$sqlSetning) or die ("kan ikke slette data i databsen");
        print ("Klassen $k er nå slettet!");
    }
}
?>