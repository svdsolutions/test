<?php 

  include "codehead.php";

 if (isset($_GET['del_id'])) {

	# code...
	$id = $_GET['del_id'];
	echo "  wait Reloading...";


 ?>

 <input type="hidden" name="name" id="myText" value="<?php echo $id ?>">

 <?php } ?>

 <!--  This Admin panel is Crated by G-devs (Codecanyon.net) -->

 <script>
 	var x = document.getElementById("myText").value;
    alert("Deleted Data Successfully");
    var dbCategories1 = firebase.database().ref("categories");
   dbCategories1.on("value", function(categories){

   	categories.forEach(function(category){
    firebase.database().ref('categories/'+x+'/') 
      .remove()
        window.location="manage_category.php"; 

    });

    // This Admin panel is Crated by G-devs (Codecanyon.net)
   
      });
</script>