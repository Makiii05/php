<html>
    <body>
                
        <a href="product.php"><input type="button" value="Product"></a>
        <a href="delivery.php"><input type="button" value="Delivery"></a>
        <a href="transfer.php"><input type="button" value="Transfer"></a>
        <a href="wastages.php"><input type="button" value="Wastages"></a>
        <a href="pullout.php"><input type="button" value="Pull Out"></a>
        <a href="category.php"><input type="button" value="Category"></a><br><br>

        <h1>CATEGORY</h1>
        <form action="category.php" method="get">
            Category <input type="text" name="txtcategory" required>
            <input type="submit" value="Add Category">
        </form>
<!--_____________________________________________________________________________________-->
        <?PHP
        $conn = new mysqli("localhost", "root", "" ,"dbprelim");
            if(isset($_GET["txtcategory"])){
                $conn->query("INSERT INTO tblcategory (fldcategory) VALUE ('$_GET[txtcategory]')");  
            }elseif(isset($_GET['txtdelid'])) {
                $conn->query("delete from tblcategory where id = '$_GET[txtdelid]'");
            }
        ?>
<!--_____________________________________________________________________________________-->
        <table cellpadding=10>
            <tr><th>X</th><th>Category</th></tr>
            <?PHP                    
            $result=$conn->query("select * from tblcategory");
            while ($row=$result->fetch_assoc()) {
                echo "<tr>
                <td><a href=category.php?txtdelid=$row[id]>X</a></td>
                <td>$row[fldcategory]</td>
                </tr>";
            }
            ?>
        </table>
    </body>
</html>