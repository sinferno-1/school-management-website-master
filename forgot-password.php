<?php include('./config.php'); ?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | ERP Model</title>
    <link rel="stylesheet" href="./assets/css/base-styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<div id="highlighted" class="hl-basic hidden-xs">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-9 col-sm-offset-3 col-md-9 col-md-offset-3 col-lg-10 col-lg-offset-2">
        <h1>Forgot Password</h1>
      </div>
    </div>
  </div>
</div>
<div id="content" class="interior-page">
  <div class="container-fluid">
    <div class="row">
      <!--Sidebar-->
      <div class="col-sm-3 col-md-3 col-lg-2 sidebar equal-height interior-page-nav hidden-xs">
        <div class="dynamicDiv panel-group" id="dd.0.1.0">
          <div id="subMenu" class="panel panel-default">
            <ul class="subMenuHighlight panel-heading">
              <li class="subMenuHighlight panel-title" id="subMenuHighlight">
                <!-- <a id="li_291" class="subMenuHighlight" href=""><span>Register</span></a> -->
              </li>
            </ul>
            <ul class="panel-heading">
              <!-- <li class="panel-title">
                <a class="subMenu1" href=""><span class="subMenuHighlight">Forgot Password</span></a>
              </li> -->
              <div class="item item-nopad item-noborder item-gold">
            <a style="padding: 5% 0px;" href="" class="btn btn-primary btn-block" role="button">Forgot Password</a> 
          </div>
            </ul>
            <ul class="panel-heading">
              <!-- <li class="panel-title">
                <a class="subMenu1" href="login.php"><span>Login</span></a>
              </li> -->
              <div class="item item-nopad item-noborder item-gold">
            <a style="padding: 5% 0px;" href="login.php" class="btn btn-primary btn-block" role="button">Login</a> 
          </div>
            </ul>
          </div>
          <div class="item item-nopad item-noborder item-gold">
            <a style="padding: 5% 0px;" href="" class="btn btn-primary btn-block" role="button">LEARN MORE</a> 
          </div>
        </div>
      </div>

      <!--Content-->
      <div class="col-sm-9 col-md-9 col-lg-10 content equal-height">
        <div class="content-area-right">
          <div class="content-crumb-div">
            <a href="INDEX.PHP">Home</a> | <a href="">Your Account</a> | Forgot Password
          </div>

          <form class='card-body' method='POST' action='send_link.php'>
          <div class='form-group'>
                    <label>Category:</label>
                    <select class='form-control' name='category' required>
                        <option value='student' selected>student</option>
                        <option value='teacher'>teacher</option>
                        <option value='accountant'>accountant</option>
                        <option value='admin'>admin</option>
                    </select>
                </div> 
                <div class='form-group'>
                    <label>Email:</label>
                    <input type='email' class='form-control' name='email' required>
                </div>

          <div class="row">
          <div class='text-center'>
                    <button type='submit' name='submit_email' class='btn btn-primary w-500'>Submit</button>
                </div>

            <!-- <div class="col-md-5 forgot-form">
              <p>Please enter your email address below and we will send you information to change your password.</p>
              <label class="label-default" for="un">Email Address</label> <input id="email_addy" name="email_addy" class="form-control" type="text"><br>
              <a id="mybad" class="btn btn-primary" role="button">I FORGOT</a>
            </div>
            <div class="col-md-5 forgot-return" style="display:none;">
              <h2>Reset Password Sent</h2>
              <p>An email has been sent to your address with a reset password you can use to access your account.</p>
            </div> -->
          </div>
        </div> 
      </div>
    </div>
  </div>
</div>
</body>