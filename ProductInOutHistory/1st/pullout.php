<html>
    <body>
        
        <a href="product.php"><input type="button" value="Product"></a>
        <a href="delivery.php"><input type="button" value="Delivery"></a>
        <a href="pullout.php"><input type="button" value="Pull Out"></a><br>

        <h1>PULL OUT</h1>
        <form action="pullout.php" method="get">
            Date <input type="date" name="txtdate" value="<?PHP echo date('Y-m-d')?>"><br>
            Product 
            <select name="txtproduct" required>
                <?PHP
                $conn = new mysqli("localhost", "root", "" ,"dbprelim");

                $result = $conn->query("SELECT * from tblproduct");
                while($row=$result->fetch_assoc()){
                    echo "<option value=$row[fldname]>$row[fldname]</option>";
                }
                ?>
            </select><br>
            Quantity <input type="number" name="txtquantity">
            <input type="submit" value="Add" name="txtdelivery"><br>
        </form>
        <table border=1>
            <tr><th>X</th><th>Date</th><th>Product</th><th>Quantity</th></tr>
            <?PHP
            $conn = new mysqli("localhost", "root", "" ,"dbprelim");
            
//here            
            // In pullout.php
            if (isset($_GET['txtproduct'])) {
                $balance = 0;
                // Fetch current balance for the product
                $result = $conn->query("SELECT fldbalance FROM tblledger WHERE fldname = '$_GET[txtproduct]'");
                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $balance = $row['fldbalance'];
                }
                // Subtract pulled out quantity from the current balance
                $balance -= $_GET["txtquantity"];

                // Update tblpullout with pulled out quantity
                $conn->query("INSERT INTO tblpullout (flddate,fldproduct,fldquantity) VALUES ('$_GET[txtdate]','$_GET[txtproduct]','$_GET[txtquantity]')");
                // Update tblledger with new balance
                $conn->query("INSERT INTO tblledger (fldname,fldcode,fldtype,fldout,fldbalance) VALUES ('$_GET[txtproduct]','$_GET[txtdate]','Pull Out','$_GET[txtquantity]',$balance)");
            }elseif (isset($_GET['txtdelid'])) {
                $conn->query("delete from tblpullout where id = '$_GET[txtdelid]'");
            }
//here

            $result=$conn->query("select * from tblpullout");
            while ($row=$result->fetch_assoc()) {
                echo "<tr>
                <td><a href=pullout.php?txtdelid=$row[id]>X</a></td>
                <td>$row[flddate]</td>
                <td>$row[fldproduct]</td>
                <td>$row[fldquantity]</td>
                </tr>";
            }
            ?>
        </table>
    </body>
</html>