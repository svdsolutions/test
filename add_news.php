<?php include "header.php";?>
<!-- // This Admin panel is Crated by G-devs (Codecanyon.net) -->

<main class="dash-content">
                <div class="container-fluid">
                    <h1 class="dash-title">Add News</h1>
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
                <label for="category">Select Category</label>
                <select id="category" class="form-control">

                </select>
            </div>

                                        <div class="form-group col-md-12">
                <label for="title">News Title</label>
                <input type="text" class="form-control" id="title" />
                <div class="invalid-feedback">
                    Please enter title 
                </div>
            </div>
            <!-- // This Admin panel is Crated by G-devs (Codecanyon.net) -->

                                        <div class="form-group col-md-12">
                <label for="date">News Date</label>
                <input type="date" placeholder="dd-mm-yyyy" value=""
        min="1997-01-01" max="2030-12-31" class="form-control" id="date" />
                <div class="invalid-feedback">
                    Please enter title 
                </div>
            </div>

            <div class="form-group col-md-12">
                <label for="isFeatured">Select is Featured ?</label>
                <select id="isFeatured" class="form-control">
                   <option value="Yes">Yes</option>
                   <option value="No">No</option>
                </select>
            </div>

                                        <div class="form-group col-md-12">
                <label for="wallpaper">News Image</label>
                <input type="file" class="form-control" id="wallpaper" />

                <div class="invalid-feedback">
                    Please choose a valid image
                </div>
            </div>   

              <div class="col-lg-3">
        <img id="img-wallpaper" width="300" height="200" style="margin: 10px;" />
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


                                       <div class="form-group col-md-12">
                                        <label for="inputEmail4">HTML Editor - For Description</label>
                                        <textarea type="email" class="ckeditor" name="recipe_ingredients" ></textarea>
                                        </div>
                                       

                                        <div class="form-group col-md-12">
                <label for="desc">Description</label>
                <textarea class="form-control" id="desc" rows="8"></textarea>
               
                <div class="invalid-feedback">
                    Please enter description 
                </div>                    
            </div>

                                        



                                    </div>



                                </div>

                                <div class="form-group col-md-12">
                                        
                                         
                <button type="button" id="btn-save" class="btn btn-primary" disabled>Save News</button>
            
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
            </main>
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

    var validImageTypes = ["image/gif", "image/jpeg", "image/png"];

    $("#btn-save").click(function(){
        $("#title").removeClass("is-invalid");
        $("#desc").removeClass("is-invalid");
        $("#wallpaper").removeClass("is-invalid");
        $("#date").removeClass("is-invalid");
        

        var id = $("#id").val();
        var title = $("#title").val();
        var desc = $("#desc").val(); 
        var wallpaper = $("#wallpaper").prop("files")[0];
        var date = $("#date").val();
        var isFeatured = $("#isFeatured").val(); 
        

        if(!title){
            $("#title").addClass("is-invalid");
            return; 
        }

        if(!desc){
            $("#desc").addClass("is-invalid");
            return; 
        }

        if(!date){
            $("#date").addClass("is-invalid");
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
        //This Admin panel is Crated by G-devs (Codecanyon.net) -->
        var uploadTask = storageRef.put(wallpaper);

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
                    var database = firebase.database().ref("news");

                    var imageid = database.push().key;

                    var image = {
                        "url": downloadURL, 
                        "title": title, 
                        "desc": desc,
                        "category": category ,
                        "date": date,
                        "id": <?php echo(rand(10,1000));?>,
                        "isFeatured": isFeatured,
                    };

                    database.child(imageid).set(image, function(err){
                        alert("Image saved..");
                       
       location.reload();
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
<?php include "footer.php";?>