<?php
session_start() //check for start of session
?>

<html>
<head>
    <title> Payment Page</title>
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
<form action ='finalOrder.php' method =post>
<?php
if (isset($_POST['name1'])) {
$_SESSION['name1'] = $_POST['name1']; //store first name
}

if (isset($_POST['name2'])) {
$_SESSION['name2'] = $_POST['name2']; //store last name
}
if (isset($_POST['email'])) {
$_SESSION['email'] = $_POST['email']; //store email
}
if (isset($_POST['address'])) {
$_SESSION['address'] = $_POST['address'];// store address
}
if (isset($_POST['city'])) {
$_SESSION['city'] = $_POST['city']; //store city
}
if (isset($_POST['state'])) {
$_SESSION['state'] = $_POST['state']; //store state
}
if (isset($_POST['zip'])) {
$_SESSION['zip'] = $_POST['zip']; //store zip
}
if (isset($_POST['number'])) {
$_SESSION['number'] = $_POST['number']; //store number
}
if (isset($_POST['billing'])) {
$_SESSION['billing'] = $_POST['billing']; //store on if true

    echo '<table class="blueTable">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Shipping Address</th>';
    echo '<th>';
    echo '</th>';
    echo '<th>';
    echo '</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    echo '<tr>';
    echo '<td>'.$_SESSION['name1'];
    echo '</td>';
    echo '<td>'.$_SESSION['name2'];
    echo '</td>';
    echo '<td><br>';
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>'.$_SESSION['address'];
    echo '</td>';
    echo '<td><br>';
    echo '</td>';
    echo '<td><br>';
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>'.$_SESSION['city'];
    echo '</td>';
    echo '<td>'.$_SESSION['state'];
    echo '</td>';
    echo '<td>'.$_SESSION['zip'];
    echo '</td>';
    echo '</tr>';
    echo '</tbody>';
    echo '</table>';
}
else if (!isset($_POST['billing'])){ //This section is a simple html table with input data converted to PHP

echo '<table class="blueTable">';
echo '<thead>';
echo '<tr>';
echo '<th>Billing Address</th>';
echo '<th><br>';
echo '</th>';
echo '<th><br>';
echo '</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
echo '<tr>';
echo '<td>*Address line<br>';
echo '<input name="baddress" value="" required="" style="width: 300px;" type="text">'; //billing address input
echo '</td>';
echo '<td><br>';
echo '</td>';
echo '</tr>';
echo '<tr>';
echo '<td>*City<br>';
echo '<input name="bcity" value="" required="" type="text"> </td>';//city input
echo '<td>*State<br>';
echo '<input name="bstate" value="" required="" type="text"> </td>';//state input
echo '<td>*Zipcode<br>';
echo '<input name="bzip" value="" required="" type="text"> </td>';//zip input
echo '</tr>';
echo '</tbody>';
echo '</table>';
}
?>
    <br>
    <table class="blueTable">
        <thead>
        <tr>
            <th>Payment Method</th>
            <th><br>
            </th>
            <th><br>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>*Full Name on Credit Card<br>
                <input name="cname" value="" required="" type="text"> </td>
            <td><br>
            </td>
            <td><br>
            </td>
        </tr>
        <tr>
            <td>*Card Number<br>
                <input name="cnum" value="" required="" style="width: 300px;" type="text">
            </td>
            <td> <br>
            </td>
            <td><br>
            </td>
        </tr>
        <tr>
            <td>*Card Type
                <div class="control-group"> <label class="control control-radio">
                        VISA <input name="ctype" checked="checked" type="radio">
                        <div class="control_indicator"></div>
                    </label> <label class="control control-radio"> American Express
                        <input name="ctype" type="radio">
                        <div class="control_indicator"></div>
                    </label> <label class="control control-radio"> MasterCard <input
                            name="ctype"
                            type="radio">
                        <div class="control_indicator"></div>
                    </label> <label class="control control-radio"> Other <input name="ctype"
                                                                                type="radio">
                        <div class="control_indicator"></div>
                    </label> </div>
            </td>
            <td>*Expiration Date (month year)<br>
                <input name="cdate" value="" required="" type="month">
            </td>
            <td><br>
            </td>
        </tr>
        </tbody>
    </table>
    <p style="float: right">
        <input class = "btn1" type = submit value = "Complete Order"></p>
</form>
</body>
</html>
