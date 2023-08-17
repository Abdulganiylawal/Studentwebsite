<?php
// This is responsibble for returning the course list to fetchCourseList() function in register.js
if ($_GET['action'] === 'getCourseList') {
  // An Array of example courses
  $courseList =  [
  "Introduction to Algorithms",
  "Data Structures and Algorithms",
  "Object-Oriented Programming",
  "Software Engineering Principles",
  "Web Development",
  "Mobile App Development",
  "Database Systems",
  "Operating Systems",
  "Network Security",
  "Machine Learning"
];

  // Return the course list as JSON
  echo json_encode($courseList);
}
?>
