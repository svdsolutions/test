<?php 

  include "codehead.php";

 if (isset($_GET['del_id'])) {

	# code...
	$id = $_GET['del_id'];
	echo "  wait Reloading...";


 ?>

 <input type="hidden" name="name" id="myText" value="<?php echo $id ?>">

 <?php } ?>

 <script>
 	var x = document.getElementById("myText").value;
    alert("Deleted Data Successfully");
    var dbCategories1 = firebase.database().ref("ymg");
   dbCategories1.on("value", function(categories){

   	categories.forEach(function(category){
    firebase.database().ref('ymg/'+x+'/') 
      .remove()
        window.location="manage_quotes.php"; 

    });

  // if(confirm('Are you sure?')){
  //   categories.forEach(function(category){
  //   firebase.database().ref('categories/'+x+'/') 
  //     .remove()
  //       window.location="manage_category.php"; 

  //   });
  // }
   
      });
</script>