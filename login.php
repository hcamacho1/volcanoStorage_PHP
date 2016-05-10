<?php

session_start();
$_SESSION['counter'] = 1;
$_SESSION['loggedIn'] = 'False';
$error = "Invalid username or password. Try again";

if (isset($_GET['user']))
{
    $_SESSION['userType'] = $_GET['user'];
    $user = $_SESSION['userType'];
   
    switch($user)
    {
        
     case "customer":
        if (empty($_GET['userName']) || empty($_GET['password']))
            {
             echo $error; 
                break;
				
            }
            else
            {
                
            $res = validateData($_GET['userName'], $_GET['password']);
            
            
				if ($res = 1)
				{
				
				include 'customerPage.php';
				break;
				}
              
            }
		
        
        
     case "manager":
	 if (empty($_GET['userName']) || empty($_GET['password']))
            {
				echo $error; 
                break;
                }
            else
            {
                $userName = $_GET['userName'];
				$password = $_GET['password'];
				if (validateData($userName, $password))
				{
				include 'managerPage.php';
				break;
				}
               
			}
        
        default :
        echo '<p>error</p>';
        break;
    }
    
    
}
else
{
    
 echo '<p>User type not specified</p>'; 
include 'volcanoHome.html';
}

function validateData($uname, $passwd)
	{
    $error = "Invalid username or password. Try again";

    
	include 'connect.php';
		if($_SESSION['userType'] = 'customer')
			{
			
			$query = "Select * from users where userName= '$uname'";
            
			}
		elseif($_SESSION['userType'] = 'manager')
			{
			
			$query = "Select * from manager where userName= '$uname'";
           
			}
		
				
		$result = $db->query($query);
			
		if ($result)
		{
		
			while($row = $result->fetch_object())
			{
	
			$password = $row->password;
                $user = $row->userName;
              $_SESSION['id'] = $row->uid;
			
			}
            if (!empty($password))
                {
			 if ($password == $passwd && $user == $uname)
			         {
                 $_SESSION['validUser'] = $user;
                
			         return True;
			         }
                }
             else
            {
                 echo '<br>';
                echo $error;
                 
            }
		}
    
				
		
			exit;
}




	




?>