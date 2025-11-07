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
    Velg klasse <select id="klasseKode" name="klasseKode" required>
        <?php $sqlSetning="SELECT * FROM klasse ORDER BY klassekode;";
        $sqlResultat=mysqli_query($db,$sqlSetning) or die ("kunne ikke hente data fra databasen");
        $antallRader=mysqli_num_rows($sqlResultat);

        for ($r=1;$r<=$antallRader;$r++) {
            $rad=mysqli_fetch_array($sqlResultat);
            $klasseKode=$rad["klassekode"];
            print ("<option value='$klasseKode'>$klasseKode</option>");
        }
        ?>
        </select><br>
    <input type="submit" value="Slett klasse" id="slettklasseKnapp" name="slettklasseKnapp">
</form>

<?php
if (isset($_POST ["slettklasseKnapp"])) {

    $klasseKode=$_POST ["klasseKode"];

    $sqlSetning="SELECT * FROM student where klassekode='$klasseKode';";
    $sqlResultat=mysqli_query($db,$sqlSetning);
    $antallRader=mysqli_num_rows($sqlResultat);

    if ($antallRader!=0) {
        print("Det finnes fortsatt studenter i klassen $klasseKode. Klassen kan ikke slettes!");
    }
    else {
        $sqlSetning="DELETE FROM klasse WHERE klassekode='$klasseKode';";
        mysqli_query($db,$sqlSetning) or die ("kan ikke slette data i databsen");
        print ("Klassen $klasseKode er nå slettet!");
    }
}
?>
