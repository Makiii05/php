<html>
    <body>
        
        <a href="product.php"><input type="button" value="Product"></a>
        <a href="delivery.php"><input type="button" value="Delivery"></a>
        <a href="transfer.php"><input type="button" value="Transfer"></a>
        <a href="wastages.php"><input type="button" value="Wastages"></a>
        <a href="pullout.php"><input type="button" value="Pull Out"></a><br><br>

        <h1>PRODUCT</h1>
        <form action="product.php" method="get">
            Code <input type="text" name="txtcode" required><br>
            Name <input type="text" name="txtname" required><br>
            <input type="submit" value="Add">
        </form><br>
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
    </body>
</html>