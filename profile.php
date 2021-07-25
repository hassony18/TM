<?php 
	require 'header.php';
	require_once 'functions.php';
	include 'db/config.php';

	fetchUserDataProfile();
	updateUserDataProfile();
	allowAccessToProfile();
?>



<link rel="stylesheet" href="styles/profile.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

<body>
  <div class="main-content">


    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
					<div class="imgbarcontainter">
					  <a href="#">
					  <form action="" method="post" enctype="multipart/form-data">
					  <?php echo "<img src='styles/img/profile_pictures/{$user_image}' class='rounded-circle'>" ?>
							<label id="changephotobar" class="file btn btn-lg btn-primary">
								Change Photo
							<input name="user_image" type="file" name="file"/>
						</label>
					  </a>
					</div>
                </div>
              </div>
            </div>

            <div class="card-body pt-0 pt-md-4">
              <div class="row">
                <div class="col">
                </div>
              </div>
              <div class="text-center">
                <h3>
                  <?php echo $username; ?><span class="font-weight-light"></span>
                </h3>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">My account</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form>
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-username">Username</label>
                        <input type="text" id="input-username" name="user_name" class="form-control form-control-alternative"  value="<?php echo $username; ?>">
                      </div>
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">New Password</label>
                        <input type="password" id="input-email" name="user_password" class="form-control form-control-alternative" >
                      </div>
                      <!-- <div class="form-group focused">
                        <label class="form-control-label" for="input-username">Current Password</label>
                        <input type="password" id="input-username" name="current_password" class="form-control form-control-alternative" >
                      </div> -->
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email address</label>
                        <input type="email" id="input-email" name="user_email" class="form-control form-control-alternative" value="<?php echo $user_email; ?>">
                      </div>

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">First name</label>
                        <input type="text" id="input-first-name" name="first_name" class="form-control form-control-alternative" value="<?php echo $user_firstname; ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-last-name">Last name</label>
                        <input type="text" id="input-last-name" name="last_name" class="form-control form-control-alternative"  value="<?php echo $user_lastname; ?>">
                      </div>
                                      <div class="col-4 text-right">
                  <input class="btn btn-sm btn-primary" type="submit" name="update_profile" value="Update Profile">
                              <?php
if (isset($_GET["fields"])) { // Gives the user an error message if the fields are empty or has invalid chars or if it's changed successfully
    $emptyfields = $_GET["fields"];

    if ($emptyfields == "empty") {
        echo "<h1 class='error-msg-form'>You did not fill in all fields!</h1>";
        exit();
    } elseif ($emptyfields == "char") {
        echo "<h1 class='error-msg-form'>You used invalid characters!</h1>";
        exit();
    } elseif ($emptyfields == "invalidemail") {
        echo "<h1 class='error-msg-form'>You used an invalid e-mail!</h1>";
        exit();
    } elseif ($emptyfields == "success") {
        echo "<h1 class='success-msg-form'>Your profile has been updated!</h1>";
        exit();
    } else if ($signupCheck == "wrongcurrentpw") {
        echo "<h1 class='error-msg-form'>Your current password is wrong!</h1>";
        exit();
    }
}
?>
                      </form>
                </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

















<?php require "footer.php";?>