<meta charset="UTF-8">
<title>Sletting av student</title> 

<h>Sletting av student</h>
<?php include ("db.php"); ?>
<script type="text/javascript">
    function bekreft() {
        return confirm("Er du sikker?")
    }
</script>

<form method="post" id="slettStudent" name="slettStudent" onSubmit="return bekreft()">
    Velg klasse <select id="brukernavn" name="brukernavn" required>
        <?php $sqlSetning="SELECT * FROM student ORDER BY brukernavn;";
        $sqlResultat=mysqli_query($db,$sqlSetning) or die ("kunne ikke hente data fra databasen");
        $antallRader=mysqli_num_rows($sqlResultat);

        for ($r=1;$r<=$antallRader;$r++) {
            $rad=mysqli_fetch_array($sqlResultat);
            $brukernavn=$rad["brukernavn"];
            $fullnavn = $rad["fornavn"] . " " . $rad["etternavn"];
            print ("<option value='$brukernavn'>$brukernavn | $fullnavn</option>");
        }
        ?>
        </select><br>
    <input type="submit" value="Slett student" id="slettStudentKnapp" name="slettStudentKnapp">
</form>

<?php
if (isset($_POST ["slettStudentKnapp"])) {

    $brukernavn=$_POST ["brukernavn"];

    $sqlSetning="DELETE FROM student WHERE brukernavn='$brukernavn';";
    mysqli_query($db,$sqlSetning) or die ("kan ikke slette data i databsen");
    print ("Studenten $fullnavn er nå slettet!");
}
?>
