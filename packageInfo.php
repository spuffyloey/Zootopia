<!DOCTYPE html>
<html>
<head>
    <title>Package Details</title>
    <style>
        * {
            margin: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: url(img/bg3.jpg) no-repeat center center/cover;
            height: 100vh;
            margin-top: 80px;
        }
        header {
            background-color: #000;
            width: 100%;
            position: fixed;
            top: 0;
            z-index: 999;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 200px;
        }
        .Logo {
            text-decoration: none;
            color: #fff;
            text-transform: uppercase;
            font-weight: 700;
            font-size: 1.8em;
        }
        .nav {
            display: flex;
        }
        .nav a {
            color: #fff;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.5em;
            padding-left: 32px;
        }
        .nav a:hover {
            color: blue;
        }
        body {
            background-color: #F6F5F2;
            font-family: Arial, sans-serif;
            padding-top: 20px;
        }
        table {
            width: 60%;
            border-collapse: collapse;
            margin-right: auto;
            margin-left: auto;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        tr:nth-child(odd) {
            background-color: rgba(255, 255, 255, 0.8); 
        }

        tr:nth-child(even) {
            background-color: white;
        }

        th {
            background-color: #153448;
            color: white;
        }

        .add-btn {
            color: azure;
            background-color: rgb(0, 0, 0);
            text-decoration: none;
            font-size: 1.1em;
            font-weight: 600;
            display: inline-block;
            padding: 0.9375em 2.1875em;
            letter-spacing: 1px;
            border-radius: 10px;
            margin-top: 40px;
            transition: 0.7s ease;
            justify-content: center;
            margin-left: 300px;
        }
        .add-btn:hover {
            background-color: rgb(50, 50, 104);
            transform: scale(1.1);
        }
        h1 {
            margin-bottom: 20px;
            margin-left: 305px;
            color: black;
        }
        .btn {
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 400;
            color: white;
            background-color: #153448;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }
        .hide-btn {
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 400;
            color: white;
            background-color: #b33a3a;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .hide-btn:hover {
            background-color: #800000;
        }
    </style>
</head>
<body>
    <header>
        <a href="adminindex.php" class="Logo">Zootopia &Co</a>
        <nav class="nav">
            <a href="adminindex.php">HOME</a>
        </nav>
    </header>
    <h1>Package Details</h1>
    <table border=1>
    <thead>
        <tr>
            <th>PACKAGE NO</th>
            <th>PACKAGE NAME</th>
            <th>PACKAGE DESCRIPTION</th>
            <th>PACKAGE PRICE</th>
            <th colspan='3'>OPTION</th>
        </tr>
    </thead>
    <tbody>
    <?php
    include("dbconn.php");
    $sql = "SELECT * FROM package";
    $query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));
    $row = mysqli_num_rows($query);
    if ($row == 0) {
        echo "<tr><td colspan='5'>No record found</td></tr>";
    } else {
        while ($row = mysqli_fetch_array($query)) {
            $packageNo = $row["package_no"];
            echo "<tr data-package-no='$packageNo'>";
            echo "<td>" . $row["package_no"] . "</td>";
            echo "<td>" . $row["package_name"] . "</td>";
            echo "<td>" . $row["package_desc"] . "</td>";
            echo "<td>" . $row["package_price"] . "</td>";
            echo "<td><a class='btn' onclick='confirmDelete($packageNo)'>Delete</a></td>";
            echo "<td><a class='btn' href='updatePack.php?v_id=$packageNo'>Update</a></td>";
            echo "<td><button class='btn hide-btn' data-package-no='$packageNo'>Hide</button></td>";
            echo "</tr>";
        }
    }
    ?>
    </tbody>
    </table>
    <div class="center">
        <a href="addNewPack.php" class="add-btn">Add New Package</a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hideButtons = document.querySelectorAll('.hide-btn');
            hideButtons.forEach(button => {
                const packageNo = button.dataset.packageNo;

                // Set initial button state based on localStorage
                if (localStorage.getItem('hiddenPackage-' + packageNo)) {
                    button.textContent = 'Unhide';
                }

                button.addEventListener('click', function() {
                    if (localStorage.getItem('hiddenPackage-' + packageNo)) {
                        localStorage.removeItem('hiddenPackage-' + packageNo);
                        button.textContent = 'Hide';
                    } else {
                        localStorage.setItem('hiddenPackage-' + packageNo, 'true');
                        button.textContent = 'Unhide';
                    }
                    console.log('Package ' + packageNo + ' hidden status: ' + localStorage.getItem('hiddenPackage-' + packageNo));
                });
            });
        });
        function confirmDelete(packageNo) {
            if (confirm('Are you sure you want to delete package ' + packageNo + '? This action cannot be undone.')) {
                window.location.href = 'deletePack.php?v_id=' + packageNo;
            }
        }
    </script>
</body>
</html>
