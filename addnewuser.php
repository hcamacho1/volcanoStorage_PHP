
<html>
    
<head class="header">
<link rel="stylesheet" type="text/css" href="styleVol.css"/> 
    <title>Volcano Storage</title>
  <div id="logoBG">
        Volcano Storage
    </div>
    <!--div id="bannerPic">
        <img src="banner2.jpg" >    
    </div-->
  


</head>
    <body>

<?php
session_start();

//variables posted from managerPage.php add new user box
    $fName = trim($_POST['fname']);
    $lName = trim($_POST['lname']);
    $ADDR = trim($_POST['address']);
    $CITY = trim($_POST['city']);
    $STATE = trim($_POST['state']);
    $ZIP = trim($_POST['zip']);
    $PHONE = trim($_POST['phone']);
    $EMAIL = trim($_POST['email']);
    $numUnits = $_POST['units'];
    $username = $_POST['userName'];
    $password = $_POST['password'];
    $id = 0;

$_SESSION['fname'] = $fName;
$_SESSION['lName'] = $lName;

include 'connect.php';
    //insert statement to update users table
        $query = "INSERT INTO users VALUES ('$id','$username','$password')";
        $result = $db->query($query);

        if (!$result)
        {
            echo 'update 1 unsuccessful'; 
            die(mysql_error());
               
        }
        else
        {
            
         echo 'users table updated'; 
            echo '<br>';
        }
        


    $query2 = "INSERT INTO user_info VALUES ('$id','$fName','$lName','$ADDR','$CITY','$STATE','$ZIP','$PHONE','$EMAIL')";
 $result = $db->query($query2);

        if (!$result)
        {
            echo 'update 2 unsuccessful'; 
            die(mysql_error());
               
        }
        else
        {
            
         echo 'usersinfo table updated'; 
        }

echo '<h3>Number of Storage Units Requested '.$numUnits.'</h3>';
echo '<table id="units">';
echo '<thead><td>Open Storage Units</td></thead>';
echo '<tr><td>Unit Number</td><td>Unit Price</td><td>Unit Size</td></tr>';
$query3 = 'SELECT * FROM storageunits WHERE custId IS NULL';
    $result = $db->query($query3);

if($result)
{
 while($row = $result->fetch_object())
        {
            echo '<tr>';
            echo '<td>'.$row->unitNumber.'</td>';
            echo '<td>'.$row->unitCost.'</td>';
            echo '<td>'.$row->unitSize.'</td>';
            echo '</tr>';
        }
}
echo '</table>';

echo '<form action="completeNewCustomer.php" method="post">';
echo '<table id="newUnit">';
echo '<thead><td>Complete New Customer</td></thead>';
echo '<tr><td>Unit Number</td><td><input type="text" name="unitNum"></td></tr>';
echo '<tr><td>Payment Amount</td><td><input type="text" name="payment"></td></tr>';
echo '<tr><td>Credit Card Number</td><td><input type="text" name="cardNumber"></td></tr>';
echo '<tr><td><select name="cardType">';
echo '<option value="" disabled="disabled" selected="selected">Please select a Card Type</option>';
echo '<option value="Master Card">Mastercard</option>';
echo '<option value="Visa">Visa</option>';
echo '<option value="Discover">Discover</option>';    
echo '</select></td></tr>';
echo '<tfoot><td><input type="submit" value="Make Payment"></td></tfoot>';
echo '</table>';


?>
        
        
        
</body>
    </html>
        
        