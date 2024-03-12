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
            #form{
                position:relative;
                border: solid grey 1px;
                width:450px;
                height:310;
            }
        </style>
    </head>
<!--_____________________________________________________________________________________-->
        <?PHP
        $conn = new mysqli("localhost", "root", "" ,"dbprelim");
        ?>
    <body>
<!--_____________________________________________________________________________________-->
        <div style="width:25%">
            <?PHP                    
            $result=$conn->query("select * from tblcategory");
            while ($row=$result->fetch_assoc()) {
                echo 
                "<a href=product.php?txtcid=$row[id]&txtcategory=$row[fldcategory]><input type=button id=mycat value='$row[fldcategory]' onclick='button()'></a><br><br>";
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
            <a href="category.php"><input type="button" value="Category"></a><br><br> 

<!--_____________________________________________________________________________________-->
            <div align=center id=form>
                <?PHP
                if(isset($_GET["txtcid"]) or isset($_GET["txtcategory"])){
                    echo "<h1>$_GET[txtcategory]</h1>
                    <form action=list.php method=get target=listtable>
                        <input placeholder=Code type=text name=txtcode required><br><br>
                        <input type=text placeholder=Name name=txtname required><br><br>
                        <input type=number name=txtprice placeholder=Price required><br><br>
                        <input type=number name=txtstock placeholder=Stock required><br><br>
                        <input type=hidden name=txtcategory value='$_GET[txtcategory]' required><br>
                        <input type=submit value=Add>
                    </form><br>";
                }
                ?>
            </div><br>
            <?PHP                    
            if(isset($_GET["txtcid"]) or isset($_GET["txtcategory"])){
                $result=$conn->query("select * from tblcategory where id=$_GET[txtcid]");
                while ($row=$result->fetch_assoc()) {
                    echo 
                    "<iframe src='list.php?txtcid=$row[id]&txtcategory=$row[fldcategory]' name=listtable width=450px height=250px>
                    </iframe>";
                }
            }
            ?><br><br>
 <!--_____________________________________________________________________________________-->
        </div>
    </body>
</html>