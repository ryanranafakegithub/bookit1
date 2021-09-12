<html>
    <title>Login</title>
    <link rel="icon" href="pic.png">
<button onclick="window.location.href='index.php';" >Back</button>
    <form  id="form"  method="POST" enctype="multipart/form-data">
        <input type="text" id="name" placeholder="enter an name" required name="name" /><br>
        <input type="email" id="email" placeholder="enter an email" required name="email" /><br>
        <input type="password" id="password" placeholder="password" required name="password" /><br>
        <input  name="login" id="login" type="submit" value="Submit">
    </form>
    <?php
        //Similar to an Onclick Function
        if (isset($_POST["login"])){
            //Retrieves Form Data by name
            $name = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            //Creating a Random ID
            $character= "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $charactersLength = strlen($character);
            $random = '';
            for ($i = 0; $i < 100; $i++) {
                $random .= $character[rand(0, $charactersLength - 1)];
            }
        
            //Database connection
            $db = new mysqli('localhost', 'root', '', 'book');
            //Check if user exists
            $user_check_query = "SELECT * FROM users WHERE email='$email' AND name='$name' AND password='$password'LIMIT 1";
            $result = mysqli_query($db, $user_check_query);
            $user = mysqli_fetch_assoc($result);
            
            //If it doesn't just move to next page
            if ($user) { // if id exists
        
                $id = $user["random"];
                $_SESSION["id"] = $id;
                header('Location: home.php?id='.$id);
                
            }
            else{
                $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
                $result = mysqli_query($db, $user_check_query);
                $user = mysqli_fetch_assoc($result);
                if ($user) { // if id exists
                    echo "Email is already is in use.";
                }
                else{
                $sql = "INSERT INTO users (name,email,password,random) VALUES ('$name','$email','$password','$random')";
                // Querys the db and sql insert line; If it works then it moves to the next page.
                if ($db->query($sql) === TRUE) {
               
                    $id = $random;
                    $_SESSION["id"] = $id;
                    header('Location: home.php?id='.$id);
                    
                }else {
                    echo "Error: " . $sql . "<br>" . $db->error;
                  }
                    }
            }
        }
    ?>
</html>
