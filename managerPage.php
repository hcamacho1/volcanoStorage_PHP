<html>
 <link rel="stylesheet" type="text/css" href="styleVol.css"/>    
<head class="header">

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
@ session_start();

     $custid;
echo '<div id="custOuterBox">';
echo '<br>';
echo "Manager ". $_SESSION['validUser'];
echo '<br>';
echo '<a href="logout.php">Logout</a>';
include 'connect.php';

//query for account by name search
$query1 = 'SELECT * FROM accountinfo, user_info WHERE  user_info.firstName= $customerName AND user_info.iduserInfo= accountinfo.userId';


//query to populate radio buttons for current customers from database table
$query2 = 'SELECT * FROM user_Info';
$result = $db->query($query2);
if ($result)
{
    echo '<form action="managerPage.php" method="post">';
    echo '<table id="currCust">';
    echo '<thead><td><h2>Manage Current Customers</h2></td></thead>';
    while($row = $result->fetch_object())
    {
        $_SESSION['custId'] = $row->iduserInfo;
       $name = $row->firstName;
        //radio buttons populated from database table
        echo '<tr>';
        echo '<td><p><input type="radio" name="customers[]" value='.$row->firstName.'>'.$row->firstName.'</p></td>';
        echo '</tr>';
        }
    echo '<tr>';
        echo '<td><select name="custOption">';
        echo '<option value="" disabled="disabled" selected="selected">Please select action for customer</option>';
        echo '<option value="transactionHist">Transaction History</option>';
        echo '<option value="personalInfo">Personal Info</option>';
        echo '<option value="accountInfo">Account Info</option>';
        echo '<option value="unitInfo">Units Rented</option>';
        echo '</select></td>';
        echo '</tr>';
    echo '<tfoot><td><input type="submit" name="Submit"></td></tfoot>';
    echo '</table>';
    echo '</form>';
}
else
{
    die(mysql_error());
}

echo '<form action="addnewuser.php" method="post">';
echo '<table id="newUser">';
echo '<thead><td colspan="4" align="center"><h2>Add New Customer</h2></td></thead>';
echo '<tr>';
echo '<td>First Name</td><td><input type="text" name="fname"></td><td>Last Name</td><td><input type="text" name="lname"></td>';
echo '</tr>';
echo '<tr><td>Address</td><td colspan="3"><input type="address" name="address" size="66"></td></tr>';
echo '<tr>';
echo '<td>City</td><td><input type="text" name="city"></td><td>State</td><td><input type="text" name="state"></td>';
echo '</tr>';
echo '<tr>';
echo '<td>Zip Code</td><td><input type="text" name="zip"></td><td>Phone #</td><td><input type="text" name="phone"></td>';
echo '</tr>';
echo '<tr>';
echo '<td>Email Address</td><td><input type="text" name="email"></td><td># of Units required</td><td><input type="text" name="units"></td>';
echo '</tr>';
echo '<tr>';
echo '<td>User Name</td><td><input type="text" name="userName"></td><td>Password</td><td><input type="text" name="password"></td>';
echo '</tr>';
echo '<tfoot><td><input type="submit" name="submit"></td><td><input type="reset" value="Reset"></td></tfoot>';
echo '</table>';
echo'</form>';



if (isset($_POST['custOption']))
    {
    echo 'Tranaction List';
     $option = $_POST['custOption'];
   $customers = $_POST['customers'];
     $custid;
    
    foreach ($customers as $customer)
    {
   
         $query = 'SELECT * FROM user_info WHERE firstName= "'.$customer.'"';
            $result = $db->query($query);
    
        //get customer id by comparing post variable for customer first name
            if ($result)
            {
                while($row = $result->fetch_object())
                {
                      $custid = $row->iduserInfo;
                  
                }
            }
        else
        {
            echo 'nope';
        }
        
        
    }
    
    
        echo '<table class="resTable" border="solid" >';
        switch($option)
        {
            case 'transactionHist':
                    $query = 'SELECT user_info.firstName, user_info.lastName, transactionlist.amountPaid, transactionlist.lastPayment, transactionlist.nextPayment FROM user_info,transactionlist  WHERE uid= '.$custid.' AND iduserInfo= '.$custid.'';
                    $result = $db->query($query);
            
                //customer transaction table for selected customer            
                  
                   
                    echo '<thead><td colspan="5" align="center"><h2>Customer Transaction List</h2></td></thead>';
                    echo '<tr><td>First Name</td><td>Last Name</td><td>Amount Paid</td><td>Last Payment Date</td><td>Next Payment Date</td></tr>';
                if ($result)
                {
                while($row = $result->fetch_object())
                    { 
                    echo '<tr>';
                    echo '<td>'.$row->firstName.'</td>';
                    echo '<td>'.$row->lastName.'</td>';
                    echo '<td>'.$row->amountPaid.'</td>';
                    echo '<td>'.$row->lastPayment.'</td>';
                    echo '<td>'.$row->nextPayment.'</td>';
                    echo '</tr>';
                    }
                }
                    echo '</table>';
         
            
                
                        break;            
            
            case "personalInfo":
            
            
           
                        $query = 'SELECT * FROM user_info WHERE iduserInfo= '.$custid.'';
                        $result = $db->query($query);
            
            
           // echo '<table class="resTable" border="solid" >';
            echo '<thead><td colspan="7" align="center"><h2>Customer Information</h2></td></thead>';
            echo '<tr><td>First Name</td><td>Last Name</td><td>City</td><td>State</td><td>Zip</td><td>Phone #</td><td>Email</td></tr>';
                    if ($result)
                    {
                     while($row = $result->fetch_object())
                     {
                        echo '<tr>';
                        echo '<td>'.$row->firstName.'</td>';
                        echo '<td>'.$row->lastName.'</td>';
                        echo '<td>'.$row->city.'</td>';
                        echo '<td>'.$row->state.'</td>';
                        echo '<td>'.$row->zip.'</td>';
                        echo '<td>'.$row->phoneNumber.'</td>';
                        echo '<td>'.$row->email.'</td>';
                        echo '</tr>';
                         
                    }
                }
                    echo '</table>';
            
                break;
            
            case "accountInfo":
                
                        $query = 'SELECT user_info.firstName, user_info.lastName, accountinfo.startDate, accountinfo.monthlyPayment, accountinfo.lastPaymentDate, accountinfo.nextPaymentDate, accountinfo.numberOfStorageUnits, accountinfo.previousBalance FROM user_info, accountinfo WHERE idaccountInfo= '.$custid.' AND iduserInfo= '.$custid.'';
                        $result = $db->query($query);
                    echo '<thead><td colspan="8" align="center"><h2>Customer Account Information</h2></td></thead>';
                    echo '<tr><td>First Name</td><td>Last Name</td><td>Start Date</td><td>Monthly Payment</td><td>Last Payment Date</td><td>Next Payment Date</td><td># of Storage Units</td><td>Previous Balance</td></tr>';
            
                    if ($result)
                    {
                        while($row = $result->fetch_object())
                        {
                        echo '<tr>';
                        echo '<td>'.$row->firstName.'</td>';
                        echo '<td>'.$row->lastName.'</td>';
                        echo '<td>'.$row->startDate.'</td>';
                        echo '<td>'.$row->monthlyPayment.'</td>';
                        echo '<td>'.$row->lastPaymentDate.'</td>';
                        echo '<td>'.$row->nextPaymentDate.'</td>';
                        echo '<td>'.$row->numberOfStorageUnits.'</td>';
                        echo '<td>'.$row->previousBalance.'</td>';
                        echo '</tr>';
                        }
                    }
             echo '</table>';
            $db->close();
                    break;
            
            case "unitInfo":
            
                    $query = 'SELECT user_info.firstName, user_Info.lastName, storageunits.custId, storageunits.unitNumber, storageunits.unitCost, storageunits.unitSize FROM storageunits, user_info WHERE iduserInfo= '.$custid.'';
            echo '<thead><td colspan="5" align="center"><h2>Units Rented</h2></td></thead>';
            echo '<tr><td>First Name</td><td>Last Name</td><td>Unit #</td><td>Price</td><td>Size</td></tr>';
                $result = $db->query($query);
                if ($result)
                {
                 while($row = $result->fetch_object())
                 {
                     $cId = $row->custId;
                     if ($cId == $custid)
                     {
                    echo '<tr>';
                    echo '<td>'.$row->firstName.'</td>';
                    echo '<td>'.$row->lastName.'</td>';
                    echo '<td>'.$row->unitNumber.'</td>';
                    echo '<td>'.$row->unitCost.'</td>';
                    echo '<td>'.$row->unitSize.'</td>';
                    echo '</tr>';
                     }
                     
                 }
                }
             echo '</table>';
                        break;
            
            case "default":
                        break;
            
        }
        
    }


echo '</div>';
?>
    </body>
</html>