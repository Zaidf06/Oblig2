<?php /* oblig2/vis_alle_studenter.php */
/
/*Programmet skriver ut alle registrerte studenter
*/

include ("db.php"); / tilkobling til database-server utført og valg av database foretatt /


$sqlSetning = "SELECT FROM student;";
$sqlResultat = mysqli_query($db, $sqlSetning) or die ("Ikke mulig å hente data fra databasen");
/* SQL-setning sendt til database-serveren */
$sqlantallRader = mysqli_num_rows($sqlResultat); /* antall rader i resultatet beregnet */


print "<h2>Alle studenter</h2>";
print "<table border='1'>";
print "<tr> <th> brukernavn </th> <th> Fornavn </th> <th> Etternavn </th> <th> Klassekode </th> </tr>";

for ($r = 1; $r <= $sqlantallRader; $r++) 
    {
    $rad = mysqli_fetch_array($sqlResultat); /* ny rad hentet fra spørringsresultatet */
    $brukernavn = $rad["brukernavn"]; /* eller brukernavn = $rad[0]; */
    $fornavn = $rad["fornavn"]; /* eller fornavn = $rad[1]; */
    $etternavn = $rad["etternavn"]; /* eller etternavn = $rad[2]; */
    $klassekode = $rad["klassekode"]; /* eller klassekode = $rad[3]; */

    print "<tr> <td> $brukernavn </td> <td> $fornavn </td> <td> $etternavn </td> <td> $klassekode </td> </tr>";
}

print "</table>";
?>