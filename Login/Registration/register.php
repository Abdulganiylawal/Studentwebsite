<?php
// Check if the user is logged in
if (!isset($_GET['username']) || !isset($_GET['password'])) {
  // Redirect to the login page
  header("Location: Login.html");
  exit();
}

// Retrieve the username and password from URL parameters
$username = $_GET['username'];
$password = $_GET['password'];

// // credentials for login into my database
$servername = "localhost";
$dbname = "student_info_db";
$username_db = "root";
$password_db = "";


// This connect to the existing database
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username_db, $password_db);
  // Prepare and execute the SQL query to fetch user information
  $stmt = $conn->prepare("SELECT * FROM student WHERE name = ? OR lastname = ? AND student_number = ?");
  $stmt->execute([$username, $username, $password]);
  $studentData = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="register.css" />
  </head>
  <body>
    <div class="container">
      <div class="section">
        <h2>User Information</h2>
        <!-- // Loop through the user information gotten from the database -->
        <?php foreach ($studentData as $student) : ?>
          <div class="user-card">
            <div class="user-image">
            <!-- // I am using a picture that is stored in the asset folder, it is retrieved from my database -->
              <img src="/<?php echo $student['photo']; ?>" alt="Profile Image">
            </div>
            <div class="user-details">
              <p><span>Student Number:</span> <?php echo $student['student_number']; ?></p>
              <p><span>Name:</span> <?php echo $student['name']; ?></p>
              <p><span>Surname:</span> <?php echo $student['lastname']; ?></p>
              <p><span>Department:</span> <?php echo $student['department']; ?></p>
              <p><span>CGPA:</span> <?php echo $student['cgpa']; ?></p>
              <p><span>Semester:</span> <?php echo $student['semester']; ?></p>
            </div>
          </div>
        <?php endforeach; ?>

      </div>

      <div class="section">
        <h2>Course Selection</h2>
        <ul id="courseList">
          <!-- Courses will be dynamically added here -->
        </ul>
        <!-- This functionality calls the addCourses function in register.js-->
        <button onclick="addCourses()">Add</button>
      </div>

      <div class="section">
        <h2>User Courses</h2>
        <ul id="UserCourseList">
          <!-- Selected courses will be dynamically added here -->
        </ul>
      </div>

      <div class="section comment-section">
        <h2>Comment</h2>
        <textarea id="comment" rows="4" cols="50"></textarea>
        <!-- This calls the submit course function in register.js -->
        <button onclick="submitComment()">Submit</button>
      </div>
    </div>
    <script src="register.js"></script>
  </body>
</html>
