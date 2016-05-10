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
$currentAmount = 0.00;
$totalAmount = 0.00;
@ session_start();
include 'connect.php';

if (empty($_SESSION['validUser']) || $_SESSION['counter'] > 1)
{
    echo 'Sorry you must login to view customer info page.';
    echo '<a href="volcanoHome.html">Return to home page</a>';
}
else
{
    
    echo $_SESSION['counter'];
echo '<div id="custOuterBox">';
echo '<a href="logout.php">Logout</a>';
echo '<div id="welcomeMess">Welcome '. $_SESSION['validUser'].'</div>';
echo '<div id="accountSummary">';
echo '<table border="solid" >';
echo '<thead><td colspan="4" align="center"><h1>Account Summary</h1></td></thead>';
echo '<tr><td>Storage Unit</td><td>Next Payment Date</td><td>Amount Due</td></tr>';
    $id = $_SESSION['id'];
    $query = 'SELECT storageunits.unitNumber, accountinfo.nextPaymentDate, storageunits.unitCost, accountinfo.monthlyPayment, accountinfo.previousBalance FROM storageunits, accountinfo WHERE storageunits.custId= '.$id.' AND storageunits.custId = accountInfo.userId';
    $result = $db->query($query);
    if ($result)
    {
        while($row = $result->fetch_object())
        {
            echo '<tr>';
                $balance = $row->previousBalance;
            echo '<td>'.$row->unitNumber.'</td>';
            echo '<td>'.$row->nextPaymentDate.'</td>';
            echo '<td>'.$row->unitCost.'</td>';
            $currentAmount += $row->unitCost;
            $totalAmount += ($row->unitCost + $row->previousBalance);
            $_SESSION['paymentdate'] = $row->nextPaymentDate;
            echo '</tr>';
           
        }
    }
    else
    {
        die(mysql_error());
    }
    $totalAmount = (double)$totalAmount;
$_SESSION['totalAmount'] = $totalAmount;
echo '</table>';
echo '</div>';


echo '<form action="makePayment.php" method="post">';
echo '<table id="payMe" >';
echo '<thead><td>Make A Payment</td></thead>';
    if ($balance > 0.00)
    {
echo '<tr><td>Previous Balance</td><td>'.$balance.'</td></tr>';        
    }
echo '<tr><td>Current Balance</td><td>'.$currentAmount.'</td></tr>';
echo '<tr><td>Amount Due</td><td>'.$totalAmount.'</td></tr>';
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
echo '</form>';
echo '</div>';

    
}

?>
    </body>
    </html>