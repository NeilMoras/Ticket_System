<?php
//LOAD THE USER XML FILE
$userInfo = simplexml_load_file("xml/user.xml");
//INITIALIZE THE VARIABLES
$username="";
$accountType = "";
$userId = "";
$xmlUsername = "";
$xmlPassword = "";
//var_dump($_POST);
//IF USER SUBMITS THE LOGIN INFO, IT WILL LOOP THROUGH THE XML FILE,COMPARETHE USER INPUR INFORMATION WITH THE XML INFORMATION AND REDIRECT THE USER TO THEIR RESPECTIVE PAGE ON SUCCSS
if(isset($_POST["submitLogin"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $invalidLoginMsg = "";
    foreach ($userInfo->children() as $user) {
        $xmlUsername = $user->username;
        $xmlPassword = $user->password;
        $userId = $user->id;
        $accountType = (string)$user[0]['accountType'];
        //IF VERIFIED REDIRECT STORE THE INFOR IN SESSION VARIBALES AND REDIRECT TO TTHE RESPECTIVE PAGE
      if($username == $xmlUsername && password_verify($password,$xmlPassword) == true ){
            session_start();
            echo "success";
            $_SESSION['userid'] = (string)$userId;
            $_SESSION['username'] = (string)$username;
            $_SESSION['accountType'] = $accountType;
             echo $_SESSION['userid'] ;

          if(($accountType == "admin")){
                header("Location: ./admin-page.php");
            }elseif (($accountType == "client")){
                header("Location: ./user-page.php");
            }
            //IF INVALID INPUT OR NOT MATCHING USERNAME AND PASSWORD , DISPLAY AN ERROR ON THE PAGE
        }elseif ($username !== $xmlUsername && password_verify($password,$xmlPassword) == true  || $username == $xmlUsername && password_verify($password,$xmlPassword) !== true){
          $invalidLoginMsg = "username and password don't match";
        }
    }
}



$userInfo = simplexml_load_file("xml/user.xml");


var_dump($_POST);
if(isset($_POST["submitSignUp"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $staffNumber = $_POST["staffNumber"];


    if (empty($username) || empty($email) || empty($password)) {
        echo "all fields required";
        return false;
    } else {

        $user = $userInfo->addChild('user');

        if (!empty($_POST['staffNumber'])) {
            $user->addAttribute('accountType', 'admin');
        } else {
            $user->addAttribute('accountType', 'client');
        }

        $user->addChild('id', rand(5, 100));
        $user->addChild('username', $username);
        if (!empty($_POST['staffNumber'])) {
            $user->addChild('staffId', $staffNumber);
        }

        $user->addChild('email', $email);
        $user->addChild('password', $password);


        $userInfo->asXML("xml/user.xml");
        header("Location: ./login.php");
    }
}
