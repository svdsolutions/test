<?php
    include('includes/header.php');
?>

    <div class="container bg-cont mt-5 mb-5" id="container">
        <div class="form-container sign-in-container">
            <form class="form-tb" action="#">
                <h1 class="sig">Create Account</h1>
                <input class="input-f" type="text" placeholder="First Name" />
                <input class="input-f" type="text" placeholder="Last Name" />
                <input class="input-f" type="text" placeholder="Phone Number" />
                <input class="input-f" type="email" placeholder="Email" />
                <input class="input-f" type="password" placeholder="Password" />
                <button class="bt">Sign Up</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1 class="sig">Hello, Friend!</h1>
                    <p  class="sg">Enter your details and start journey with us</p>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1 class="sig">Hello, Friend!</h1>
                    <p  class="sg">Enter your details and start journey with us</p>
                </div>
            </div>
        </div>
    </div>

<?php
    include('includes/footer.php');
?>