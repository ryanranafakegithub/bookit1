<html>
    <head>
    <title>Buy a Book</title>
    <link rel="icon" href="pic.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <button onclick="back()" >Back</button>
    <form  id="form"  method="POST" enctype="multipart/form-data">
        <input type="number" id="isbn" placeholder="search for an isbn" required name="isbn" /><br>
        <input  name="buy_submit" id="buy_submit" type="submit" value="Submit">
    </form>
   
    <p style="display:none" id="table_instructions">As soon as you click on one of the buttons, an email promt would open up and you can contact that paticular email.</p>
    <table id="results" style="display:none">
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Rating</th>
            <th>Send</th>
        </tr>
    </table>
<script>
function back(){
var yo = "<?php echo $_GET['id'];?>"
yo = "home.php?id="+yo
window.location.replace(yo);
}
</script>
	<?php
        //Similar to an Onclick Function
        if (isset($_POST["buy_submit"])){
            // Querys the db and sql insert line; If it works then it moves to the next page.
            //Retrives form info by name of isbn input
            //Connection to Database
            $db = new mysqli('localhost', 'root', '', 'book');
            $isbn = $_POST["isbn"];
            $id = $_GET["id"];
    
            $user_check_query = "SELECT * FROM users WHERE random='$id' LIMIT 1";
            $result = mysqli_query($db, $user_check_query);
            $user = mysqli_fetch_assoc($result);
            $name=$user["name"];
            $email = $user["email"];
            
            $userr = "SELECT * FROM books WHERE name='$name' AND isbn='$isbn' AND bought!='no' LIMIT 1";
            $db = mysqli_connect('localhost', 'root', '', 'book');
            $result = mysqli_query($db, $userr);
            $user = mysqli_fetch_assoc($result);
            if ($user){
                echo null;
            }
            else{
                $sql = "INSERT INTO books (name,email,isbn,price,rating,bought) VALUES ('$name','$email','$isbn',0,0,'bn')";
                
                
                if ($db->query($sql) === TRUE) {

                    echo "";
                   
                }else {
                    echo "Error: " . $sql . "<br>" . $db->error;
                  }
              }
           
            //Select everything from database where the isbn numbers match input
            $sql = "SELECT name, price, rating,email FROM books WHERE isbn='$isbn' AND bought='sn' ";
            $result = $db->query($sql);
            //Takes all the information and puts into a visual table.
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $email = $row["name"];
                    $price = $row["price"];
                    $rating = $row["rating"];
                    $name = $row["email"];

            $mailto= "mailto:$name";
        
                    echo "<script>var table = document.getElementById('results');table.style.display='block';document.getElementById('table_instructions').style.display='block';var row = table.insertRow(1);var cell1 = row.insertCell(0);var cell2 = row.insertCell(1);var cell3 = row.insertCell(2);var cell4 = row.insertCell(3);cell1.innerHTML = '$email';cell2.innerHTML = '$price';cell3.innerHTML = '$rating';cell4.innerHTML = '<p><a href=$mailto >Contact</a></p>';</script>";
                    
                    
                }
            }
            else{
                echo "<p>No results are currently here. Check back soon. </p>";
            }
        
       
        }
    ?>
	

</html>
