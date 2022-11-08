<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$ftmp = $_FILES['fileToUpload']['tmp_name'];
$uploadOk = 1;
$servername = "localhost";
$username = "cse20171657";
$password = "asdf1234";
$dbname = "db_cse20171657";

// Check if file already exists
if (file_exists($target_file)) {
    echo "<h2>Sorry, file already exists.</h2>><br>";
    $uploadOk = 0;
  };
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) { 
  die("Connection failed: " . $conn->connect_error);
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<h2>Sorry, your file was not uploaded</h2>";
  // if everything is ok, try to upload file
  } else {
    $chk = move_uploaded_file($ftmp, $target_file);
    $xml=simplexml_load_file("uploads/".$_FILES["fileToUpload"]["name"]) or die("Error: Cannot create object");
    echo "<hr>";
    echo "<h1> Sign Up(xml file load) </h1>" ;
    echo "<hr>";
    foreach($xml->children() as $school) {
        echo "ID : ".$school->id . "<br> ";
        echo "Password : ".$school->password . "<br> ";
        echo "E-Mail : ".$school->email . "<br> ";
        echo "Home address : ".$school->address . "<br> ";
        echo "Phone Number : ".$school->phone . "<br> ";
        echo "School : ".$school->schoolname . "<br> ";
        echo "Major : ".$school->major . "<br> ";
        echo "Interests : ".$school->interests . "<br><p> ";

        $uid = $school->id;
        $sql = "SELECT 1 FROM user WHERE id='$uid' LIMIT 1";
        $result = $conn->query($sql);
        if($result->num_rows == 0){
            $sql = "INSERT INTO user
            VALUES(
                '{$school->id}',
                '{$school->password}',
                '{$school->email}',
                '{$school->address}',
                '{$school->schoolname}',
                '{$school->major}',
                '{$school->phone}'
            )";
            if ($conn->query($sql) == FALSE){
                echo "Error inserting table: " . $conn->error;
            }


            $tmp = trim($school->interests);
            $tf_table = array(
                'CS'=>false,
                'ELEC'=>false,
                'CB'=>false,
                'MECH'=>false,
                'EL'=>false,
            );
            
            $token = strtok($tmp, ",");
            $len=0;
            while($token !== false){
                //echo "$token<br>";
                $token = trim($token);
                switch($token){
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
                        echo $token;
                    }
                $len++;
                $token = strtok(",");
            }
            $sql = "INSERT INTO interest
                VALUES(
                '{$len}',
                '{$school->id}',
                '{$tf_table['CS']}',
                '{$tf_table['ELEC']}', 
                '{$tf_table['CB']}',
                '{$tf_table['MECH']}',
                '{$tf_table['EL']}'
                )";
            if ($conn->query($sql) == FALSE){
                echo "Error inserting table: " . $conn->error;
            }
        }   
    };

        echo "<h2>File & mysql upload</h2><p>";
};
?>
<html>
  <input type="button" value="signup page" onClick="location.href='/~cse20171657/signup.html'">
  <input type="button" value="serach page" onClick="location.href='/~cse20171657/search.html'">
  <input type="button" value="delete page" onClick="location.href='/~cse20171657/delete.html'">
<input type="button" value="file upload page" onClick="location.href='/~cse20171657/file_upload.html'">
</html>