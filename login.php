<?php
    include('includes/header.php');
?>

    <div class="container bg-cont mt-5 mb-5" id="container">
        <div class="form-container sign-in-container">
            <form class="form-tb" action="#">
                <h1 class="sig">Sign in</h1>
                <input class="input-f" type="email" placeholder="Email" />
                <input class="input-f" type="password" placeholder="Password" />
                <a class="a" href="#">Forgot your password?</a>
                <button class="bt">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1 class="sig">Welcome Back!</h1>
                    <p  class="sg">To keep connected with us please login with your Credentials</p>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1 class="sig">Welcome Back!</h1>
                    <p  class="sg">To keep connected with us please login with your Credentials</p>
                </div>
            </div>
        </div>
    </div>

<?php
    include('includes/footer.php');
?>