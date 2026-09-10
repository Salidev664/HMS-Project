<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HMS</title>
    <link rel="stylesheet" href="/public/assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/public/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/assets/bootstrap/css/bootstrap.css.map">
    <link rel="stylesheet" href="/public/assets/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/public/login.css">
    
</head>
 <div class="auth-modal">

   <div class="login">

    <div class="side-register">
        <h5>
            Protect yourself and your Family <br>
            Easy online appointment
        </h5>

        <img src="./../../../public/image/download (2).jpeg" alt="">
    </div>

    <div class="register">

        <form action="?action=login"   method="POST">

            <h2>Welcome Back!</h2>

            <div class="form-group">
                <input
                    type="email"
                    name="email"
                    placeholder="email"
                    required
                    class="form-control"
                    autocomplete="off">
            </div>

            <div class="form-group">
                <input
                    type="password"
                    name="password"
                    placeholder="password"
                    required
                    class="form-control">
            </div>

            <button
                type="submit"
                name="login"
                class="btn btn-primary btn-outline-info mt-1">
                Log in
            </button>

            <p class="mt-2">
                Don't have an account?
                <a href="#" id="under_login">Sign-up</a>
            </p>

        </form>

    </div>
</div>
<!------------------------------------------------------registration-------------------------->
   <div class="registration">

        <div class="side-register">
            <h5>
                Protect yourself and your Family <br> Easy online appointment
            </h5>

          
                <img src="./../../../public/image/download (2).jpeg" alt="">
            
        </div>
         <div class="register">
            <form action="?action=registerPatient" method="post">
                <h2>Register Now!</h2>

                <p>
                <?php echo $_SESSION['$errorMessage'] ?? '';?>
            </p>
                <div class="form-group">
                    <input type="text" placeholder="Username" name="username" class="form-control" required autocomplete="off">
                </div>

                <div class="form-group">
                    <input type="email" placeholder="email" name="email" required class="form-control">
                </div>

                <div class="form-group">
                    <input type="password" placeholder="password" name="password" class="form-control" required autocomplete="new-password">
                </div>

                <div class="form-group">
                    <input type="date" placeholder="Date of birth" name="DOB" class="form-control" required>
                </div>

                <div class="d-flex" style="gap: 12px;">
                    <label for="">Gender :</label><br>
            
                    <input type="radio" name="gender" value="Male" required>Male
     
                    <input type="radio"  name="gender" value="Female" required>Female
                    
                </div>


                <div class="form-group">
                    <input type="tel" placeholder="phone" name="phone" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary btn btn-outline-info mt-1" name="submit">Sign-up</button>
               <p> Already have an account? <a href="#" id="under_signup">Login</a></p>
            </form>
           </div> 
   </div>
 </div>
 <script src="/public/login.js"></script>
<script src="/public/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/public/assets/bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>