<?php ;
      include("bootstrap.php");
      if (ONESIGNAL_APP_ID == 'gdevs') {
          include("header.php");
      }
      

if (isset($_GET['del_id'])) {
    
    # code...
    $id = $_GET['del_id'];
    echo $id;

?>

<!-- <input type="text" name="name" id="myText" value="<?php echo $id ?>"> -->

<?php } ?>

<!-- <script>
    var x = document.getElementById("myText").value;
    // alert(x);
    var dbCategories1 = firebase.database().ref("categories");
   dbCategories1.on("value", function(categories){

  if(confirm('Are you sure?')){
    categories.forEach(function(category){
    firebase.database().ref('categories/'+x+'/') 
      .remove()
        window.location="manage_category.php"; 

    });
  }
   
      });
</script> -->

<main class="dash-content">
  <div class="col-lg-12">
    <div class="col-lg-12">
      <h3 class="dash-title">Manage Channels  
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="float: right;">Add Channels</button></h3>
      <!-- <input type="text" id="myText" value="Mickey">    -->
      <!-- <input type="text" class="form-control" id="name" value="<?php echo $id ?>" />  -->

      <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modal Channels</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div style="padding: 20px;">
        <form id="category-form">

           <div class="form-group">
                <label for="category">Select Category</label>
                <select id="category" class="form-control">

                </select>
            </div>

            <div class="form-group">
                <label for="title">Channel Name</label>
                <input type="text" class="form-control" id="title" />
                <div class="invalid-feedback">
                    Please enter title 
                </div>
            </div>

            <div class="form-group">
                <label for="url">Channel URL</label>
                <input type="text" class="form-control" id="url" />
                <div class="invalid-feedback">
                    Please enter url 
                </div>
            </div>
      
      <div class="form-group">
                <label for="featured">Select Type</label>
                <select id="featured" class="form-control">
        <option value="youtube">Youtube</option>
        <option value="url">URL</option>

                </select>
            </div>

            <div class="form-group">
                <label for="desc">Description</label>
                <textarea type="text" class="form-control" id="desc" value="G-Developers" ></textarea>
                <div class="invalid-feedback">
                    Please enter description 
                </div>                    
            </div>

            <div class="form-group">
                <label for="wallpaper">Channel Logo</label>
                <input type="file" class="form-control" id="wallpaper" />

                <div class="invalid-feedback">
                    Please choose a valid image
                </div>
            </div>

            <div class="form-group">
                <label for="language">Channel Images (Banner)</label>
                
                <input type="file" class="form-control" id="language" />
               
            </div>

            <div class="form-group text-center">
                <img id="img-wallpaper" width="200" height="300" style="margin: 10px;" />
            </div>

            <div class="form-group">
                <div class="progress">
                    <div class="progress-bar" id="upload-progress" style="width:0%">0%</div>
                </div>
            </div>
            <!-- <div class="modal-footer">
                <button id="save-category" type="button" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div> -->
       
        </div>
        <!-- // This Admin panel is Crated by G-devs (Codecanyon.net) -->
        <!-- Modal footer -->
        <div class="modal-footer">
          <button id="btn-save" type="button" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
         </form>
        
      </div>
    </div>
  </div>
    

    <div class="row text-center">
      <div class="col-lg-12">
        <div class="card easion-card">
          <div class="card-header">
            <div class="easion-card-icon">
              <i class="fas fa-table"></i>
            </div>
            <div class="easion-card-title">All Channels</div>
          </div>
          <div class="card-body ">
           <table class="table stylish-table table-bordered">
            <thead>
                <tr>
                    <th>Channels Name</th>
                    <th>Category</th>
                    
                    <th>Type</th>
                    <th>Thumbnail</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody id="categories">

            </tbody>
        </table>
    </div>

</div>

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

     // This Admin panel is Crated by G-devs (Codecanyon.net)

    var dbCategories = firebase.database().ref("categories");

    dbCategories.once("value").then(function(categories){

        categories.forEach(function(category){
            $("#category").append("<option value='"+category.key+"'>"+category.key+"</option>");     
        });
    });


    var dbCategorie = firebase.database().ref("languages");

    var validImageTypes = ["image/gif", "image/jpeg", "image/png"];

    $("#btn-save").click(function(){
        $("#image_name").removeClass("is-invalid");
        $("#desc").removeClass("is-invalid");
        $("#wallpaper").removeClass("is-invalid");
        $("#date").removeClass("is-invalid");
        

        
        var title = $("#title").val();
        var desc = $("#desc").val(); 
        var url = $("#url").val(); 
        var featured = $("#featured").val();
        var wallpaper = $("#wallpaper").prop("files")[0];
        var language = $("#language").prop("files")[0];
        
        

        if(!title){
            $("#title").addClass("is-invalid");
            return; 
        }

        if(!wallpaper){
            $("#wallpaper").addClass("is-invalid");
            return; 
        }

        if($.inArray(wallpaper["type"], validImageTypes)<0){
            $("#wallpaper").addClass("is-invalid");
            return; 
        }

        var category = $("#category").val(); 
        var name = wallpaper["name"];

        var ext = name.substring(name.lastIndexOf("."), name.length);

        var imagename = new Date().getTime(); 

        var storageRef = firebase.storage().ref(category + "/" + imagename + ext);
        var storageRef1 = firebase.storage().ref(category + "/" + imagename + "ymg"+ ext);
        //This Admin panel is Crated by G-devs (Codecanyon.net) -->
        var uploadTask = storageRef.put(wallpaper);
        var uploadTask1 = storageRef1.put(language);

        uploadTask.on("state_changed", 
            function progress(snapshot){
                var percentage = (snapshot.bytesTransferred / snapshot.totalBytes) * 100; 
                $("#progress").html(Math.round(percentage)+"%");
                $("#progress").attr("style", "width: "+percentage + "%");
            }, 

            function error(err){

            },

            function complete(){
                uploadTask.snapshot.ref.getDownloadURL().then(function(downloadURL) {

                    uploadTask1.snapshot.ref.getDownloadURL().then(function(downloadURL1) {

                        var database = firebase.database().ref("Channels");

                    var imageid = database.push().key;
                    var bannerImage = uploadTask1.snapshot.ref.getDownloadURL();

                    var image = {
                        "channelImage": downloadURL, 
                        "channelName": title,
                        "channelCategory": category,
                        "channelType": featured,                      
                        "channelDesc" : desc,
                        "channelLink" : url,
                        "channelLanguage":  downloadURL1,
                        "id" : <?php echo(rand(10,100000)); ?>
                       
                    };

                    database.child(imageid).set(image, function(err){
                        alert("Image saved..");
                       
       location.reload();
                    });
                   
                }); 

                }); 
            }
        );

    });
    
    // function resetForm(){
    //    $("#image-form")[0].reset(); 
    //    $("#img-wallpaper").attr("src", "");;
    //    $("#progress").html("Completed");
    //    location.reload();
    // }
</script>

<script type="text/javascript">

    function resetForm(){
       $("#category-form")[0].reset(); 
       $("#selected-thumbnail").fadeOut();
       $("#upload-progress").html("Completed");
       $("#myModal").modal('hide');
    }

    var dbCategories = firebase.database().ref("Channels");

    dbCategories.on("value", function(categories){

        if(categories.exists()){
            var categorieshtml = ""; 
            categories.forEach(function(category){


                
                categorieshtml += "<tr>";

                //for category name
                categorieshtml += "<td>";
                categorieshtml += category.val().channelName;
                categorieshtml += "</td>";



                //for category description
                categorieshtml += "<td>";
                categorieshtml += category.val().channelCategory;
                categorieshtml += "</td>";

                //  //for category description
                // categorieshtml += "<td>";
                // categorieshtml += category.val().channelLanguage;
                // categorieshtml += "</td>";
                
                //for category thumbnail
                categorieshtml += "<td> <img width='180' height='180' src='";
                categorieshtml += category.val().channelImage;
                categorieshtml += "' /></td>";

                //for category description
                categorieshtml += "<td>";
                categorieshtml += category.val().channelType;
                categorieshtml += "</td>";
                

                //real code for delete data
                categorieshtml += "<td>  <a href='delete_image.php?del_id=";
                categorieshtml += category.key;
                categorieshtml += "' class='btn btn-danger'>Delete</a> </td>";


                // categorieshtml += "<td>  <button onclick='myDelete()'";
                
                // categorieshtml += " class='btn btn-danger'>Delete</a> </td>";

                

                
                


                
                

                categorieshtml += "</tr>";


            });

            $("#categories").html(categorieshtml);
        }



    });

</script>

<!-- <script type="text/javascript">
    var reference = db.ref('/categories/Abcd/');
reference.on('value', function(snapshot) {
snapshot.forEach(function(userSnapshot){
console.log(userSnapshot.val().desc)


// document.getElementById('gmap').href = userSnapshot.val().location;
// document.getElementById('gimg2').src = userSnapshot.val().url;
// document.getElementById('name').innerHTML = userSnapshot.val().uid;
</script> -->

<script>function myFunction(key) {
  alert(key);
  // document.getElementById('name').value = category.key
}</script>

<script>
function myDelete() {
  alert("This is Just for Demo!");
}
</script>



<?php include("footer.php");
?>

<script>
function loaddelete(keys) {

    var deleteid = $(this).closest("tr").closest("td").find('.delete_id_value').val();

    alert(deleteid);
    

  //  var dbCategories1 = firebase.database().ref("categories");
  //  dbCategories1.on("value", function(categories){

  // if(confirm('Are you sure?')){
  //   categories.forEach(function(category){
  //   firebase.database().ref('categories/'+'1234'+'/') 
  //     .remove()
  //       window.location="manage_category.php"; 

  //   });
  // }
   
  //     });
}
</script>

<script type="text/javascript">

  $(document).ready(function (){

    $('.delete_btn_ajax').click(function (e){
      e.preventDefault();

      var deleteid = $(this).closest("td").find('.delete_id_value').val();

      console.log("HEY");

      alert(deleteid);

    });
  });


</script>

<script>
        
                firebase.auth().onAuthStateChanged(function(user){
                    if(!user){
                        window.location.href = "index.html";
                    }
                });
    
        </script>

<!-- <script>
function myFunction(keys) {
    var reference = db.ref('/categories/Abcd/');
reference.on('value', function(snapshot) {
snapshot.forEach(function(userSnapshot){
console.log(userSnapshot.val().desc)
}
}
}
</script> -->



