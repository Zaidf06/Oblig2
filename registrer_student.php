<meta charset="UTF-8">
<title>Registrering av student</title>
<h>Registrerering av student</h>

<?php include("db.php"); ?>

<form method="post" id="regStudent" name="regStudent"><br>
    Brukernavn <input type="text" id="brukernavn" name="brukernavn" required><br>
    Fornavn <input type="text" id="fornavn" name="fornavn" required><br>
    Etternavn <input type="text" id="etternavn" name="etternavn" required><br>
    Klassekode <select id="klassekode" name="klassekode" required>
        <?php 
        $sqlSetning="SELECT * FROM klasse ORDER BY klassekode;";
        $sqlResultat=mysqli_query($db,$sqlSetning) or die ("kunne ikke hente data fra databasen");
        $antallRader=mysqli_num_rows($sqlResultat);

        for ($r=1;$r<=$antallRader;$r++) {
            $rad=mysqli_fetch_array($sqlResultat);
            $klassekode=$rad["klassekode"];
            print ("<option value='$klassekode'>$klassekode</option>");
        }
        ?>
    </select><br>

    <input type="submit" value="Registrer student" id="regStudentKnapp" name="regStudentKnapp">
    <input type="reset" value="Nullstill" id="nullstill" name="nullstill">
</form>


<?php
if (isset($_POST ["regStudentKnapp"])) {

    $brukernavn=$_POST ["brukernavn"];
    $fornavn=$_POST ["fornavn"];
    $etternavn=$_POST ["etternavn"];
    $klassekode=$_POST ["klassekode"];

    if (!$brukernavn || !$fornavn || !$etternavn || !$klassekode) {
        print ("oops! Alle felt må fylles ut!");
    } 
    else
    {
        $sqlSetning="SELECT * FROM student WHERE brukernavn='$brukernavn';";
        $sqlResultat=mysqli_query($db,$sqlSetning) or die ("Kunne ikke hente data fra databasen");
        $antallRader=mysqli_num_rows($sqlResultat);
        if ($antallRader!=0) {
            print ("Studenten er allerede registrert!");
        } 
        else {
            $sqlSetning="INSERT INTO student (brukernavn,fornavn,etternavn,klassekode)
            VALUES('$brukernavn','$fornavn','$etternavn','$klassekode');";
            mysqli_query($db,$sqlSetning) or die ("kan ikke registrere data i databasen");
            print ("Følgende student er nå registrert: $brukernavn | $fornavn | $etternavn | $klassekode");
        }
    }
}
?>
