<?php include_once 'header.php';?>



<?php

function showprofiledropdown() // Shows the profile dropdown if user is logged in in header.php
{ 
    echo '<li class="dropbtn">
    <a onclick="dropdownprofile()" href="#"> <img  id="no-width"  src="' . $_SESSION['user_image'] . '"</img> ' . $_SESSION["userUid"] . '  <b><i class="fa fa-caret-down"></i></b></a>
 </li>
 <div id="myDropdown" class="dropdown-content">
    <li>
       <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
    </li>
    <li>
       <a href="./backend/logout.backend.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
    </li>
 </div>';
}

function fetchUserDataProfile() // Fetches the user from the database then shows his info in profile.php 
{ 
    if (isset($_SESSION['userId'])) {

        global $conn, $username, $user__id, $user_firstname, $user_lastname, $user_email, $user_image;

        $user__id = $_SESSION['userId'];

        $profile = "SELECT * FROM users WHERE id = '{$user__id}' ";

        $select_profile = mysqli_query($conn, $profile);

        while ($row = mysqli_fetch_assoc($select_profile)) {

            $username = $row['username'];
            $user_firstname = $row['first_name'];
            $user_lastname = $row['last_name'];
            $user_email = $row['email'];
            $user_image = $row['user_image'];
            $current_password = $row['password'];
            //  $user_role = $row['user_role'];

        }
    }
}

function allowAccessToProfile() // Checks if the user is not logged in and redirects him to login page
{ 

    if (!isset($_SESSION['userId'])) {
        die(header("location: signup.php"));
    }
}

function updateUserDataProfile() // Update the data in profile
{

    if (isset($_POST['update_profile'])) {

        global $conn , $username;

        $user_name = $_POST['user_name'];
        $email = $_POST['user_email'];
        $user_first = $_POST['first_name'];
        $user_last = $_POST['last_name'];
        $current_password = $_POST['current_password'];
        $user_password = $_POST['user_password'];
        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];
        move_uploaded_file($user_image_temp, "styles/img/profile_pictures/$user_image");

        // Security
        $username_filter = mysqli_real_escape_string($conn, $_POST["user_name"]);
        $password = mysqli_real_escape_string($conn, $_POST["user_password"]);
        $email_filter = mysqli_real_escape_string($conn, $_POST["user_email"]);
        $first_fitler = mysqli_real_escape_string($conn, $_POST["first_name"]);
        $last_filter = mysqli_real_escape_string($conn, $_POST["last_name"]);
        $password_encrypted = password_hash($password, PASSWORD_DEFAULT);


        if (empty($username_filter) or empty($email_filter) or empty($first_fitler) or empty($last_filter)) { // If the fields is left empty it will display an error

            header("Location: profile.php?fields=empty");
            exit();
        } 
            

        if (empty($user_image)) { // If user_image is empty then it will display his current image

            $query = "SELECT * from users WHERE username = '{$username}' ";

            $empty_image_query = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_array($empty_image_query)) {

                $user_image = $row['user_image'];
            }

        }

        $query = "UPDATE users SET ";
        $query .= "first_name = '{$first_fitler}', ";
        $query .= "last_name = '{$last_filter}', ";
        $query .= "username = '{$username_filter}', ";
        $query .= "email = '{$email_filter}' , ";
        $query .= "password = '{$password_encrypted}', ";
        $query .= "user_image = '{$user_image}' ";
        $query .= "WHERE username = '{$username}' ";

        $edit_user_query = mysqli_query($conn, $query);

        session_start();
        $_SESSION['userUid'] = $_POST['user_name'];
        $_SESSION['user_image'] = "styles/img/profile_pictures/$user_image";
        header("Location: profile.php?fields=success");

    }

}

?>
