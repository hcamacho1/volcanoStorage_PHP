<?php
session_start();
include 'connect.php';
$cardNumber = $_POST['cardNumber'];
$cardtype = $_POST['cardType'];
$payment = $_POST['payment'];
$amtDue = $_SESSION['totalAmount'];
$dueDate = $_SESSION['paymentdate'];
 $id = $_SESSION['id'];
 $paymentDate1;
 $paymentDate2;

//get current payment date from database----------------------------------------------------------------------------------
if ($payment == $amtDue)
{

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

$query2 = 'UPDATE accountinfo SET lastPaymentDate= CURRENT_DATE(),nextPaymentDate= DATE_ADD(CURRENT_DATE(),INTERVAL 31 DAY)  WHERE userId='.$id.''; 


$result = $db->query($query2);
   if ($result)
   {
      echo 'success1'; 
      
        
   }
    else
    {
    echo 'insert failed';
       die(mysql_error());
    }
// insert new row into transaction table------------------------------------------------------------------------------------------------------
    $paid = "yes";
$query3 = "INSERT INTO transactionlist VALUES ('$id','$payment','$paymentDate1','$paymentDate2','$cardNumber','$cardtype','$paid','NULL')";
    $result = $db->query($query3);
   if ($result)
   {
      echo 'success2'; 
      
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

    echo '<a href="customerPage.php">Go Back to My page</a>';
    echo '</br>';
    echo '<a href="logout.php">Logout</a>';

}





//-------------------------------------------------------------------------------------------------------------------------------------
//Partial Payment ---------------------------------------------------------------------------------------------------------------------

if ($payment < $amtDue)
{
 $remainingBalance = $amtDue - $payment;
    
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
    
 
//get next payment date--------------------------------------------------------------------------------------------------------------------

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

$query2 = 'UPDATE accountinfo SET lastPaymentDate= CURRENT_DATE(),nextPaymentDate= DATE_ADD(CURRENT_DATE(),INTERVAL 31 DAY)  WHERE userId='.$id.''; 


$result = $db->query($query2);
   if ($result)
   {
      echo 'success1'; 
      
        
   }
    else
    {
    echo 'insert failed';
       die(mysql_error());
    }
// insert new row into transaction table
    $paid = "partial";
$query3 = "INSERT INTO transactionlist VALUES ('$id','$payment','$paymentDate1','$paymentDate2','$cardNumber','$cardtype','$paid','$remainingBalance')";
    $result = $db->query($query3);
   if ($result)
   {
      echo 'success2'; 
      
    }
    else
    {
    echo 'insert failed';
       die(mysql_error());
    }
    
$query4 = "UPDATE accountinfo SET previousBalance ='$remainingBalance' WHERE userId= '$id'";    
    $result = $db->query($query4);
   if ($result)
   {
      echo 'success3'; 
      
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
echo '<tr><td>Remaining Balance</td><td>$'.$remainingBalance.'</td></tr>';
echo '<tr><td>Next Payment Date</td><td>'.$paymentDate2.'</td></tr>';
echo '</table>';

    echo '<a href="customerPage.php">Go Back to My page</a>';
    echo '</br>';
    echo '<a href="logout.php">Logout</a>'; 
    
}



?>