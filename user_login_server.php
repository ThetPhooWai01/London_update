<?php


$name = $_POST['name'];
$password_input = $_POST['password'];



include 'database.php';
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("ERROR: Could not connect. " . $conn->connect_error);
}


    // Start or resume the session
    session_start();

    // Check if the browser ID is already stored in the session
    if (isset($_SESSION['browser_id'])) {
        $browserId = $_SESSION['browser_id'];
    } else {
        // Generate a new browser ID
        $browserId = generateUniqueBrowserId();

        // Store the browser ID in the session for future use
        $_SESSION['browser_id'] = $browserId;
    }

    echo "Browser ID: " . $browserId;
    $b_id = $browserId;

    $sql = "SELECT * FROM user_database WHERE user_name='$name'";
    $result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $user_name = $row['user_name'];
        $_password = $row['password'];
        echo $user_name;
        echo $_password;
        echo $name;
        echo $password_input;


        if ($user_name == $name && $_password == $password_input) {
            echo('Login');

            // Check Brower ID exist or not
            $sql = "SELECT * FROM user_database WHERE browser_id='$b_id'";
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<script>alert("Login Success") ;</script>';
                    echo '<script>window.location = "index.php";</script>'; //If Exit
                }
            } else {//If Not
                $sql = "UPDATE user_database SET browser_id='$b_id' WHERE user_name='$name'"; //update Brower ID
                $insertResult = $conn->query($sql);
                if ($insertResult) {
                    echo 'Update Success Browser ID';
                    echo '<script>alert("Login Success") ;</script>';
                    echo '<script>window.location = "index.php";</script>';

                } else {
                    //echo '<script>window.location = "user_login.php";</script>';
                }

            }

        } else {
            echo '<script>alert("Try Again") ;</script>';
            echo '<script>window.location = "user_login.php";</script>';
        }
        echo '<script>alert("user_name Already exist! \nPlease Try another Name") ;</script>';
        echo '<script>window.location = "sign_up_form.html";</script>';
    }
}

    else {
        echo '<script>alert("Wrong Password Or User Name!") ;</script>';
        echo '<script>window.location = "user_login.php";</script>';
    }



    //insert Data into userDB
    

    $conn->close();


function generateUniqueBrowserId()
{
    $randomString = bin2hex(random_bytes(16));
    $timestamp = time();

    return $randomString . $timestamp;
}
?>
