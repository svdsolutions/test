<?php ;
      include("bootstrap.php");
      if (ONESIGNAL_APP_ID == 'gdevs') {
          include("header.php");
      }
      
?>

<main class="dash-content">
    <!-- // This Admin panel is Crated by G-devs (Codecanyon.net) -->
                <div class="container-fluid">
                    <h1 class="dash-title">Privacy Policy</h1>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card easion-card">
                                <div class="card-header">
                                    <div class="easion-card-icon">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                    <div class="easion-card-title"> Form </div>
                                </div>
                                <div class="card-body ">
                                    <form action="code.php" method="POST" enctype="multipart/form-data">

                                        <div class="row">

                                            <div class="col-xl-6">

                                       

                                        <div class="form-group col-md-12">
                <label for="title">App Name</label>
                <input type="text" class="form-control" id="title" value="NewsDroid" disabled="" />
                <div class="invalid-feedback">
                    Please enter title 
                </div>
            </div>  
<!-- // This Admin panel is Crated by G-devs (Codecanyon.net) -->
            <div class="form-group col-md-12">
                <label for="desc">Privacy Policy</label>
                <textarea class="form-control" id="desc" rows="8"></textarea>
               
                <div class="invalid-feedback">
                    Please enter description 
                </div>                    
            </div>

                

            <div class="form-group col-md-12">
                <div class="progress">
                    <div class="progress-bar" id="progress" style="width:0%;">0%</div>
                </div>
            </div> 


                                        

                                        

                                        <!-- <div class="mb-3 row">
                                        <label for="example-text-input" class="col-md-2 col-form-label"></label>
                                        <div class="col-md-6">
                                            <button type="submit" name="save_recipe" class="btn btn-primary">Submit</button>
                                        </div>
                                        </div> -->

                                        </div>

                                        <div class="col-xl-6">


                                       <!-- <div class="form-group col-md-12">
                                        <label for="inputEmail4">HTML Editor - For Description</label>
                                        <textarea type="email" class="ckeditor" name="recipe_ingredients" ></textarea>
                                        </div> -->
                                       
                                       <h4 id="">Privacy Policy</h4>
                                       <h5 id="category"></h5>

                                       

                                        



                                    </div>



                                </div>

                                <div class="form-group col-md-12">
                                        
                                         
                <button type="button" id="btn-save" class="btn btn-primary" >Save</button>
            
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
            </main>
            <?php include "footer.php";?>
           <script>
    function previewWallpaper(thumbnail){
        if(thumbnail.files && thumbnail.files[0]){
            var reader = new FileReader(); 

            reader.onload = function(e){
                $("#img-wallpaper").attr('src', e.target.result);
            }
            reader.readAsDataURL(thumbnail.files[0]);
        }
    }

    $("#wallpaper").change(function(){
        previewWallpaper(this);
    });

    var dbCategories = firebase.database().ref("policy");

    dbCategories.once("value").then(function(categories){

        categories.forEach(function(category){
            $("#category").append("<option value='"+category.val().desc+"'>"+category.val().desc+"</option>");     
             
        });
    });

    var validImageTypes = ["text", "image/jpeg", "image/png"];

    $("#btn-save").click(function(){
        $("#title").removeClass("is-invalid");
        $("#desc").removeClass("is-invalid");    
        

        var title = $("#title").val();
        var desc = $("#desc").val(); 
        

        if(!title){
            $("#title").addClass("is-invalid");
            return; 
        }

        if(!desc){
            $("#desc").addClass("is-invalid");
            return; 
        }


        

       
        
                    var database = firebase.database().ref("policy");
                    
                    var imageid = database.push().key;

                    var image = {
                       
                    
                        "appname": title,
                        "desc": desc,
                        
                    };

                    database.child("gdevs").set(image, function(err){
                        alert("Saved Successfully !");
                        location.reload();
                    });

        

    });
    
    function resetForm(){
       $("#image-form")[0].reset(); 
       $("#img-wallpaper").attr("src", "");;
       $("#progress").html("Completed");
location.reload();
    }
</script>
<script>
        
                firebase.auth().onAuthStateChanged(function(user){
                    if(!user){
                        window.location.href = "index.html";
                    }
                });
    
        </script>
<script type="text/javascript">
    var userDataRef = firebase.database().ref("policy/Premium Quotes").orderByKey();
userDataRef.once("value").then(function(snapshot) {
snapshot.forEach(function(childSnapshot) {
  var key = childSnapshot.key;

  var name_val = childSnapshot.val().privacypolicy;
  
   document.getElementById("desc").innerHTML = name_val;

  });
});
</script>
