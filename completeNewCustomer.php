<?php
session_start();
include 'connect.php';
$fName = $_SESSION['fname'];
$lastName = $_SESSION['lName'];
$paymentDate1;
$paymentDate2;
$payment = $_POST['payment'];
 $cardNumber = $_POST['cardNumber'];
 $cardtype = $_POST['cardType'];
 $unit = $_POST['unitNum'];
$price = 0.00;


echo $fName ;
$id;
//get user id for transaction list
$query = "SELECT user_info.iduserInfo FROM user_info WHERE firstName = '$fName'";
$result = $db->query($query);

if ($result)
{
    while($row = $result->fetch_object())
    {
    $id = $row->iduserInfo;
        echo $id;
        
    }
    
}

//update unit list

$query = "UPDATE storageunits SET custId= '$id' WHERE unitNumber= '$unit'";
$result = $db->query($query);
   if ($result)
   {
      echo 'unit success'; 
      
        
   }
    else
    {
    echo 'insert failed';
       die(mysql_error());
    }

$query = "SELECT * FROM storageunits WHERE custId= '$id' AND unitNumber= '$unit'";
$result = $db->query($query);
   if ($result)
   {
       while($row = $result->fetch_object())
    {
           $price = $row->unitCost;
      echo 'unit update success'; 
       } 
        
   }
    else
    {
    echo 'insert failed';
       die(mysql_error());
    }

//update account info table----------------------------------------------------------------------------------------------


$query = "INSERT INTO accountinfo VALUES ('NULL',CURRENT_DATE(),'$price' ,CURRENT_DATE(),DATE_ADD(CURRENT_DATE(),INTERVAL 31 DAY),'$id','$unit',0.00)";

 if ($result)
   {
      echo 'unit insert success'; 
      
        
   }
    else
    {
    echo 'insert failed';
       die(mysql_error());
    }







//get current payment date from database----------------------------------------------------------------------------------


$query = 'SELECT CURRENT_DATE() date';


$result = $db->query($query);
    if ($result)
    {
        while($row = $result->fetch_object())
        {
            $paymentDate1 = $row->date;
           // echo $row->date;
          
        }
    }
 else
    {

        die(mysql_error());
    }
    
 
//get next payment date----------------------------------------------------------------------------------------------------------

$query = 'SELECT DATE_ADD(CURRENT_DATE(),INTERVAL 31 DAY) date';

$result = $db->query($query);
    if ($result)
    {
        while($row = $result->fetch_object())
        {
            $paymentDate2 = $row->date;
            //echo $row->date;
          
        }
    }
 else
    {
    echo 'nope';
        die(mysql_error());
    }

 // $paymentDate1 = date("Y-m-d",strtotime($paymentDate1));
  //  $paymentDate2 = date("Y-m-d",strtotime($paymentDate2));
    
    echo  $paymentDate1;
    echo $paymentDate2;
    
    // insert new row into transaction table------------------------------------------------------------------------------------------------------
    $paid = "yes";
$query3 = "INSERT INTO transactionlist VALUES ('$id','$payment','$paymentDate1','$paymentDate2','$cardNumber','$cardtype','$paid','NULL')";
    $result = $db->query($query3);
   if ($result)
   {
      echo 'transaction success'; 
      
    }
    else
    {
    echo 'insert failed';
       die(mysql_error());
    }

echo '<table id="recipt">';
echo '<thead><td><h1>Thank You</h1></td></thead>';
echo '<tr><td>Card Type</td><td>'.$cardtype.'</td></tr>';
echo '<tr><td>Payment Date</td><td>'.$paymentDate1.'</td></tr>';
echo '<tr><td>Amount Paid</td><td>$'.$payment.'</td></tr>';
echo '<tr><td>Next Payment Date</td><td>'.$paymentDate2.'</td></tr>';
echo '</table>';

    echo '<a href="managerPage.php">Go Back to My page</a>';
    echo '</br>';
    echo '<a href="logout.php">Logout</a>';

?>