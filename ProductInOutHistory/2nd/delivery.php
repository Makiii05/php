<html>
    <body>
                
        <a href="product.php"><input type="button" value="Product"></a>
        <a href="delivery.php"><input type="button" value="Delivery"></a>
        <a href="transfer.php"><input type="button" value="Transfer"></a>
        <a href="wastages.php"><input type="button" value="Wastages"></a>
        <a href="pullout.php"><input type="button" value="Pull Out"></a><br><br>

        <h1>DELIVERY</h1>
        <form action="ledger.php" method="get">
            Delivery Code <input type="text" name="txtcode" required><br>
            Supplier <input type="text" name="txtsupplier"><br>
            Date <input type="date" name="txtdate"  value="<?PHP echo date('Y-m-d')?>"><br>
            Product 
            <select name="txtproduct">
                <?PHP
                $conn = new mysqli("localhost", "root", "" ,"dbprelim");

                $result = $conn->query("SELECT * from tblproduct");
                while($row=$result->fetch_assoc()){
                    echo "<option value=$row[fldname]>$row[fldname]</option>";
                }
                ?>
            </select><br>
            Quantity <input type="number" name="txtquantity" required>
            <input type="submit" value="Delivery" name="txttype"><br>
        </form>
<!--_____________________________________________________________________________________-->
        <?PHP
        $conn = new mysqli("localhost", "root", "" ,"dbprelim");
            if (isset($_GET['txtdelid'])) {
                $conn->query("delete from tbldelivery where fldcode = '$_GET[txtdelid]'");
            }
        ?>
<!--_____________________________________________________________________________________-->
        <table border=1>
            <tr><th>X</th><th>Date</th><th>Delivery Code</th><th>Supplier</th><th>Product</th><th>Quantity</th></tr>
            <?PHP
            $result=$conn->query("select * from tbldelivery");
            while ($row=$result->fetch_assoc()) {
                echo "<tr>
                <td><a href=delivery.php?txtdelid=$row[fldcode]>X</a></td>
                <td>$row[flddate]</td>
                <td>$row[fldcode]</td>
                <td>$row[fldsupplier]</td>
                <td>$row[fldproduct]</td>
                <td>$row[fldquantity]</td>
                </tr>";
            }
            ?>
        </table>
    </body>
</html>