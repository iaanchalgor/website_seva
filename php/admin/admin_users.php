<?php
/*
require_once('admin_header.php');

?>


<br /><br />
<div class="container">
  <h1>USERS</h1>
  <br>
  <table class="table">
    <tr>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Gender</th>
      <th>Email</th>
      <th>Phone No.</th>
      <th>Birthdate</th>
      <th>Address</th>
      <th colspan="2">Actions</th>
    </tr>
	
	<tbody id="tbody1">
				</tbody>
	</table>
	
			<script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-app.js"></script>
			<script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-auth.js"></script>
			<script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-firestore.js"></script>
			
			
			<script>
			
			
			


  
		const firebaseConfig = {
		  apiKey: "AIzaSyAqRZyrj5EGKGPEUkwMHeMBqxgvBECg9Dc",
		  authDomain: "lastt-93374.firebaseapp.com",
		  projectId: "lastt-93374",
		  storageBucket: "lastt-93374.appspot.com",
		  messagingSenderId: "1078571611705",
		  appId: "1:1078571611705:web:b4a19206bc02188d31bfe8"
		};

  
  			firebase.initializeApp(firebaseConfig);
			let db = firebase.firestore();

				
			function GetAllDataOnce(){
				
				
			db.collection("register").get()
			.then((querySnapshot) => {
				var student = [];
				querySnapshot.forEach(doc => {
					student.push(doc.data());
				});
				console.log(querySnapshot);
				console.log(student);
				AddItemsToTheTable(register);
			})
			.catch((error) => {
				console.error("Error fetching data: ", error);
			});
		}
		
		
			function GetAllDataRealtime(){
				db.collection("register").get().onSnapshot((querySnapshot)=>{
					var student=[];
					querySnapshot.forEach(doc => {
						student.push(doc.data());
					});
					AddItemToTABLE(register);
				});
			}

			var stdNo=0;
			var tbody = document.getElementById('tbody1');

			
	function AddItemToTABLE(fname,lname,gen,email,phno,birthdate,address) {
    var trow = document.createElement("tr");
    var td1 = document.createElement("td");
    var td2 = document.createElement("td");
    var td3 = document.createElement("td");
    var td4 = document.createElement("td");
    var td5 = document.createElement("td");
    var td6 = document.createElement("td");
    var td7 = document.createElement("td");

    td1.textContent = fname; 
    td2.textContent = lname;
    td3.textContent =gen;
    td4.textContent = email;
    td5.textContent = phno;
    td6.textContent =birthdate ;
    td7.textContent = address;

    trow.appendChild(td1);
    trow.appendChild(td2);
    trow.appendChild(td3);
    trow.appendChild(td4);
    trow.appendChild(td5);
    trow.appendChild(td6);
    trow.appendChild(td7);

}



			function AddItemsToTheTable(registerDocsList){
				stdNo=0;
				tbody.innerHTML="";
				registerDocsList.forEach(element => {
					AddItemToTABLE(element.fname, element.lname,element.gen, element.email,element.phno,element.birthdate,element.address)
				});
			}
			window.onload = GetAllDataOnce;


				
			</script>

<?php require_once('admin_footer.php') */?>


<?php require_once('admin_header.php'); ?>

<br /><br />
<div class="container">
  <h1>USERS</h1>
  <br>
  <table class="table">
    <tr>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Gender</th>
      <th>Email</th>
      <th>Phone No.</th>
      <th>Birthdate</th>
      <th>Address</th>
      <th colspan="2">Actions</th>
    </tr>
	
	<tbody id="tbody1">
	</tbody>
  </table>
</div>

<script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-firestore.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   const firebaseConfig = {
		  apiKey: "AIzaSyAqRZyrj5EGKGPEUkwMHeMBqxgvBECg9Dc",
		  authDomain: "lastt-93374.firebaseapp.com",
		  projectId: "lastt-93374",
		  storageBucket: "lastt-93374.appspot.com",
		  messagingSenderId: "1078571611705",
		  appId: "1:1078571611705:web:b4a19206bc02188d31bfe8"
		};
    firebase.initializeApp(firebaseConfig);
    let db = firebase.firestore();

    $(document).ready(function() {
        fetchData();
    });

    function fetchData() {
        $.ajax({
            url: 'admin_users.php',
            type: 'GET',
            success: function(response) {
                // Process the response and update your HTML table
                var data = JSON.parse(response);
                addDataToTable(data);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    function addDataToTable(data) {
        var tbody = $('#tbody1');
        tbody.empty(); // Clear existing data
        data.forEach(function(item) {
            var row = '<tr>' +
                      '<td>' + item.fname + '</td>' +
                      '<td>' + item.lname + '</td>' +
                      '<td>' + item.gen + '</td>' +
                      '<td>' + item.email + '</td>' +
                      '<td>' + item.phno + '</td>' +
                      '<td>' + item.birthdate + '</td>' +
                      '<td>' + item.address + '</td>' +
                      '<td>Actions</td>' +
                      '</tr>';
            tbody.append(row);
        });
    }
</script>

<?php require_once('admin_footer.php'); ?>
