// credentials for login into myphp admin
<?php
$host = 'localhost';
$db_name = 'student_info_db';
$username = 'root';
$password = '';

// Create a database connection
$connection = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);

// Create the student table if it doesn't exist
$createTableQuery = "
    CREATE TABLE IF NOT EXISTS student (
        id INT AUTO_INCREMENT PRIMARY KEY,
        student_number VARCHAR(10) NOT NULL,
        name VARCHAR(50) NOT NULL,
        lastname VARCHAR(50) NOT NULL,
        photo VARCHAR(255) NOT NULL,
        department VARCHAR(50) NOT NULL,
        cgpa DECIMAL(3, 2) NOT NULL,
        semester VARCHAR(10) NOT NULL
    )
";

$connection->exec($createTableQuery);

// Insert some student.xml data
$dummyData = [
    [
        'student_number' => '140306',
        'name' => 'OLGU',
        'lastname' => 'ACUN',
        'photo' => 'assets/Background.jpeg',
        'department' => 'BSc IN COMPUTER ENGINEERING',
        'cgpa' => 3.75,
        'semester' => '5th'
    ],
    [
        'student_number' => '150030',
        'name' => 'CENK ALEN',
        'lastname' => 'SEHIROGLU',
         'photo' => 'assets/Background.jpeg',
        'department' => 'BSc IN COMPUTER ENGINEERING',
        'cgpa' => 3.60,
        'semester' => '6th'
    ],
    [
        'student_number' => '164602',
        'name' => 'FUNGAI',
        'lastname' => 'GADZIRA',
         'photo' => 'assets/Background.jpeg',
        'department' => 'BSc IN SOFTWARE ENGINEERING',
        'cgpa' => 3.85,
        'semester' => '7th'
    ],
    [
        'student_number' => '170086',
        'name' => 'MERTCAN',
        'lastname' => 'ARAS',
         'photo' => 'assets/Background.jpeg',
        'department' => 'BSc IN COMPUTER ENGINEERING',
        'cgpa' => 3.70,
        'semester' => '6th'
    ],
    [
        'student_number' => '170090',
        'name' => 'MUSTAFA BERKIN',
        'lastname' => 'CIHAN',
         'photo' => 'assets/Background.jpeg',
        'department' => 'BSc IN COMPUTER ENGINEERING',
        'cgpa' => 3.80,
        'semester' => '7th'
    ]
];

// This shows what database query it is going to perform
$insertQuery = "
    INSERT INTO student (student_number, name, lastname, photo, department, cgpa, semester)
    VALUES (:student_number, :name, :lastname, :photo, :department, :cgpa, :semester)
";

$statement = $connection->prepare($insertQuery);

// This performs each query on the individual student.xml dummy data
foreach ($dummyData as $data) {
    $statement->execute($data);
}
?>
