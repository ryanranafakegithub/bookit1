<html>
<link rel="icon" href="pic.png">
	<title>Sell a Book</title>
<button onclick="back()" >Back</button>
    <form  id="form"  method="POST" enctype="multipart/form-data">
        <input type="number" id="isbn" placeholder="input an isbn" required name="isbn" /><br>
        <input type="number" id="price" placeholder="input a starting price" required name="price" /><br>
        <input type="range" min="1" max="10" value="5" class="slider" required name="rating" id="rating">
        <p>Quility Rating: <span id="number_rating"></span></p>
        <input  name="sell_submit" id="sell_submit" type="submit" value="Submit">
    </form>
    <script>
    // Lines 14-17: This is responsible for changing the value of the rating as the slider moves.
    var slider = document.getElementById("rating");
    var output = document.getElementById("number_rating");
    output.innerHTML = slider.value+"/10";
    slider.oninput = function() {output.innerHTML = this.value+"/10";}
    </script>
<script>
function back(){
var yo = "<?php echo $_GET['id'];?>"
yo = "home.php?id="+yo
window.location.replace(yo);
}
</script>
	<?php
        //Similar to an Onclick Function
    
        if (isset($_POST["sell_submit"])){
            //Retrieves Form Data by name
            $isbn = $_POST["isbn"];
            $price = $_POST["price"];
            $rating = $_POST["rating"];
            //Database connection
            $db = new mysqli('localhost', 'root', '', 'book');
            $id = $_GET["id"];
            echo $id;
            $user_check_query = "SELECT * FROM users WHERE random='$id' LIMIT 1";
            $result = mysqli_query($db, $user_check_query);
            $user = mysqli_fetch_assoc($result);
            $name=$user["name"];
            echo $name;
            $email = $user["email"];
            
            //Insert to Database Line
            $sql = "INSERT INTO books (name,email,isbn,price,rating,bought) VALUES ('$name','$email','$isbn','$price','$rating','sn')";
            // Querys the db and sql insert line; If it works then it moves to the next page.
            if ($db->query($sql) === TRUE) {
                echo "<script>alert('Your book $isbn is now online and can be viewed on BookIT. You will recive an email by a potentional buyer soon. ')</script>";
                $URL="home.php?id=$id";
                echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
                echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
                exit();
            }else {
                echo "Error: " . $sql . "<br>" . $db->error;
              }
		}
    ?>
</html>
