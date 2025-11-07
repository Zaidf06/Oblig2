<meta charset="UTF-8">
<?php /* oblig2/registrer_klasse.php /
/*
/Programmet lager et html-skjema for registrering av ny klasse i databasen
/Programmet registrerer klassen når skjema er sendt inn
*/
?>

<h2>Registrer ny klasse</h2>
<form method="post" action="registrer_klasse.php">
    <label for="klassekode">Klassekode:</label>
    <input type="text" id="klassekode" name="klassekode" required><br><br>

    <label for="klassenavn">Klassenavn:</label>
    <input type="text" id="klassenavn" name="klassenavn" required><br><br>

    <label for="studiumkode">Studiumkode:</label>
    <input type="text" id="studiumkode" name="studiumkode" required><br><br>

    <input type="submit" value="Registrer klasse">
</form>

<?php
if (isset($_POST ["klassekode"]))
{
$klassekode=$_POST ["klassekode"];
$klassenavn=$_POST ["klassenavn"];
$studiumkode=$_POST ["studiumkode"];
if (!$klassekode,  !$klassenavn,  !$studiumkode)
{
print ("Alle felt m&aring; fylles ut");
}
else
{
include("db.php"); /* tilkobling til database-serveren utført og valg av database foretatt */

$sqlSetning="SELECT FROM klasse WHERE klassekode='$klassekode';";
$sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
$antallRader=mysqli_num_rows($sqlResultat); /* antall rader i resultatet beregnet */


if ($antallRader!=0) /* klassen er registrert fra før */
{
print ("Emnet er registrert fra f&oslashr");
}
else
{
$sqlSetning="INSERT INTO klasse (klassekode,klassenavn,studiumkode)
VALUES('$klassekode','$klassenavn','$studiumkode');";
mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; registrere data i databasen");
print ("F&oslash;lgende klasse er n&aring; registrert: $klassekode $klassenavn $studiumkode");
}
}
}

?>
