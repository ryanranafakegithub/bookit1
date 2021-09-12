
    <?php
        $id = $_GET['id'];
        $isbn = $_GET['isbn'];
        $email = $_GET['email'];
        $bought = $_GET['bought'];
        $conn = mysqli_connect("localhost", "root", "", "book");
        $sql = "SELECT FROM books WHERE isbn= '$isbn' AND email='$email' AND bought='$bought'";
        $sql = "UPDATE books SET bought='sy' WHERE isbn= '$isbn' AND email='$email' AND bought='$bought'";
  
        if ($conn->query($sql) === TRUE) {
          $URL="home.php?id=$id";
                echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
                echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
                exit();
        } else {
          echo "Error updating record: " . $conn->error;
        }
    ?>

