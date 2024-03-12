<html>
    <body>
        <style>
            table{
                width:400px;
                border:solid 1px grey;
            }
            body{
                font-family:arial;
            }
        </style>
        <?PHP
            $conn = new mysqli("localhost", "root", "" ,"dbprelim");
            if(isset($_GET["txtcid"]) or isset($_GET["txtcategory"])){
                if (isset($_GET['txtcode'])) {
                    $conn->query("insert into tblproduct (fldcode,fldname,fldprice,fldstock,fldcategory) values ('$_GET[txtcode]','$_GET[txtname]',$_GET[txtprice],$_GET[txtstock],'$_GET[txtcategory]')");
                }elseif (isset($_GET['txtdelid'])) {
                    $conn->query("delete from tblproduct where id = '$_GET[txtdelid]'");
                }
                echo "<table cellpadding=10 border=1 align=center>
                <tr align=center><th>X</th><th>Name</th><th>Code</th><th>Price</th><th>Stock</th></tr>";
                $result=$conn->query("select * from tblproduct where fldcategory='$_GET[txtcategory]'");
                    while ($row=$result->fetch_assoc()) {
                        echo "<tr align=center>
                        <td><a href=list.php?txtdelid=$row[id]&txtcategory=$row[fldcategory]>X</a></td>
                        <td>$row[fldcode]</td>
                        <td><a href=ledger.php?txtname=$row[fldname]&txtcategory=$_GET[txtcategory]>$row[fldname]</a></td>
                        <td>$row[fldprice]</td>
                        <td>$row[fldstock]</td>
                        </tr>";
                    }
                echo "</table>";
            }
        ?>
    </body>
</html>