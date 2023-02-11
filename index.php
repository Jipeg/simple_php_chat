<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="fav.png"/>
    <link rel="stylesheet" href="style.css">
    <title>Chat - Customer Module</title>
</head>

<body>

<?php
    
    error_reporting(E_ALL);
    session_start();
?>

<?php
    // error_reporting(E_ERROR | E_PARSE);
    if(isset($_POST['enter'])){
        if($_POST['name'] != ""){
            $_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));
        }
        else{
            echo '<span class="error">Please type in a name</span>';
        }
    }

    if(isset($_POST['newmsg'])) {
        $fp = fopen("log.html", 'a');
        if ($_SESSION['name'] != "") {
            fwrite($fp, "<div class='msgln'><i>". $_SESSION['name'] .": </i>". $_POST['newmsg'] . "<br></div>\n");
        }
        fclose($fp);
        
    }

    if(isset($_GET['logout'])){	
        //Simple exit message
        $fp = fopen("log.html", 'a');
        if ($_SESSION['name'] != "") {
            fwrite($fp, "<div class='msgln'><i>User ". $_SESSION['name'] ." has left the chat session.</i><br></div>\n");
        }
        fclose($fp);
        //echo '<script>alert("' . $fp . '--- file")</script>';
        //header('Refresh: 1; URL=index.php');
        header("Location: index.php"); //Redirect the user
        session_destroy();
    }

    if(!isset($_SESSION['name'])){
        include("./loginForm.html");
    }
    else{
        include("./main.html");
    }
?>
</body>

</html>