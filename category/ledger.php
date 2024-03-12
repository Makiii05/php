<html>
        <?PHP
        $conn = new mysqli("localhost", "root", "" ,"dbprelim");
            if (isset($_GET['txtproduct'])) {
                //============================================
                $balance=0;
                $result=$conn->query("select * from tblledger where fldname='$_GET[txtproduct]'");
                while($row=$result->fetch_assoc()){ 
                    $balance=$row["fldbalance"];
                }
                //============================================
                if($_GET["txttype"]=="Delivery"or$_GET["txttype"]=="Transfer"){
                    $balance=$balance+$_GET["txtquantity"];
                    if($_GET["txttype"]=="Delivery"){
                        $conn->query("INSERT INTO tbldelivery (fldcode,fldsupplier,flddate,fldproduct,fldquantity) VALUES ('$_GET[txtcode]','$_GET[txtsupplier]','$_GET[txtdate]','$_GET[txtproduct]','$_GET[txtquantity]')");
                    }else{    
                        $conn->query("insert into tbltransfer (flddate,fldbranch,fldreason,fldproduct,fldquantity) values ('$_GET[txtdate]','$_GET[txtbranch]','$_GET[txtreason]','$_GET[txtproduct]','$_GET[txtquantity]')");
                    }
                    $conn->query("INSERT INTO tblledger (fldname,fldcode,fldtype,fldin,fldbalance) VALUES ('$_GET[txtproduct]','$_GET[txtdate]','$_GET[txttype]','$_GET[txtquantity]',$balance)");
                }elseif($_GET["txttype"]=="PullOut"or$_GET["txttype"]=="Wastages"){
                    $balance=$balance-$_GET["txtquantity"];
                    if($_GET["txttype"]=="PullOut"){
                        $conn->query("INSERT INTO tblpullout (flddate,fldproduct,fldquantity) VALUES ('$_GET[txtdate]','$_GET[txtproduct]','$_GET[txtquantity]')");  
                    }else{
                        $conn->query("insert into tblwastages (flddate,fldproduct,fldquantity,fldwasteno,fldreason) values ('$_GET[txtdate]','$_GET[txtproduct]','$_GET[txtquantity]','$_GET[txtwaste]','$_GET[txtreason]')");
                    }
                    $conn->query("INSERT INTO tblledger (fldname,fldcode,fldtype,fldout,fldbalance) VALUES ('$_GET[txtproduct]','$_GET[txtdate]','$_GET[txttype]','$_GET[txtquantity]',$balance)");
                }
                header("location:$_GET[txttype].php");    
            }
        ?>
    <body align=center>
        <?PHP
        echo "<a href=list.php?txtcategory=$_GET[txtcategory]><input type=button value=Back></a><br>"
        ?>
        <h1>HISTORY</h1>
        Product: <b><?PHP echo "$_GET[txtname]" ?></b><br><br>
        <table  cellpadding=10 align=center>    
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