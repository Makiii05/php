<html>
    <head>
        <style>
            #mycat{
                width:300px;
                height:70px;
                font-size:30px;
                font-weight:bold;
            }
            div{
                position:absolute;
            }
        </style>
    </head>
<!--_____________________________________________________________________________________-->
        <?PHP
        $conn = new mysqli("localhost", "root", "" ,"dbprelim");
        if (isset($_GET['txtcode'])) {
            $conn->query("insert into tblproduct (fldcode,fldname,fldprice,fldstock,fldcategory) values ('$_GET[txtcode]','$_GET[txtname]',$_GET[txtprice],$_GET[txtstock],'$_GET[txtcategory]')");
        } elseif (isset($_GET['txtdelid'])) {
            $conn->query("delete from tblproduct where id = '$_GET[txtdelid]'");
        }
    ?>
    <body>
<!--_____________________________________________________________________________________-->
        <div style="width:25%">
            <?PHP                    
            $result=$conn->query("select * from tblcategory");
            while ($row=$result->fetch_assoc()) {
                echo 
                "<a href=product.php?txtcid=$row[id]&txtcategory=$row[fldcategory]><input type=button id=mycat value='$row[fldcategory]'></a><br><br>";
            }
            ?>
        </div>
<!--_____________________________________________________________________________________-->
        <div style="width:75%;right:0px;">
            
            <a href="product.php"><input type="button" value="Product"></a>
            <a href="delivery.php"><input type="button" value="Delivery"></a>
            <a href="transfer.php"><input type="button" value="Transfer"></a>
            <a href="wastages.php"><input type="button" value="Wastages"></a>
            <a href="pullout.php"><input type="button" value="Pull Out"></a>
            <a href="category.php"><input type="button" value="Category"></a><br>   

<!--_____________________________________________________________________________________-->
            <?PHP
            if(isset($_GET["txtcid"]) or isset($_GET["txtcategory"])){
                echo "<h1>$_GET[txtcategory]</h1>
                <form action=product.php method=get>
                    <input placeholder=Code type=text name=txtcode required><br><br>
                    <input type=text placeholder=Name name=txtname required><br><br>
                    <input type=number name=txtprice placeholder=Price required><br><br>
                    <input type=number name=txtstock placeholder=Stock required><br><br>
                    <input type=hidden name=txtcategory value='$_GET[txtcategory]' required><br>
                    <input type=submit value=Add>
                </form><br>";
                echo "<table cellpadding=10>
                <tr><th>X</th><th>Name</th><th>Code</th><th>Price</th><th>Stock</th></tr>";
                $result=$conn->query("select * from tblproduct where fldcategory='$_GET[txtcategory]'");
                    while ($row=$result->fetch_assoc()) {
                        echo "<tr>
                        <td><a href=product.php?txtdelid=$row[id]&txtcategory=$row[fldcategory]>X</a></td>
                        <td>$row[fldcode]</td>
                        <td><a href=ledger.php?txtname=$row[fldname]>$row[fldname]</a></td>
                        <td>$row[fldprice]</td>
                        <td>$row[fldstock]</td>
                        </tr>";
                    }
                echo "</table>";
            }

            ?>
 <!--_____________________________________________________________________________________-->
        </div>
    </body>
</html>