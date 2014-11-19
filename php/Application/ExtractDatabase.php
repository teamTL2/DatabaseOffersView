<?php

$con = mysql_connect("sql1.serversfree.com","u992803791_admin","1991247");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("u992803791_offer", $con);

$result = mysql_query("SELECT Name , X , Y , ProductName , Offer 
FROM Makes INNER JOIN ProductOffers ON Makes.ID_ProductOffers = ProductOffers.ID_ProductOffers 
INNER JOIN Shops ON Makes.Name = Shops.Name AND Makes.Password = Shops.Password");

while($row = mysql_fetch_assoc($result))
  {
	$output[]=$row;
  }

print(json_encode($output));

mysql_close($con);


?>