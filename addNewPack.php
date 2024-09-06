<!DOCTYPE html>
<html>
<head>
  <style>
    /* Global Styles */
    * {
      margin: 0;
      box-sizing: border-box;
    }
    body {
      font-family: Arial, sans-serif;
      padding-top: 80px; /* Prevent content from hiding behind the fixed header */
      background-color: #F0F8FF;
    }

    /* Form Styles */
    header {
      background-color: #000; /* Hex color code for consistency */
      width: 100%;
      position: fixed;
      top: 0;
      z-index: 999;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 200px; /* Adjust padding as needed */
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

    form {
      max-width: 700px; /* Increased max-width */
      margin: 40px auto;
      padding: 20px; /* Increased padding */
      background-color: #fff;
      border: 1px solid #ddd;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 13px; /* Increased padding */
      border: 0px solid #ddd;
    }

    th {
      background-color: #153448;
      color: #fff;
      text-align: center;
    }

    td {
      text-align: left;
    }

    input[type="text"] {
      width: 100%;
      padding: 15px; /* Increased padding */
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 1.1em; /* Increased font size */
    }

    input[type="submit"] {
      background-color: #153448;
      color: #fff;
      padding: 15px 30px; /* Increased padding */
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 1.1em; /* Increased font size */
    }

    input[type="submit"]:hover {
      background-color: #102233;
    }

    .zoo-theme form {
      background-color: rgba(255, 255, 255, 0.8);
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .zoo-theme th {
      background-color: black;
      color: #fff;
      text-align: center;
      font-size: 18px;
      font-weight: bold;
    }

    .zoo-theme input[type="submit"] {
      background-color: black;
      color: #fff;
      padding: 15px 30px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      font-size: 18px;
      font-weight: bold;
    }

    .zoo-theme input[type="submit"]:hover {
      background-color: #102233;
    }
  </style>
  <title>Add Package</title>
</head>

<body>
  <header>
    <a href="adminindex.php" class="Logo">Zootopia &Co</a>
    <nav class="nav">
    <a href="packageInfo.php">BACK</a>
      <a href="adminindex.php">HOME</a>
    </nav>
  </header>

  <div class="zoo-theme">
    <form action="AddProcess.php" method="post">
      <table>
        <tr>
          <th colspan="3">Package Detail Information</th>
        </tr>
        <tr>
          <td>PACKAGE NAME</td>
          <td>:</td>
          <td><input type="text" name="package_name" value="" required></td>
        </tr>
        <tr>
          <td>PACKAGE DESCRIPTION</td>
          <td>:</td>
          <td><input type="text" name="package_desc" value="" required></td>
        </tr>
        <tr>
          <td>PACKAGE PRICE</td>
          <td>:</td>
          <td><input type="text" name="package_price" value="" required></td>
        </tr>
        <tr>
          <td colspan="3" style="text-align: center;">
            <input type="submit" name="add" value="Add New Data">
          </td>
        </tr>
      </table>
    </form>
  </div>
</body>
</html>
