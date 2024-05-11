
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600|Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="css/easion.css">
    <link rel="stylesheet" type="text/css" href="css/sweetalert/sweetalert.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <script src="js/chart-js-config.js"></script>
    <link rel="stylesheet" href="http://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
    <script src="//cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E=" crossorigin="anonymous"></script>
    <script src="https://www.gstatic.com/firebasejs/4.12.0/firebase.js"></script>
    <script src="js/app.js"></script>
    
    <title>Fire TV</title>
</head>

<body>
    <div class="dash">
        <div class="dash-nav dash-nav-dark">
            <header>
                <a href="#!" class="menu-toggle">
                    <i class="fas fa-bars" style="color: #000000;"></i>
                </a>
                <a href="index.html" class="easion-logo"><img src="images/logo.png" class="mr-1" style="width: 75px; margin-bottom: 30px; margin-top: 10px;">
                   
            </header>
            <nav class="dash-nav-list">

                
                <?php 
                $directoryURI =basename($_SERVER['SCRIPT_NAME']);
                if($directoryURI=="dashboard.php"){?>
                <div class="dash-nav-dropdown show" class="dash-nav-dropdown">
                <a href="dashboard.php" class="dash-nav-item" style="color: #ffffff">
                <i class="fas fa-home"></i> Dashboard </a>
                </div>
                <?php }else{?>
                <div class="dash-nav-dropdown" class="dash-nav-dropdown">
                <a href="dashboard.php" class="dash-nav-item">
                <i class="fas fa-home"></i> Dashboard </a>
                </div>

                <?php }?>

                <?php 
                $directoryURI =basename($_SERVER['SCRIPT_NAME']);
                if($directoryURI=="manage_category.php"){?>
                <div class="dash-nav-dropdown show" class="dash-nav-dropdown">
                <a href="manage_category.php" class="dash-nav-item" style="color: #ffffff">
                <i class="fas fa-columns"></i> Category </a>
                </div>
                <?php }else{?>
                <div class="dash-nav-dropdown" class="dash-nav-dropdown">
                <a href="manage_category.php" class="dash-nav-item">
                <i class="fas fa-columns"></i> Category </a>
                </div>

                <?php }?>


                

                <?php 
                $directoryURI =basename($_SERVER['SCRIPT_NAME']);
                if($directoryURI=="manage_image.php"){?>
                <div class="dash-nav-dropdown show" class="dash-nav-dropdown">
                <a href="manage_image.php" class="dash-nav-item" style="color: #ffffff">
                <i class="fas fa-images"></i> Channels </a>
                </div>
                <?php }else{?>
                <div class="dash-nav-dropdown" class="dash-nav-dropdown">
                <a href="manage_image.php" class="dash-nav-item">
                <i class="fas fa-images"></i> Channels </a>
                </div>

            
                <?php }?>

                <?php 
                $directoryURI =basename($_SERVER['SCRIPT_NAME']);
                if($directoryURI=="manage_policy.php"){?>
                <div class="dash-nav-dropdown show" class="dash-nav-dropdown">
                <a href="manage_policy.php" class="dash-nav-item" style="color: #ffffff">
                <i class="fas fa-th-large"></i> Privacy Policy </a>
                </div>
                <?php }else{?>
                <div class="dash-nav-dropdown" class="dash-nav-dropdown">
                <a href="manage_policy.php" class="dash-nav-item">
                <i class="fas fa-th-large"></i> Privacy Policy </a>
                </div>

                

                <?php }?>

            

            </nav>
        </div>
        <div class="dash-app">
            <header class="dash-toolbar">
                <a href="#!" class="menu-toggle">
                   <i class="fas fa-bars" style="color: #ffffff;"></i>
                </a>
                <div class="tools">
                    <div class="dropdown tools-item">
                        <a href="#" class="" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user" style="color: #ffffff;"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                            
                            <button class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>

          <h5>You want to Sure ?</h5>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
        
        <button onclick="logout()" class="btn btn-primary">Logout</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
function logout() {
  firebase.auth().signOut();
  
}
</script>