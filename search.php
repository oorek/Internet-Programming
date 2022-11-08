
<?php
$servername = "localhost";
$username = "cse20171657";
$password = "asdf1234";
$dbname = "db_cse20171657";

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
    die("connection failed: " . $conn->connect_error);
}
$keyword = $_GET["option"];
$comment = $_GET["content"];

function output($sql, $conn){
    $result = $conn->query($sql);
    if ($conn->query($sql) == FALSE){
        echo "Error searching table: " . $conn->error;
    }
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo "<br>" . " Interest: " . "<br/>";
            if($row['CS'] == true){
                echo "Computer Science ";
            }
            if($row['ELEC'] == true){
                echo "Electronic ";
            }
            if($row['CB'] == true){
                echo "Chemical and Biomolecular ";
            }
            if($row['EL'] == true){
                echo "Else ";
            }
            echo "<br/>";
            $pid = $row['person_id'];
            $sql = "SELECT * from user WHERE id='$pid'";
            $Result = $conn->query($sql);
            if ($conn->query($sql) == FALSE){
                echo "Error searching table: " . $conn->error;
            }
            if($Result->num_rows > 0){ // 어차피 한개긴해
                while($row = $Result->fetch_assoc()){
                    echo "id: " . $row['id'] . '<br/>';
                    echo "pwd: " . $row['pwd'] . '<br/>';
                    echo "email: ". $row['email']. '<br/>';
                    echo "addr: " . $row['addr']. '<br/>';
                    echo "school: " . $row['school']. '<br/>';
                    echo "major: " . $row['major']. '<br/>';
                    echo "HP: " . $row['HP']. '<br/>';
                }
            }
        }
    }
    else{
        echo "0";
    }
}
if($keyword == "interest"){
    switch($comment){
        case "Computer Science":
            $sql = "SELECT * from interest WHERE CS=1";
            output($sql, $conn);
            break;
        case "Electronic":
            $sql = "SELECT * from interest WHERE ELEC=1";
            output($sql, $conn);
            break;
        case "Chemical and Biomolecular":
            $sql = "SELECT * from interest WHERE CB=1";
            output($sql, $conn);
            break;
        case "Mechanical":
            $sql = "SELECT * from interest WHERE MECH=1";
            output($sql, $conn);
            break;
        case "Else":
            $sql = "SELECT * from interest WHERE EL=1";
            output($sql, $conn);
            break;
        default:
            echo "Cannot find";
    }
}
else {
    $sql = "SELECT * FROM user WHERE $keyword = '$comment'";
    if ($conn->query($sql) == FALSE){
        echo "Error creating table: " . $conn->error;
    }
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $var = $row['id'];
            echo "id: " . $row['id'] . '<br/>';
            echo "pwd: " . $row['pwd'] . '<br/>';
            echo "email: ". $row['email']. '<br/>';
            echo "addr: " . $row['addr']. '<br/>';
            echo "school: " . $row['school']. '<br/>';
            echo "major: " . $row['major']. '<br/>';
            echo "HP: " . $row['HP']. '<br/>';
        }
        $sql = "SELECT * FROM interest WHERE person_id='$var'";
        if ($conn->query($sql) == FALSE){
            echo "Error creating table: " . $conn->error;
        }
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo "interest: ";
                if($row['CS'] == true){
                    echo "Computer Science ";
                }
                if($row['ELEC'] == true){
                    echo "Electronic ";
                }
                if($row['CB'] == true){
                    echo "Chemical and Biomolecular ";
                }
                if($row['MECH'] == true){
                    echo "Mechanical ";
                }
                if($row['EL'] == true){
                    echo "Else ";
                }
                if($row['GAME'] == true){
                    echo "Game Develop ";
                }
                if($row['SECUR'] == true){
                    echo "Security ";
                }
                if($row['NET'] == true){
                    echo "Network ";
                }

            }
        }
        else {
            echo "interest: 0 results";
        }
    }
    else {
        echo "0 results";
    }
}
$conn->close();
echo "<br>" . "<br>";
?>
<html>
  <input type="button" value="signup page" onClick="location.href='/~cse20171657/signup.html'">
  <input type="button" value="serach page" onClick="location.href='/~cse20171657/search.html'">
  <input type="button" value="delete page" onClick="location.href='/~cse20171657/delete.html'">
<input type="button" value="file upload page" onClick="location.href='/~cse20171657/file_upload.html'">
</html>