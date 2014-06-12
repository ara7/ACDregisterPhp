<?php
header('Content-type: text/xml');

echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";

$SignumID = $_GET['SignumID']; 
$Name = $_GET['Name'];
$MobileNo = $_GET['MobileNo']; 
$EmailID = $_GET['EmailID'];
//database connection 
$myServer = "10.184.20.93";
$myUser = "sa";
$myPass = "optomation@123";
$myDB = "USERMANAGEMENT"; 

//create an instance of the  ADO connection object
$conn = new COM ("ADODB.Connection")
  or die("Cannot start ADO");

//define connection string, specify database driver
$connStr = "PROVIDER=SQL Server Native Client 10.0 ;SERVER=".$myServer.";UID=".$myUser.";PWD=".$myPass.";DATABASE=".$myDB; 
  $conn->open($connStr); //Open the connection to the database




$query = "
SET NOCOUNT ON
exec [USERMANAGEMENT].[dbo].[user_sp_userRegistration] '" . $SignumID . "','" . $Name . "','" . $MobileNo . "','" . $EmailID . "', '1' ";

// print $query;

$rs = $conn->execute($query);
$num_columns = $rs->Fields->Count(); 

for ($i=0; $i < $num_columns; $i++) 
{
    $fld[$i] = $rs->Fields($i);
}

echo "<catalog>";

while (!$rs->EOF)  //carry on looping through while there are records
{
echo "<row>\n";
    for ($i=0; $i < $num_columns; $i++) 
{
	if ($i == 0)
	{
		echo "<flag>$fld[$i]</flag>";
		
	}

}

 echo "</row>";
    $rs->MoveNext(); //move on to the next record
}
	
echo "</catalog>";	

//close the connection and recordset objects freeing up resources 
//$rs->Close();
//$conn->Close();

$rs = null;
$conn = null;


?>


