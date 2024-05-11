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
      <h3 class="dash-title">Manage Languages  
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="float: right;">Add Category</button></h3>
      <!-- <input type="text" id="myText" value="Mickey">    -->
      <!-- <input type="text" class="form-control" id="name" value="<?php echo $id ?>" />  -->

      <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"> Languages</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div style="padding: 20px;">
        <form id="category-form">
            <div class="form-group">
                <label for="category-name">Enter name</label>
                <input type="text" class="form-control" id="category-name" />
                
                <div class="invalid-feedback">
                    Please enter a category name
                </div>
            </div>
            <div class="form-group">
                <label for="category-desc">Description</label>
                <input type="text" class="form-control" id="category-desc" />
                <div class="invalid-feedback">
                    Please enter some short description for category
                </div>
            </div>
            
            <div class="form-group">
                <label for="category-thumbnail">Thumbnail</label>
                <input v-on:change.prevent='imageList' type="file" class="form-control" id="category-thumbnail" multiple/>
                <div class="invalid-feedback">
                    Please choose a valid image thumbnail
                </div>
            </div>

            <div class="form-group text-center">
                <img id="selected-thumbnail" width="250" height="150" src="#" />
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
          <button id="save-category" type="button" class="btn btn-primary">Save</button>
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
            <div class="easion-card-title">All Languages</div>
          </div>
          <div class="card-body ">
           <table class="table stylish-table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
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

    var validImageTypes = ["image/gif", "image/jpeg", "image/png"];

    $("#selected-thumbnail").hide();

    function previewThumbnail(thumbnail){
        if(thumbnail.files && thumbnail.files[0]){
            var reader = new FileReader(); 

            reader.onload = function(e){
                $("#selected-thumbnail").attr('src', e.target.result);
                $("#selected-thumbnail").fadeIn();
            }
            reader.readAsDataURL(thumbnail.files[0]);
        }
    }

    $("#category-thumbnail").change(function(){
        previewThumbnail(this);
    });

    $("#save-category").click(function(){
        $("#category-name").removeClass("is-invalid");
        $("#category-desc").removeClass("is-invalid");
        $("#category-thumbnail").removeClass("is-invalid");

        var catname = $("#category-name").val();
        var desc = $("#category-desc").val(); 
        var thumbnail = $("#category-thumbnail").prop("files")[0];

        if(!catname){
            $("#category-name").addClass("is-invalid");
            return; 
        }

        if(!desc){
            $("#category-desc").addClass("is-invalid");
            return; 
        }

        if(thumbnail == null){
            $("#category-thumbnail").addClass("is-invalid");
            return; 
        }

        if($.inArray(thumbnail["type"], validImageTypes)<0){
            $("#category-thumbnail").addClass("is-invalid");
            return; 
        }

        var database = firebase.database().ref("languages/"+catname);

        database.once("value").then(function(snapshot){
            
            if(snapshot.exists()){
                $("#result").attr("class", "alert alert-danger");
                $("#result").html("Category already exist");
                resetForm();
            }else{
                //1. upload the selected thumbnail to firebase storage
                var name = thumbnail["name"];
                var ext = name.substring(name.lastIndexOf("."), name.length);

                var thumbname = new Date().getTime(); 

                var storageRef = firebase.storage().ref(catname + "/" + thumbname + ext);

                var uploadTask = storageRef.put(thumbnail);

                uploadTask.on("state_changed", 

                    function progress(snapshot){
                        var percentage = (snapshot.bytesTransferred / snapshot.totalBytes) * 100; 

                        $("#upload-progress").html(Math.round(percentage) + "%");
                        $("#upload-progress").attr("style", "width:"+percentage + "%");
                    }, 

                    function error(err){

                    }, 

                    function complete(){
                        uploadTask.snapshot.ref.getDownloadURL().then(function(downloadURL) {
                            var cat = {
                                "thumbnail": downloadURL, 
                                "desc": desc
                            };

                            database.set(cat, function(err){
                                if(err){
                                    $("#result").attr("class", "alert alert-danger");
                                    $("#result").html(err.message);
                                }else{
                                    $("#result").attr("class", "alert alert-success");
                                    $("#result").html("Category added");
                                }
                                resetForm();
                            }); 
                        });
                    }
                
                );

            }

        });

    });

    function resetForm(){
       $("#category-form")[0].reset(); 
       $("#selected-thumbnail").fadeOut();
       $("#upload-progress").html("Completed");
       $("#myModal").modal('hide');
    }

    var dbCategories = firebase.database().ref("languages");

    dbCategories.on("value", function(categories){

        if(categories.exists()){
            var categorieshtml = ""; 
            categories.forEach(function(category){


                
                categorieshtml += "<tr>";

                //for category name
                categorieshtml += "<td>";
                categorieshtml += category.key;
                categorieshtml += "</td>";



                //for category description
                categorieshtml += "<td>";
                categorieshtml += category.val().desc;
                categorieshtml += "</td>";
                
                //for category thumbnail
                categorieshtml += "<td> <img width='250' height='150' src='";
                categorieshtml += category.val().thumbnail;
                categorieshtml += "' /></td>";
                

                //real code for delete data
                categorieshtml += "<td>  <a href='delete_img_category.php?del_id=";
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



