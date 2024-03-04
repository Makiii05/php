<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Delivery Management</title>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-color: #f8f8f8;
    }

    .container {
        display: flex;
        justify-content: space-between;
        align-items: stretch;
        height: 100vh;
    }

    .left-div {
        flex: 0 0 30%;
        background-color: #fff;
        padding: 20px;
        box-sizing: border-box;
    }

    .right-div {
        flex: 0 0 70%;
        background-color: #fff;
        padding: 20px;
        box-sizing: border-box;
    }

    .btn-container {
        margin-bottom: 20px;
    }

    .btn {
        display: block;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        text-align: center;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-bottom: 10px;
    }

    .btn:last-child {
        margin-bottom: 0;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    .btn1-container {
        margin-bottom: 20px;
    }

    .btn1 {
        display: block;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        text-align: center;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
        margin-bottom: 10px;
    }

    .btn1:last-child {
        margin-bottom: 0;
    }

    .btn1:hover {
        background-color: #0056b3;
    }

    .heading {
        margin-top: 0;
    }

    form {
        margin-bottom: 20px;
    }

    form input[type="text"],
    form input[type="date"],
    form select,
    form input[type="number"],
    form input[type="submit"] {
        margin-bottom: 10px;
        padding: 8px;
        width: calc(100% - 20px);
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    form input[type="submit"] {
        background-color: #28a745;
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    form input[type="submit"]:hover {
        background-color: #218838;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th,
    table td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
    }

    table th {
        background-color: #007bff;
        color: #fff;
    }

    table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    table tr:hover {
        background-color: #ddd;
    }

    /* Hide buttons initially */
    .hidden {
        display: none;
    }

    .header {
        background-color: #007bff;
        color: #fff;
        padding: 10px;
        text-align: center;
        margin-bottom: 20px;
    }
</style>
</head>
<body>

<div class="header">
    <h1>Product Management</h1>
    <div class="btn-container">
        <input type="submit" class="btn1" id="mainbtn" onclick="toggleButtons()" value="Show Menu">
        <a href="product.php"  class="btn hidden">Product</a>
        <a href="delivery.php"  class="btn hidden">Delivery</a>
        <a href="transfer.php"  class="btn hidden">Transfer</a>
        <a href="wastages.php"  class="btn hidden">Wastages</a>
        <a href="pullout.php"  class="btn hidden">Pull Out</a>
    </div>
</div>

<div class="container">
    <div class="left-div">
        <div class="content">
        <h2 class="heading">Product Form</h2>
            <form action="product.php" method="get">
                <input placeholder="Product Code" type="text" name="txtcode" required><br>
                <input placeholder="Product Name" type="text" name="txtname" required><br>
                <input type="submit" value="Add">
            </form><br>
        </div>
    </div>
    <div class="right-div">
        <div class="content">
        <h2 class="heading">Product History</h2>
            <table border=1>
                <tr><th>X</th><th>Code</th><th>Name</th></tr>
                <?PHP
                $conn = new mysqli("localhost", "root", "" ,"dbprelim");

                if (isset($_GET['txtcode'])) {
                    $conn->query("insert into tblproduct (fldcode,fldname) values ('$_GET[txtcode]','$_GET[txtname]')");
                } elseif (isset($_GET['txtdelid'])) {
                    $conn->query("delete from tblproduct where fldcode = '$_GET[txtdelid]'");
                }

                $result=$conn->query("select * from tblproduct");
                while ($row=$result->fetch_assoc()) {
                    echo "<tr>
                    <td><a href=product.php?txtdelid=$row[fldcode]>X</a></td>
                    <td>$row[fldcode]</td>
                    <td><a href=ledger.php?txtname=$row[fldname]>$row[fldname]</a></td>
                    </tr>";
                }
                ?>
            </table>
        </div>
    </div>
</div>

<script>
function toggleButtons() {
    var main = document.getElementById("mainbtn");
    var subButtons = document.getElementsByClassName('btn');

    if (main.value === "Show Menu") {
        main.value = "Hide Menu";
        for (var i = 0; i < subButtons.length; i++) {
            subButtons[i].classList.remove('hidden');
        }
    } else {
        main.value = "Show Menu";
        for (var i = 0; i < subButtons.length; i++) {
            subButtons[i].classList.add('hidden');
        }
    }
}


</script>

</body>
</html>
