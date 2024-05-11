<?php ;
      include("bootstrap.php");
      if (ONESIGNAL_APP_ID == 'gdevs') {
          include("header.php");
      }
      
?>

<main class="dash-content">
    <!-- // This Admin panel is Crated by G-devs (Codecanyon.net) -->
                <div class="container-fluid">
                    <h1 class="dash-title">Manage Ads</h1>
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
                <label for="title">Ads Status</label>
                <select class="form-control" id="status">

                <option value="on">ON</option>
                <option value="off">OFF</option>
                
                </select>

                
            </div>  

              <div class="form-group col-md-12">
                <label for="title">Publisher ID</label>
                <input type="text" class="form-control" id="pub" value=""  />
                <div class="invalid-feedback">
                    Please enter title 
                </div>
            </div>  

                                        <div class="form-group col-md-12">
                <label for="title">Banner ID</label>
                <input type="text" class="form-control" id="banner" value=""  />
                <div class="invalid-feedback">
                    Please enter title 
                </div>
            </div>  


              <div class="form-group col-md-12">
                <label for="title">Interstitial ID</label>
                <input type="text" class="form-control" id="inter" value=""  />
                <div class="invalid-feedback">
                    Please enter title 
                </div>
            </div>  



              <div class="form-group col-md-12">
                <label for="title">Native ID</label>
                <input type="text" class="form-control" id="native" value="" />
                <div class="invalid-feedback">
                    Please enter title 
                </div>
            </div>  



              <div class="form-group col-md-12">
                <label for="title">Rewarded ID</label>
                <input type="text" class="form-control" id="video" value="" />
                <div class="invalid-feedback">
                    Please enter title 
                </div>
            </div>  
<!-- // This Admin panel is Crated by G-devs (Codecanyon.net) -->
           

                

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
                                       
                                       <h4 id="">Ads ID's</h4>


                                       <p id="statusid"></p>
                                       <p id="pubid"></p>
                                       <p id="bannerid"></p>
                                       <p id="interid"></p>
                                       <p id="nativeid"></p>
                                       <p id="videoid"></p>

                                       

                                        



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

    var dbCategories = firebase.database().ref("adsnetwork");

    dbCategories.once("value").then(function(categories){

        categories.forEach(function(category){
            $("#category").append("<option value='"+category.val().desc+"'>"+category.val().desc+"</option>");     
             
        });
    });

    var validImageTypes = ["text", "image/jpeg", "image/png"];

    $("#btn-save").click(function(){
         
        

        var pub = $("#pub").val();
        var banner = $("#banner").val(); 
        var inter = $("#inter").val(); 
        var native = $("#native").val(); 
        var video = $("#video").val(); 
        var status = $("#status").val(); 
        

        


        

       
        
                    var database = firebase.database().ref("adsnetwork");
                    
                    var imageid = database.push().key;

                    var image = {
                       
                    
                        "id": 45242,
                        "pub": pub,
                        "banner": banner,
                        "inter": inter,
                        "native": native,
                        "video": video,
                        "status": status
                        
                    };

                    database.child("ymg").set(image, function(err){
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
    var userDataRef = firebase.database().ref("adsnetwork").orderByKey();
userDataRef.once("value").then(function(snapshot) {
snapshot.forEach(function(childSnapshot) {
  var key = childSnapshot.key;

  var status = childSnapshot.val().status;
  var pub = childSnapshot.val().pub;
  var banner = childSnapshot.val().banner;
  var inter = childSnapshot.val().inter;
  var native = childSnapshot.val().native;
  var video = childSnapshot.val().video;

document.getElementById("bannerid").innerHTML = "<b>Banner Ads ID - </b>"+banner;
document.getElementById("interid").innerHTML = "<b>Interstitial ID - </b>"+inter;
document.getElementById("nativeid").innerHTML = "<b>Native Ads ID - </b>"+native;
document.getElementById("videoid").innerHTML = "<b>Rewarded Ads ID - </b>"+video;
document.getElementById("pubid").innerHTML = "<b>Publisher ID - </b>"+pub;
document.getElementById("statusid").innerHTML = "<b>Ads Status - </b>"+status;
  
   

  });
});
</script>
