<html>
    <body>
              
        <a href="product.php"><input type="button" value="Product"></a>
        <a href="delivery.php"><input type="button" value="Delivery"></a>
        <a href="pullout.php"><input type="button" value="Pull Out"></a><br>

        <h1>HISTORY</h1>
    <table border=1>
            <tr><th>Date</th><th>Type</th><th>IN</th><th>OUT</th><th>Balance</th></tr>
            <?PHP
            $conn = new mysqli("localhost", "root", "" ,"dbprelim");
    
            $result=$conn->query("select * from tblledger where fldname='$_GET[txtname]'");
            while ($row=$result->fetch_assoc()) {
                echo "<tr>
                <td>$row[fldcode]</td>
                <td>$row[fldtype]</td>
                <td>$row[fldin]</td>
                <td>$row[fldout]</td>
                <td>$row[fldbalance]</td> 
                </tr>";
            }
            ?>
        </table>
    </body>
</html>