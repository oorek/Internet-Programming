<?php
$servername = "localhost";
$username = "cse20171657";
$password = "asdf1234";
$dbname = "db_cse20171657";

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
    die("connection failed: " . $conn->connect_error);
}
$sql = "CREATE TABLE if not exists user(
    id VARCHAR(30) NOT NULL UNIQUE PRIMARY KEY,
    pwd VARCHAR(15) NOT NULL,
    email VARCHAR(30),
    addr VARCHAR(30),
    school VARCHAR(30),
    major VARCHAR(30),
    HP VARCHAR(15)
)";

if ($conn->query($sql) == FALSE){
    echo "Error creating table: " . $conn->error;
}
$uid = $_GET['id'];
$sql = "SELECT 1 FROM user WHERE id='$uid' LIMIT 1";
$result = $conn->query($sql);

if($result->num_rows == 0){
    $filtered = array(
        'id'=>mysqli_real_escape_string($conn, $_GET["id"]),
        'pwd'=>mysqli_real_escape_string($conn, $_GET["pwd"]),
        'email'=>mysqli_real_escape_string($conn, $_GET["email"]),
        'addr'=>mysqli_real_escape_string($conn, $_GET["addr"]),
        'school'=>mysqli_real_escape_string($conn, $_GET["school"]),
        'major'=>mysqli_real_escape_string($conn, $_GET["major"]),
        'HP'=>mysqli_real_escape_string($conn, $_GET["HP"])
    );

    $sql = "INSERT INTO user
        (id, pwd, email, addr, school, major, HP)
        VALUES(
        '{$filtered['id']}',
        '{$filtered['pwd']}',
        '{$filtered['email']}',
        '{$filtered['addr']}',
        '{$filtered['school']}',
        '{$filtered['major']}',
        '{$filtered['HP']}'
        )
    ";

    if ($conn->query($sql) == FALSE){
        echo "Error inserting table: " . $conn->error;
    }
    if(!empty($_GET['interest'])) {
        $table = $_GET['interest'];
        $tf_table = array(
            'CS'=>false,
            'ELEC'=>false,
            'CB'=>false,
            'MECH'=>false,
            'EL'=>false,
        );
        $len = count($table);
        foreach($table as $key => $value){
            switch($value){
                case "Computer Science":
                    $tf_table['CS']=true;
                    break;
                case "Electronic":
                    $tf_table['ELEC']=true;
                    break;
                case "Chemical and Biomolecular":
                    $tf_table['CB']=true;
                    break;
                case "Mechanical":
                    $tf_table['MECH']=true;
                    break;
                case "Else":
                    $tf_table['EL']=true;
                    break;
                default:
                    echo "?";
            }
        }
        $sql = "CREATE TABLE if not exists interest(
            num INT(1) ,
            person_id VARCHAR(30),
            CS CHAR(1),
            ELEC CHAR(1),
            CB CHAR(1),
            MECH CHAR(1),
            EL CHAR(1),
            FOREIGN KEY (person_id) REFERENCES user (id)
        )";

        if ($conn->query($sql) == FALSE){
            echo "Error creating table: " . $conn->error;
        }
        $sql = "INSERT INTO interest
            VALUES(
            '{$len}',
            '{$uid}',
            '{$tf_table['CS']}',
            '{$tf_table['ELEC']}', 
            '{$tf_table['CB']}',
            '{$tf_table['MECH']}',
            '{$tf_table['EL']}'
            )";
        if ($conn->query($sql) == FALSE){
            echo "Error creating table: " . $conn->error;
        }
    }

    $conn->close();
}
echo "<h2> Query Result </h2>";
echo "ID : " ;
echo $_GET['id'];
echo "<br>";
echo "Password : " ;
echo $_GET["pwd"] ;
echo "<br>";
echo "Email : "  ;
echo $_GET["email"];
echo "<br>";
echo "Address : ";
echo $_GET["addr"];
echo "<br>";
echo "School : " ;
echo $_GET["school"];
echo "<br>";
echo "Major : " ;
echo $_GET["major"];
echo "<br>";
echo "HP : " ;
echo $_GET["HP"];
echo "<br>";

if(!empty($_GET['interest'])) {
    echo "Interest list : <br/>";
    foreach($_GET['interest'] as $value){
        echo $value.'<br/>';
    }

}
else{
    echo "No Interest ..  ";
}
echo "<br>";
?>

<html>
  <input type="button" value="signup page" onClick="location.href='/~cse20171657/signup.html'">
  <input type="button" value="serach page" onClick="location.href='/~cse20171657/search.html'">
  <input type="button" value="delete page" onClick="location.href='/~cse20171657/delete.html'">
<input type="button" value="file upload page" onClick="location.href='/~cse20171657/file_upload.html'">
</html>