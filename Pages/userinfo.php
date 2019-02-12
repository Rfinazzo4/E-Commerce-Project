<?php
session_start()
?>
<html>
<head>
    <title> Contact Information</title>
    <link rel="stylesheet" href="userinfostylesheet.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <script type="text/javascript">

        function MM_jumpMenu(targ,selObj,restore){ //v3.0

            eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");

            if (restore) selObj.selectedIndex=0;

        }

    </script></head>
<body>
<table style="width:100%">
    <tbody>
    <tr>
        <td><a href="https://www.supremenewyork.com"><img src="../Images/RMS.png"
                                                          width="200"
                                                          height="100"></a></td>
        <td><a href="Homepage.html">Homepage</a></td>
        <td><a href="ProductPage.html">Product Page</a></td>
        <td><a href="cart.php">Cart</a></td>
    </tr>
    </tbody>
</table>
<br>
<form method = post action ="payment.php">
    <table class="blueTable">
        <thead>
        <tr>
            <th>Shipping Address and Information</th>
            <th><br>
            </th>
            <th><br>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>*First Name<br>
                <input name="name1" value="" required="" type="text"> </td>
            <td>*Last Name<br>
                <input name="name2" value="" required="" type="text"></td>
            <td><br>
            </td>
        </tr>
        <tr>
            <td>*Email<br>
                <input name="email" value="" required="" style="width: 300px;" type="email">
            </td>
            <td>*Address line<br>
                <input name="address" value="" required="" type="text" style="width: 300px;"> </td>
            <td><br>
            </td>
        </tr>
        <tr>
            <td>*City<br>
                <input name="city" value="" required="" type="text"> </td>
            <td>*State<br>
                <input name="state" value="" required="" type="text"> </td>
            <td>*Zipcode<br>
                <input name="zip" value="" required="" type="text"> </td>
        </tr>
        <tr>
            <td>*Phone Number<br>
                <input name="number" value="" required="" type="tel"></td>
            <td><br>
            </td>
            <td><br>
            </td>
        </tr>
        </tbody>
    </table>
    <label><input name="billing" type="checkbox"> Use Shipping
        address as Billing address </label>
    <p style="float: right">
        <input class = "btn1" type = submit value = "Continue"></p>
</form>


</body>

</html>
