<html>
<head>
<meta name="Description" content="Title Insurance Closing Packages of Residential Title and Escrow Services which handles closings in Massachusetts, Rhode Island, Connecticut, and New Hampshire. Attorneys close in the Registry of Deeds, realtor's office and borrower's home.">
<meta name="Keywords" content="Title Insurance Packages Residential Title Services Escrow Closing Attorneys Real Estate Attorneys">

<link rel="stylesheet" href="Stylesheets/Res-Title_GFE.css" type="text/css" />
  	
</head>
<body>
<?php
//intake variables
$FirstName = $_POST['FirstName'];
$LastName = $_POST['LastName'];
$Office = $_POST['Office'];
$FindPeople = $_POST['PeopleSearch'];

$Title_Type = $_POST['Title_Type'];
$BorrowerName = $_POST['BorrowerName'];
$State = $_POST['state'];
$Paralegal = $_POST['ParalegalSearch'];

$BorrowerInitial = substr($BorrowerName,0,1);


//echo '<br />FirstName: '.$FirstName;
//echo '<br />LastName: '.$LastName;
//echo '<br />Office: '.$Office;
//echo '<br />AllEmployees: '.$AllEmployees;
//echo '<br />FindPeople: '.$FindPeople;
//echo '<br />$Title_Type: '.$Title_Type;
//echo '<br />$BorrowerName: '.$BorrowerName;
//echo '<br />$BorrowerInitial: '.$BorrowerInitial;
//echo '<br />$State: '.$State;
//echo '<br />$Paralegal: '.$Paralegal.'<br /><br /><br />';


if($FindPeople=='Find People'){


$username="jimboind_ResDB";
$password="R3sT!tle";
$database="jimboind_ResTitle";

$db = mysql_connect('localhost',$username,$password);
@mysql_select_db($database) or die( "Unable to select database ". mysql_error());

error_reporting(E_ALL);


$query="SELECT count(*) FROM Employees WHERE ";
$query1="SELECT * FROM Employees WHERE ";

if($FirstName<>"" && $LastName<>"" && $Office<>"All"){
	$query=$query."LastName LIKE '".$LastName."' and FirstName LIKE '".$FirstName."' and Office='".$Office."'";
	$query1=$query1."LastName LIKE '".$LastName."' and FirstName LIKE '".$FirstName."' and Office='".$Office."'";}

if($FirstName<>"" && $LastName<>"" && $Office=="All"){
	$query=$query."LastName LIKE '".$LastName."' and FirstName LIKE '".$FirstName."'";
	$query1=$query1."LastName LIKE '".$LastName."' and FirstName LIKE '".$FirstName."'";}

if($FirstName<>"" && $LastName=="" && $Office<>"All"){
	$query=$query."FirstName LIKE '".$FirstName."' and Office='".$Office."'";
	$query1=$query1."FirstName LIKE '".$FirstName."' and Office='".$Office."'";}

if($FirstName<>"" && $LastName=="" && $Office=="All"){
	$query=$query."FirstName LIKE '".$FirstName."'";
	$query1=$query1."FirstName LIKE '".$FirstName."'";}
	
if($FirstName=="" && $LastName<>"" && $Office<>"All"){
	$query=$query."LastName LIKE '".$LastName."' and Office='".$Office."'";
	$query1=$query1."LastName LIKE '".$LastName."' and Office='".$Office."'";}

if($FirstName=="" && $LastName<>"" && $Office=="All"){
	$query=$query."LastName LIKE '".$LastName."'";
	$query1=$query1."LastName LIKE '".$LastName."'";}
	
if($FirstName=="" && $LastName=="" && $Office<>"All"){
	$query=$query."Office='".$Office."'";
	$query1=$query1."Office='".$Office."'";}
		
if($FirstName=="" && $LastName=="" && $Office=="All"){
	$query="SELECT count(*) FROM Employees";
	$query1="SELECT * FROM Employees";}



$array=mysql_fetch_array(mysql_query($query)); 
$count= (int) $array[0];

$results=mysql_query($query1); 
$array=mysql_fetch_array($results);

//echo '<br /><br />Count: '.$count;
//echo '<br /><br />Query: '.$query;
//echo '<br /><br />Query1: '.$query1.'<br /><br /><br />';


if($count>0){
echo '<form name="CALC"  >';
echo '<table width="700" border="2" cellspacing="0" cellpadding="4">';
echo '<tr><td><b>First Name</b></td>';
echo '<td><b>Last Name</b></td>';
echo '<td><b>Title</b></td>';
echo '<td><b>E-Mail</b></td>';
echo '<td><b>Phone</b></td>';
echo '<td><b>Office</b></td></tr>';

for($i=1;$i<= $count; $i++){
echo "<tr><td>".$array[1]."               </td>";
echo "<td>".$array[2]."               </td>";
echo "<td>".$array[3]."                  </td>";
echo "<td><a href=mailto:'".$array[4]."'>".$array[4]."</a></td>";
echo "<td>".$array[5]."               </td>";
echo "<td>".$array[6]."              </td></tr>";

$array=mysql_fetch_array($results);
}
   
echo '</table></from>';
}

}//end find people

if($Paralegal=='Find Paralegal'){

if($Title_Type=="refinance"){

switch($BorrowerInitial){
case "a":	
case "b":	
case "c":
case "d":
case "e":	
case "f":
	
echo "<br /><b>Res/Title Contact</b><br />";
echo "Michela Rivera<br />";
echo "(508) 948-3311<br />";
echo "<a href='mailto:mrivera@res-title.com'>mrivera@res-title.com</a><br />";
break;

case "g":	
case "h":	
case "i":	
case "j":	
case "k":	
case "l":
	
echo "<br /><b>Res/Title Contact</b><br />";
echo "Deb Mattison<br />";
echo "(508) 948-3310<br />";
echo "<a href='mailto:dmattison@res-title.com'>dmattison@res-title.com</a><br />";
break;

case "m":	
case "n":	
case "o":	
case "p":	
case "q":	
case "r":	
case "s":
	
echo "<br /><b>Res/Title Contact</b><br />";
echo "Carol Sylvestre<br />";
echo "(508) 948-3309<br />";
echo "<a href='mailto:csylvestre@res-title.com'>csylvestre@res-title.com</a><br />";
break;

case "t":	
case "u":	
case "v":	
case "w":	
case "x":	
case "y":	
case "z":
default:
	
echo "<br /><b>Res/Title Contact</b><br />";
echo "Cassandra Santana<br />";
echo "(508) 948-3321<br />";
echo "<a href='mailto:csantana@res-title.com'>csantana@res-title.com</a><br />";
break;



}//end switch

}//end Refinance

//Purchase
else{

switch($State){
Case "MA":	
echo "<br /><b>Res/Title Contact</b><br />";
echo "Michela Rivera<br />";
echo "(508) 948-3311<br />";
echo "<a href='mailto:mrivera@res-title.com'>mrivera@res-title.com</a><br />";

echo "<br /><b>Res/Title Contact</b><br />";
echo "Deb Mattison<br />";
echo "(508) 948-3310<br />";
echo "<a href='dmattison@res-title.com'>dmattison@res-title.com</a><br />";

break;	

Case "CT":	

echo "<br /><b>Res/Title Contact</b><br />";
echo "Carol Sylvestre<br />";
echo "(508) 948-3309<br />";
echo "<a href='mailto:csylvestre@res-title.com'>csylvestre@res-title.com</a><br />";

break;

Case "RI":	

echo "<br /><b>Res/Title Contact</b><br />";
echo "Dena Robinson<br />";
echo "(401) 773-2080<br />";
echo "<a href='mailto:drobinson@res-title.com'>drobinson@res-title.com</a><br />";

echo "<br /><b>Res/Title Contact</b><br />";
echo "Nichole Pouler<br />";
echo "(401) 773-2077<br />";
echo "<a href='mailto:npouler@res-title.com'>npouler@res-title.com</a><br />";

break;

Case "NJ":	
Case "NY":

echo "<br /><b>Res/Title Contact</b><br />";
echo "Giovanna Tejeda<br />";
echo "(845) 501-4244<br />";
echo "<a href='mailto:gtejeda@res-title.com'>gtejeda@res-title.com</a><br />";

echo "<br /><b>Res/Title Contact</b><br />";
echo "Donna Laverack<br />";
echo "(845) 501-4242<br />";
echo "<a href='mailto:dlaverack@res-title.com'>dlaverack@res-title.com</a><br />";

break;

default:

echo "<br /><b>Res/Title Contact</b><br />";
echo "Dena Robinson<br />";
echo "(401) 773-2080<br />";
echo "<a href='mailto:drobinson@res-title.com'>drobinson@res-title.com</a><br />";

	
} // end State switch


}// end Purchase

} //end find paralegal


 ?>       
        <!-- End dynamic table! -->
        
 
</body>
</html>
