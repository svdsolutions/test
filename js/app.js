 // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyDh-wO3jVjyZMOeasvr7QB3EqBfDhtQ-Xc",
    authDomain: "svd-live-tv.firebaseapp.com",
    databaseURL: "https://svd-live-tv-default-rtdb.firebaseio.com",
    projectId: "svd-live-tv",
    storageBucket: "svd-live-tv.appspot.com",
    messagingSenderId: "71901113028",
    appId: "1:71901113028:web:ea3ad17776b2381d02f791"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
    firebase.auth.Auth.Persistence.LOCAL; 

    $("#btn-login").click(function(){
        
        var email = $("#email").val();
        var password = $("#password").val(); 

        var result = firebase.auth().signInWithEmailAndPassword(email, password);
    
        result.catch(function(error){
            var errorCode = error.code; 
            var errorMessage = error.message; 

            console.log(errorCode);
            console.log(errorMessage);
        });

    });

    $("#btn-logout").click(function(){
        firebase.auth().signOut();
    });

    function switchView(view){
        $.get({
            url:view,
            cache: false,  
        }).then(function(data){
            $("#container").html(data);
        });
    }