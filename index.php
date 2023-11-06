<?php
require 'function.php';

$php_errormsg = ''; // Initialize the error message variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $gender = $_POST['Gender'];
    $city = $_POST['City'];

    // Validate input (check if fields are empty)
    if (empty($name) || empty($email) || empty($gender) || empty($city)) {
        $php_errormsg = "All fields are required";
    } else {
        // Use prepared statements to avoid SQL injection
        try {
            $pdo = connecttoDb();
            $sql = "INSERT INTO user_info (name, email, gender, city) VALUES (:name, :email, :gender, :city)";
            $statement = $pdo->prepare($sql);

            // Bind parameters
            $statement->bindParam(':name', $name);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':gender', $gender);
            $statement->bindParam(':city', $city);

            // Execute the statement
            $statement->execute();
            //Connect to page contating table 
            header("Location: data.php"); 
            exit();
        } catch(PDOException $e) {
            // Handle database errors
            $php_errormsg = "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<marquee class="marq"><i>*Do not miss chance when it comes to trip </i></marquee><br><br>
<center><h2>This festive Season,make sure you Drip,Sleep and Trip</h2></center>
    <center><h1>Urban Exploration</h1></center>

    <div class="Form">

        <form method="post">
        <h2> Registration Form</h2>
        
                <label>Name:</label>
                <input type="text" name="Name" class="form-control">
                 <label>Email:</label>
                <input type="email" name="Email" class="form-control">
                <label>Gender:
                <input type="radio" value="MALE" name="Gender" class="form1">Male
                <input type="radio" value="FEMALE" name="Gender" class="form1" >Female 
                </label>
                <br></br>
                <label>City:</label>
                <select name="City" class="form-control">
                    <option value="Nagpur">Nagpur</option>
                    <option value="Mumbai">Mumbai</option>
                    <option value="Hyderabad">Manali</option>
                    <option value="Delhi">Delhi</option>
                    <option value="Bangalore">Bangalore</option>
                    <option value="Pune">Pune</option>
                    <option value="Hyderabad">Hyderabad</option>
                    <option value="Hyderabad">Chennai</option>
                </select>
            
            
                <input type="submit" value="Submit" id="button">
</div>
        </form>

    

    <?php
    // Display error message if any
    if (!empty($php_errormsg)) {
        echo "<p>Error: $php_errormsg</p>";
    }
    ?>
</body>
</html>
