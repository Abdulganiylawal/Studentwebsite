// This reads the xml file and returns the xml information
function readXml(xml) {
  const students = xml.getElementsByTagName("Student");
  const studentData = [];
  for (let i = 0; i < students.length; i++) {
    const studentNo =
      students[i].getElementsByTagName("StudentNo")[0].textContent;
    const name = students[i].getElementsByTagName("Name")[0].textContent;
    const surname = students[i].getElementsByTagName("Surname")[0].textContent;
    studentData.push({
      studentNo,
      name,
      surname,
    });
  }
  return studentData;
}

// Validate login
function validateLogin(username, password, studentData) {
  // Loops through the student data
  for (let i = 0; i < studentData.length; i++) {
    const student = studentData[i];
    // Checks if the current student matches any student in the xml file
    if (
      (username === student.name || username === student.surname) &&
      password === student.studentNo
    ) {
      return true; // Login successful
    }
  }
  return false; // Login failed
}

function validateUsername() {
  const usernameInput = document.getElementById("username");
  const username = usernameInput.value;

  // Replaces all the non-alphabetic characters with an empty string from the username
  const newUsername = username.replace(/[^A-Za-z\s]/g, "");

  // Update the input field value with the new value
  usernameInput.value = newUsername;

  // Display an Error if the username is not ideal
  const usernameError = document.getElementById("usernameError");
  if (username !== newUsername || !/^[A-Za-z\s]+$/.test(username)) {
    usernameError.textContent = "Please enter only alphabetic characters";
  } else {
    usernameError.textContent = "";
  }
}

function validatePassword() {
  const passwordInput = document.getElementById("password");
  const password = passwordInput.value;

  // Check if password length is less than 6
  const passwordError = document.getElementById("passwordError");
  if (password.length < 6) {
    passwordError.textContent = "Password must be at least 6 characters long";
  } else {
    passwordError.textContent = "";
  }
}

// This loads the xml file and is responsible for seguing user to registration page
function login() {
  const username = document.getElementById("username").value;
  const password = document.getElementById("password").value;

  // Load and parse the XML data
  const xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
      const xmlDoc = this.responseXML;
      const studentData = readXml(xmlDoc);

      // Validate login credentials
      const loginSuccess = validateLogin(username, password, studentData);

      // If successful segue the user to the register.php page with the username and password this will be useful in the register.php page
      if (loginSuccess) {
        window.location.href = `Registration/register.php?username=${username}&password=${password}`;
      } else {
        alert("Failed Login. Please check your username and password.");
      }
    }
  };
  xhttp.open("GET", "Student.xml", true);
  xhttp.send();
}
