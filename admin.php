<?php
// Database connection parameters
$servername = "localhost"; // Change this if your database is hosted elsewhere
$username = "root"; // Change this to your database username
$password = "2005"; // Change this to your database password
$dbname = "gym"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch table data based on the selected option
function fetchTableData($tableName, $conn) {
    $sql = "SELECT * FROM $tableName";
    $result = $conn->query($sql);

    // Output data of each row
    echo "<table>
            <tr>
                <th>ID</th>";
    if ($tableName == "login_users") {
        echo "<th>Username</th>
              <th>Password</th>";
    } elseif ($tableName == "membership") {
        echo "<th>Membership ID</th>
              <th>Username</th>
              <th>Gender</th>
              <th>Plan</th>
              <th>Services</th>
              <th>Created At</th>";
    } elseif ($tableName == "registration") {
        echo "<th>ID</th>
              <th>Full Name</th>
              <th>Email</th>
              <th>Message</th>";
    } elseif ($tableName == "contacts") {
        echo "<th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Subject</th>
              <th>Message</th>";
    }
    echo "</tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>" . $value . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

// Function to generate Excel file from table data
function generateExcel($tableName, $conn) {
    $sql = "SELECT * FROM $tableName";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $filename = $tableName . "_data_" . date('Ymd') . ".xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Pragma: no-cache");
        header("Expires: 0");

        // Output column headers
        $output = "ID";
        foreach ($result->fetch_fields() as $field) {
            $output .= "\t" . $field->name;
        }
        $output .= "\n";

        // Output data
        while ($row = $result->fetch_assoc()) {
            $output .= implode("\t", $row) . "\n";
        }

        echo $output;
        exit;
    } else {
        echo "No data found";
    }
}

// Check if the download button is clicked
if (isset($_POST['download'])) {
    $tableName = $_POST['tableName'];
    generateExcel($tableName, $conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Database</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        h2 {
            text-align: center;
            margin-top: 30px;
            color: #333;
        }

        #tableContainer {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        select {
            padding: 10px;
            margin-bottom: 20px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .download-button {
            text-align: center;
        }

        .download-button input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .download-button input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<h2>Gym Database</h2>
<div id="tableContainer">
    <select id="tableSelect">
        <option value="login_users">Login Users</option>
        <option value="membership">Membership</option>
        <option value="registration">Registration</option>
        <option value="contacts">Contact</option>
    </select>
    <div id="tableData">
        <?php
        // Initial load: Fetch data for the first option (Login Users)
        if (isset($_GET['tableName'])) {
            $tableName = $_GET['tableName'];
            fetchTableData($tableName, $conn);
        } else {
            fetchTableData("login_users", $conn);
        }
        ?>
    </div>
    <!-- Add the Download button -->
    <div class="download-button">
        <form id="downloadForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" id="tableName" name="tableName" value="login_users"> <!-- Default table -->
            <input type="submit" value="Download Excel" name="download">
        </form>
    </div>
</div>

<script>
    // JavaScript to handle table selection change and fetch data accordingly
    document.getElementById("tableSelect").addEventListener("change", function () {
        var tableName = this.value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("tableData").innerHTML = this.responseText;
                document.getElementById("tableName").value = tableName; // Update hidden field value
            }
        };
        xhttp.open("GET", "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?tableName=" + tableName, true);
        xhttp.send();
    });
</script>

</body>
</html>

<?php
// Close connection
$conn->close();
?>
