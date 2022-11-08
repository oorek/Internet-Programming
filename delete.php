<?php
$servername = "localhost";
$username = "cse20171657";
$password = "asdf1234";
$dbname = "db_cse20171657";

echo "<h2> (Sign Up Delete)  Your Input:</h2>";
echo $_GET["option"]." : ".$_GET["content"]."<p><hr>";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "<p><h2>Delete result</h2>";
$keyword = $_GET["option"];
$comment = $_GET["content"];
if($keyword == "interest"){
    $sql = "SELECT * FROM user WHERE $keyword = '$comment'";
    if ($conn->query($sql) == FALSE){
        echo "Error creating table: " . $conn->error;
    }
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        echo "Record deleted succesfully" . "<br/>";
        while($row = $result->fetch_assoc()){
            $pid = $row['person_id'];
            $sql = "DELETE FROM interest WHERE $keyword = '$comment'";
            if ($conn->query($sql) == FALSE){
                echo "error deleting interest table: " . $conn->error;
            }
            $sql = "DELETE FROM user WHERE id = '$pid'";
            if ($conn->query($sql) == FALSE){
                echo "error deleting user table: " . $conn->error;
            }
        }

    }
    else{
        echo "No search member" . "<br/>";
    }
}
else{
    $sql = "SELECT * FROM user WHERE $keyword = '$comment'";
    if ($conn->query($sql) == FALSE){
        echo "Error finding user table: " . $conn->error;
    }
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        echo "Record deleted successfully" . "<br/>";
        while($row = $result->fetch_assoc()){
            $pid = $row['id'];
            $sql = "SELECT * FROM interest WHERE person_id='$pid'";
            if ($conn->query($sql) == FALSE){
                echo "Error finding interest table: " . $conn->error;
            }
            $Result = $conn->query($sql);
            if($Result->num_rows != 0){
                $sql = "DELETE FROM interest WHERE person_id='$pid'";
                if ($conn->query($sql) == FALSE){
                    echo "Error deleting interest table: " . $conn->error;
                }
                $sql = "DELETE FROM user WHERE id='$pid'";
                if ($conn->query($sql) == FALSE){
                    echo "Error deleting user table: " . $conn->error;
                }
            }
            else{
                $sql = "DELETE FROM user WHERE id='$pid'";
                if ($conn->query($sql) == FALSE){
                    echo "Error deleting user table: " . $conn->error;
                }
            }
        }
    }
    else{
        echo "No search member" . "<br/>";
    }
}

echo "<hr><h2>Table Elements</h2><p>";
$sql = "SELECT * FROM user";
if ($conn->query($sql) == FALSE){
    echo "Error searching user table: " . $conn->error;
}
$result = $conn->query($sql);
while($row = $result->fetch_assoc()){
    echo "id: " . $row['id'] . '<br/>';
    echo "pwd: " . $row['pwd'] . '<br/>';
    echo "email: ". $row['email']. '<br/>';
    echo "addr: " . $row['addr']. '<br/>';
    echo "school: " . $row['school']. '<br/>';
    echo "major: " . $row['major']. '<br/>';
    echo "HP: " . $row['HP']. '<br/>';
}
$conn->close();

?>
<html>
  <input type="button" value="signup page" onClick="location.href='/~cse20171657/signup.html'">
  <input type="button" value="serach page" onClick="location.href='/~cse20171657/search.html'">
  <input type="button" value="delete page" onClick="location.href='/~cse20171657/delete.html'">
<input type="button" value="file upload page" onClick="location.href='/~cse20171657/file_upload.html'">
</html>