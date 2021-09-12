<html>
    <head>
    <link rel="icon" href="pic.png">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <button onclick="window.location.href='index.php';" >Logout</button>
    <button onclick="buy()" >Buy</button>
<button onclick="sell()" >Sell</button>

<br>
<br><br>
<script>

    function buy(){
    var yo = "<?php echo $_GET['id'];?>"
    yo = "home_buy.php?id="+yo
    window.location.replace(yo);
    }
    function sell(){
    var yo = "<?php echo $_GET['id'];?>"
    yo = "home_sell.php?id="+yo
    window.location.replace(yo);
    }



</script>
	<?php
        

        $id = $_GET["id"];
        $count = 0;
        $db = new mysqli('localhost', 'root', '', 'book');
        $user_check_query = "SELECT * FROM users WHERE random='$id' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);
        $email = $user["email"];
        echo "<h3><b>Books you bought</b></h3>";

        $sql = "SELECT * FROM books WHERE email='$email' AND bought='by' ";
        $result = $db->query($sql);
        //Takes all the information and puts into a visual table.
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $isbn = $row["isbn"];
                $bn = "by";
                echo "<p id='$count' >$isbn</p>";
                echo "<a href='update_no.php?isbn=$isbn&email=$email&bought=$bn&id=$id'>Remove</a>";
                $count = $count + 1;
            }
        }
        else{
            echo "<p>Nothing is here.</p>";
        }
        echo "<br>";
        
        echo "<h3><b>Books you are buying (Cancel if you already bought it)</b></h3>";

        $sql = "SELECT * FROM books WHERE email='$email' AND bought='bn' ";
        $result = $db->query($sql);
        //Takes all the information and puts into a visual table.
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
               
                $isbn = $row["isbn"];
                $bn = "bn";
                echo "<p id='$count' >$isbn</p>";
                echo "<a href='update_bn.php?isbn=$isbn&email=$email&bought=$bn&id=$id'>Cancel</a>";
                $results_available = "SELECT * FROM books WHERE isbn='$isbn' AND bought='sn' LIMIT 1 ";
                $db = mysqli_connect('localhost', 'root', '', 'book');
                $results_available_query = mysqli_query($db, $results_available);
                $user = mysqli_fetch_assoc($results_available_query);
                if ($user){
                    echo "<p>Results available</p>";
                }

                $count = $count + 1;
                
            }
        }
        else{
            echo "<p>Nothing is here.</p>";
        }
        echo "<br>";
        
        
        
        echo "<h3><b>Books you are selling (Cancel if you already sold it)</b></h3>";

        $sql = "SELECT * FROM books WHERE email='$email' AND bought='sn' ";
        $result = $db->query($sql);
        //Takes all the information and puts into a visual table.
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $isbn = $row["isbn"];
                $bn = "sn";
                echo "<p id='$count' >$isbn</p>";
                echo "<a href='update_sn.php?isbn=$isbn&email=$email&bought=$bn&id=$id'>Cancel</a>";
                $count = $count + 1;
                
            }
        }
        else{
            echo "<p>Nothing is here.</p>";
        }
        echo "<br>";
        
        echo "<h3><b>Books you sold</b></h3>";

        $sql = "SELECT * FROM books WHERE email='$email' AND bought='sy' ";
        $result = $db->query($sql);
        //Takes all the information and puts into a visual table.
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $isbn = $row["isbn"];
                $bn = "sy";
                echo "<p id='$count' >$isbn</p>";
                echo "<a href='update_no.php?isbn=$isbn&email=$email&bought=$bn&id=$id'>Remove</a>";
                $count = $count + 1;
            }
        }
        else{
            echo "<p>Nothing is here.</p>";
        }
        echo "<br>";
        
        
    ?>
	

</html>
