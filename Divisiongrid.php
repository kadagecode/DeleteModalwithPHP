<?php
$con = @mysqli_connect("localhost", "root", "", "project");
if (mysqli_connect_error())
    exit("Mysql Error: " . mysqli_connect_error());
$query = "SELECT * FROM division";
$result = mysqli_query($con, $query) or die("Query Error: " . mysqli_error($con));
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
             font-family: Arial, sans-serif; 

            
        }

        .container {
            display: grid;
             grid-template-columns: repeat(1, 1fr); 
            grid-gap: 20px;
            justify-content: center;
            align-items: center;
             margin-top: 20px;
        }

        table {
            width: 100%;
             border-collapse: collapse; 
            
        }

        th {
            padding: 8px;
            background-color: khaki;
            border-bottom: 2px solid #999;
            white-space: nowrap; /* Prevent text wrapping */
            line-height: 30px;
            white-space: nowrap;
              /* border-right:  1px thin;  */
              
        } 

        
        td {
            padding: 8px;
            border-bottom: 1px solid #999;
            line-height: 30px;
            background-color: seashell;
           border-right: 1px solid lightgray;
            border-collapse: collapse;
        }
        .th{
            font-size: larger;
        }

        a {
            text-decoration: none;
            color: #333;
        }
        #new
        {
            text-align: justify;
        }
        #new:hover {
            color: #000;
            font-weight: bold;
        }
       
        #new:link, #new:visited {
            text-align: center;
            color: white;
            padding: 14px 25px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            background-color: lightgreen;
        }

           #new:hover, #new:active {
             background-color: green;
         }
         
         #edit:hover {
            color: #000;
            font-weight: bold;
        }
       
        #edit:link, #edit:visited {
            text-align: center;
            color: white;
             padding: 14px 30px; 
            text-align: center;
            text-decoration: none;
            display: inline-block;
            background-color: lightblue;
        }

           #edit:hover, #edit:active {
             background-color: blue;
         }
         #delete:hover {
            color: #000;
            font-weight: bold;
        }
       
        #delete:link, #delete:visited {
            text-align: center;
            color: white;
            padding: 14px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            background-color: lightcoral;
        }

           #delete:hover, #delete:active {
             background-color: red;
         }
         #view:hover {
            color: #000;
            font-weight: bold;
        }
       
        #view:link, #view:visited {
            text-align: center;
            color: white;
            padding: 14px 26px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            background-color: lightpink;
        }

           #view:hover, #view:active {
             background-color: pink;
         }
         @media (min-width: 500px) {
            table {
                font-size: 12px; /* Reduce font size for smaller screens */
            }
            .container {
                grid-template-columns: repeat(1, 1fr); /* Show 3 columns on even larger screens */
            }
        }
            @media (min-width: 1000px) {
            .container {
                grid-template-columns: repeat(1, 1fr); /* Show 3 columns on even larger screens */
            }
        }
        @media (min-width: 1800px) {
            .container {
                grid-template-columns: repeat(1, 1fr); /* Show 3 columns on even larger screens */
            }
        }
        
    </style>
</head>
<body>
    <a href='new_Division.php' id="new"  >NEW</a>
    <div class="container">
        <table>
            <tr>
                <th class="th">Sr_No</th>
                <th class="th">Region</th>
                <th class="th">Circle</th>
                <th class="th">Division</th>
                <th class="th">Address1</th>
                <th class="th">Address2</th>
                <th class="th">Place</th>
                <th class="th">Email</th>
                <th class="th">Phone_No</th>
                <th class="th">Designation</th>
                <th class="th">Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_array($result)): ?>
                <tr>
                    <td><?= $row["Sr_No"] ?></td>
                    <td><?= $row["Region"] ?></td>
                    <td><?= $row["Circle"] ?></td>
                    <td><?= $row["Division_Name"] ?></td>
                    <td><?= $row["Address1"] ?></td>
                    <td><?= $row["Address2"] ?></td>
                    <td><?= $row["Place"] ?></td>
                    <td><?= $row["Email"] ?></td>
                    <td><?= $row["Phone_No"] ?></td>
                    <td><?= $row["Designation"] ?></td>
                    <td>
                    
                        <a  id="edit"href="edit_division.php?Sr_No=<?= $row['Sr_No'] ?>">Edit</a>
                        &nbsp;
                         <a id="delete" href="#" data-id="<?= $row['Sr_No'] ?>">Delete</a>

                        <!-- <button onclick="document.getElementById('id01').style.display='block'">Open Modal</button> -->
                        &nbsp;
                        <a id="view" href="view_division.php?Sr_No=<?= $row['Sr_No'] ?>">View</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        </div>
        
        <!-- <form id="deleteForm" method="POST" action="actdel_division.php">
    <input type="hidden" name="Sr_No" value="">
</form> -->

        <!-- delete modal code for page -->
        <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h2>Confirmation</h2>
            <p>Are you sure you want to delete this division?</p>
            <div class="modal-buttons">
                <button onclick="deleteDivision()">Delete</button>
                <button onclick="closeModal()">Cancel</button>
            </div>
        </div>
    </div>

    



    <script>
    // JavaScript functions to show/hide modal and handle deletion
    function deleteDivision(divisionId) {
        // Set the division ID in a hidden input field in the form
        document.getElementById('deleteForm').querySelector('input[name="Sr_No"]').value = divisionId;
        // Submit the form to deleteconf.php
        document.getElementById('deleteForm').submit();
    }

    function closeModal() {
        document.getElementById('deleteModal').style.display = 'none';
    }

    // Delete the division using AJAX
    function performDivisionDeletion(divisionId) {
        // AJAX request to delete the division
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'actdel_division.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Division deleted successfully
                closeModal();
                var divisionRow = document.getElementById('divisionRow_' + divisionId);
                divisionRow.parentNode.removeChild(divisionRow);
            }
        };
        xhr.send('divisionId=' + divisionId);
    }

    // Show the modal when the delete link is clicked
    var deleteLinks = document.querySelectorAll('#delete');
    for (var i = 0; i < deleteLinks.length; i++) {
        deleteLinks[i].addEventListener('click', function(event) {
            event.preventDefault();
            var divisionId = this.getAttribute('data-id');
            document.getElementById('deleteModal').style.display = 'block';
            document.getElementById('deleteModal').setAttribute('data-division-id', divisionId);
        });
    }

    // Attach event listener to the delete button in the modal
    var deleteButton = document.getElementById('deleteButton');
    deleteButton.addEventListener('click', function() {
        var divisionId = document.getElementById('deleteModal').getAttribute('data-division-id');
        performDivisionDeletion(divisionId);
    });
</script>




</body>
</html>
<style>

        /* Add your CSS styles for the modal here */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }
        
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        
        .modal h2 {
            margin-bottom: 10px;
        }
        
        .modal p {
            margin-bottom: 20px;
        }
        
        .modal-buttons {
            text-align: right;
        }
        
        .modal-buttons button {
            margin-left: 10px;
        }
    </style>


       