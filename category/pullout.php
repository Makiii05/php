    <html>
        <body>
                    
            <a href="product.php"><input type="button" value="Product"></a>
            <a href="delivery.php"><input type="button" value="Delivery"></a>
            <a href="transfer.php"><input type="button" value="Transfer"></a>
            <a href="wastages.php"><input type="button" value="Wastages"></a>
            <a href="pullout.php"><input type="button" value="Pull Out"></a>
            <a href="category.php"><input type="button" value="Category"></a><br><br>

            <h1>PULL OUT</h1>
            <form action="ledger.php" method="get">
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
                Quantity <input type="number" name="txtquantity" required>
                <input type="submit" value="PullOut" name="txttype"><br>
            </form>
<!--_____________________________________________________________________________________-->
            <?PHP
            $conn = new mysqli("localhost", "root", "" ,"dbprelim");   
                if (isset($_GET['txtdelid'])) {
                    $conn->query("delete from tblpullout where id = '$_GET[txtdelid]'");
                }
            ?>
<!--_____________________________________________________________________________________-->
            <table cellpadding=10>
                <tr><th>X</th><th>Date</th><th>Product</th><th>Quantity</th></tr>
                <?PHP
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