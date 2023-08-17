// Function to fetch the course list from the server
function fetchCourseList() {
  const courseList = document.getElementById("courseList");

  // Send an AJAX request to fetch the course list
  const xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // Parse the JSON response
        const response = JSON.parse(xhr.responseText);

        // Clear the course list
        courseList.innerHTML = "";

        // This loops through the json response and display each item with a checkbbox
        response.forEach((course) => {
          const listItem = document.createElement("li");
          const checkbox = document.createElement("input");
          checkbox.type = "checkbox";
          checkbox.value = course;
          listItem.appendChild(checkbox);
          listItem.appendChild(document.createTextNode(course));
          courseList.appendChild(listItem);
        });
      } else {
        console.error("Error fetching course list:", xhr.status);
      }
    }
  };

  xhr.open("GET", "ajax.php?action=getCourseList", true);
  xhr.send();
}

// Function to add selected courses to the user courses section and a deletion functionality
function addCourses() {
  const courseList = document.getElementById("courseList");
  const UserCourses = document.getElementById("UserCourseList");

  // Get all selected checkboxes
  const checkboxes = courseList.querySelectorAll(
    'input[type="checkbox"]:checked'
  );

  // Check if the number of course is > than 5
  if (checkboxes.length + UserCourses.childElementCount > 5) {
    alert("You are only allowed to add 5 courses.");
    return;
  }

  // Iterate over the selected checkboxes
  checkboxes.forEach((checkbox) => {
    // Create a list item for the selected course
    const listItem = document.createElement("li");
    const courseName = checkbox.parentNode.textContent.trim();
    listItem.innerText = courseName;

    // Create a delete button for the course
    const deleteButton = document.createElement("button");
    deleteButton.innerText = "Delete";
    deleteButton.addEventListener("click", function () {
      // Remove the course from the
      UserCourses.removeChild(listItem);

      // Append the course back to the course list
      const courseItem = document.createElement("li");
      const courseCheckbox = document.createElement("input");
      courseCheckbox.type = "checkbox";
      courseCheckbox.value = courseName;
      courseItem.appendChild(courseCheckbox);
      courseItem.appendChild(document.createTextNode(courseName));
      courseList.appendChild(courseItem);
    });

    // Append the delete button to the list item
    listItem.appendChild(deleteButton);

    // Add the course to the usercourse section with the coursename and a delete button
    UserCourses.appendChild(listItem);

    // Remove the course checkbox from the course list
    checkbox.parentNode.parentNode.removeChild(checkbox.parentNode);
  });
}

function submitComment() {
  var commentText = document.getElementById("comment");

  // Get the comment value
  var comment = commentText.value;

  // Validate if the comment is not empty
  if (comment.trim() !== "") {
    // Prepare the mailto link
    var mailtoLink =
      "mailto:Vesile@gmail.com" +
      "?subject=Comment" +
      "&body=" +
      encodeURIComponent(comment);

    // Open the default email client with the mailto link
    window.location.href = mailtoLink;

    // Clear the comment textarea
    commentText.value = "";
  } else {
    // Display an alert for empty comment
    alert("Please enter a comment");
  }
}

// Fetch the course list when the page loads
window.onload = function () {
  fetchCourseList();
};
