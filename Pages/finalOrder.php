<?php
session_start(); //start session
?>

<html>
<head> //general heading used throughout project
    <title> Final Order Page</title>
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
<br>
<table class="blueTable">
    <thead>
    <tr>
        <th>Customer/Shipping Information</th>
        <th><br>
        </th>
        <th><br>
        </th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?php echo $_SESSION['name1']; ?><br> //print out the follwing session variable in table
        </td>
        <td><?php echo $_SESSION['name2']; ?><br>
        </td>
        <td><br>
        </td>
    </tr>
    <tr>
        <td><?php echo $_SESSION['email'];?><br>

        </td>
        <td><?php echo $_SESSION['address'];?><br>
        </td>
        <td><br>
        </td>
    </tr>
    <tr>
        <td><?php echo $_SESSION['city'];?><br>
        </td>
        <td><?php echo $_SESSION['state'];?><br>
        </td>
        <td><?php echo $_SESSION['zip'];?><br>
        </td>
    </tr>
    <tr>
        <td><?php echo $_SESSION['number'];?><br>
        </td>
        <td><br>
        </td>
        <td><br>
        </td>
    </tr>
    </tbody>
</table>
<br>
<?php

class item {
    var $code; // code
    var $name; // name
    var $quantity; // quantity
    var $price; // price per item

    function item($code, $name, $quantity, $price) {
        $this->code = $code;
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
    }
}

class basket {
    /**
     * constructor
     */
    function basket() {
        $this->sessionStart();
    }

    /**
     * start session OR if one already created
     * retrieve shopping_basket
     */
    function sessionStart() {
        global $session_basket;      //global variable ---array of items in basket

        //start session or retrieve if already exists with client
        session_start();

        //if previously started grab data associated with session_basket
        if(isset($_SESSION['session_basket']))
        {
            $session_basket = $_SESSION['session_basket'];
        }
        else
        {
            //if no session_basket initially to empty array
            $session_basket = Array();

            //store in SESSION variables
            $_SESSION['session_basket'] = $session_basket;
        }
    }

    /**
     *determine the number of elements in basket
     */
    function basketSize() {
        global $session_basket;

        // make session if not found
        if ($session_basket == "") {
            $this->sessionStart();
        }

        if (! is_array($session_basket)) {
            return 0;
        }

        return count($session_basket); //number of elements in the array $session_basket
    }



    /**
     * see if product (with product id $code) is in the current $session_basket array
     * if exist, modify it and return true
     * else retrun false
     */
    function editItem($code, $name, $quantity, $price) {
        global $session_basket;

        // make session if not found
        if ($session_basket == "") {
            $this->sessionStart();
            return false;
        }

        //cycle through elements in basket (array $session_basket) until you find the $item you want to edit
        while(list($k, $v) = each ($session_basket)) { //search in $session_basket

            if ($session_basket[$k]->code == $code) { //if found matching code (product id)
                // Found same code --- upade with new values the item
                $session_basket[$k]->name = $name;
                $session_basket[$k]->quantity = $quantity;
                $session_basket[$k]->price = $price;

                if($verbose) //verbose printout --not necessary
                    echo "INSIDE editItem: " . $code . "<br>";

                return true; //return true we updated it
            }
        }

        return false; //could not find the product in the basket
    }

    /**
     * delete item from basket ($session_basket  array) that has product id of $code and name of $name
     */
    function deleteItem($code, $name) {
        global $session_basket;

        // make session if not found
        if ($session_basket == "") {
            $this->sessionStart();
        }

        reset($session_basket);  //set pointer in array to first element

        //cycle through basket (array $session_basket) and look to see if item is there
        while(list($k, $v) = each ($session_basket)) { //look through each item in basket

            if ($session_basket[$k]->code == $code) { //if this item's code matches $code then we found the one to remove
                unset($session_basket[$k]); //remove this item from the $session_basket array

                //Make sure to add updated $session_basket array to the SESSION variable
                $_SESSION['session_basket'] = $session_basket;

                return true;
            }
        }
    }

}

//Save the following variables from POST into SESSION
if (isset($_POST['baddress'])) {
    $_SESSION['baddress'] = $_POST['baddress']; //store billing address if any
}
if (isset($_POST['bcity'])) {
    $_SESSION['bcity'] = $_POST['bcity']; //store city address if any
}
if (isset($_POST['bstate'])) {
    $_SESSION['bstate'] = $_POST['bstate']; //store state address if any
}
if (isset($_POST['bzip'])) {
    $_SESSION['bzip'] = $_POST['bzip'];// //store zip address if any
}
if (isset($_POST['cname'])) {
    $_SESSION['cname'] = $_POST['cname']; //store credit card name
}
if (isset($_POST['cnum'])) {
    $_SESSION['cnum'] = $_POST['cnum']; //store credit card number
}
if (isset($_POST['ctype'])) {
    $_SESSION['ctype'] = $_POST['ctype']; //store credit card type
}
if (isset($_POST['cdate'])) {
    $_SESSION['cdate'] = $_POST['cdate']; //store credit card expiration date
}

if ($_SESSION['billing']=='off') { //If Shipping address is different than billing

    echo '<table class="blueTable">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Billing Address (if applicable)</th>';
    echo '<th><br>';
    echo '</th>';
    echo '<th><br>';
    echo '</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    echo '<tr>';
    echo '<td>'.$_SESSION['baddress']; //print billing address
    echo '</td>';
    echo '<td><br>';
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>'.$_SESSION['bcity']; //print out billing city
    echo '</td>';
    echo '<td>'.$_SESSION['bstate']; //print out billing state
    echo '</td>';
    echo '<td>'.$_SESSION['bzip']; //print out billing zip
    echo '</td>';
    echo '</tr>';
    echo '</tbody>';
    echo '</table>';
}
?>
//print out informtion given from payment.php
<table class="blueTable">
    <thead>
    <tr>
        <th>Payment Information</th>
        <th><br>
        </th>
        <th><br>
        </th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?php echo $_SESSION['cname'];?><br></td>
        <td><br>
        </td>
        <td><br>
        </td>
    </tr>
    <tr>
        <td><?php echo $_SESSION['cnum'];?><br>
        </td>
        <td> <br>
        </td>
        <td><br>
        </td>
    </tr>
    <tr>
        <td><?php echo $_SESSION['ctype'];?>
        </td>
        <td><?php echo $_SESSION['cdate'];?>
        </td>
        <td><br>
        </td>
    </tr>
    <tr>
        <td><?php echo $_SESSION['cdate'];?>
        </td>
        <td>
        </td>
        <td><br>
        </td>
    </tr>
    </tbody>
</table>
<br>
<br>
<div style ='float : left'>
    <table id="t01" >
        <tr align = 'center'>
            <td align = 'center'> Product Image </td>
            <td align = 'center'> Product ID </td>
            <td align = 'center'> Product Name </td>
            <td align = 'center'> Quantity </td>
            <td align = 'center'> Price/item </td>
            <td align = 'center'> Cost </td>
            <td>
            </td>
        </tr>

        <?php


        $ORDER_VECTOR=""; //create order vector

        $subtotal = "0.00"; // For calculating the subtotal of all items in the cart so far
        $quant = 0; // For adding up the number of total items in the cart

        $bask = $_SESSION['session_basket']; //create bask array to loop through
        $i=1;
        foreach ($bask as $k => $v) { //looop through basket array
            $quant += $v->quantity; //store the qunaity
            $subtotal += $v->quantity * $v->price; //calculate the subtotal by using subtotal
            if($i=1){ //concatanate the order vector
                $ORDER_VECTOR=$ORDER_VECTOR.'{'.($v->code).', '.($v->quantity).', '.($v->price)."}";
            }
            else if($i>1){
                $ORDER_VECTOR=$ORDER_VECTOR.', {'.($v->code).', '.($v->quantity).', '.($v->price)."}";
            }
        //print out the images
            if ($v->code!=21){

                $image = "http://csweb01.csueastbay.edu/~zx9935/Project%201/Images/" . $v->code . ".jpg";
            }
            else {
                $image = "http://csweb01.csueastbay.edu/~zx9935/Project%201/Images/" . $v->code . ".png";
            }

            $code=$v->code;
            $name=$v->name;
            $quantity=$v->quantity;
            $price=$v->price;

            ?>

            <tr>
                <td><?php echo $i .")" ; ?> <img  src="<?php echo $image ?> " style="float: right; width: 145px; height: 145px;"></td>
                <td align = 'center'><?php echo $code; ?> </td>
                <td align = 'center'><?php echo $name; ?> </td>
                <td align = 'center'><?php echo $quantity; ?> </td>
                <td align = 'center'><?php echo "$".$price; ?> </td>
                <td align = 'center'><?php echo "$".(($price)*($quantity)); ?> </td>
            </tr>
            <?php

            $i++;
        }

        if (isset($_POST['1fname'])) {
            $_SESSION['1fname'] = $_POST['1fname']; //store billing address if any
            echo $_SESSION['1fname'];
            echo '<br>';
        }
        if (isset($_POST['fcode1'])) {
            $_SESSION['fcode1'] = $_POST['fcode1']; //store city address if any
            echo $_SESSION['fcode1'];
            echo '<br>';

        }
        if (isset($_POST['fquantity1'])) {
            $_SESSION['fquantity1'] = $_POST['fquantity1']; //store state address if any
            echo $_SESSION['fquantity1'];
        }
        if (isset($_POST['fprice'])) {
            $_SESSION['fprice'] = $_POST['fprice'];// //store zip address if any
            echo $_SESSION['fprice'];
        }
        ?>
    </table>
</div>
<div style ='float : right'>
    <table class="blueTable" style = "float : right; width:500px" >
        <thead>
        <tr>
            <th>Cost Summary</th>
            <th><br>
            </th>
            <th><br>
            </th>
        </tr>
        </thead>
        <tr>
            <td>Subtotal: </td>
            <td align = 'center'><?php echo "$".$subtotal; ?></td>
        </tr>
        <tr>
            <td>Tax (8%): </td>
            <td align = 'center'><?php echo "$".($subtotal* 0.08) ?></td>
        </tr>
        <tr>
            <td>Shipping Fee</td>
            <td align = 'center'><?php echo "$".($quant*2)?></td>
        </tr>
        <tr>
            <td>TOTAL</td>
            <td align = 'center'><?php
                $OrderTOTAL = ($subtotal+($subtotal* 0.08)+($quant*2));
                echo "$".$OrderTOTAL?></td>
        </tr>
    </table>
</div>
<?php

    require_once 'HTTP/Request2.php'; //add http2 request from csweb01 server

    $request = new HTTP_Request2('https://storedata-finazzo-5.herokuapp.com/storeData', HTTP_Request2::METHOD_POST); //send the http2 request to teh server

    $request->addPostParameter('firstname', $_SESSION['name1']);//add the parameter, first name for customer info
    $request->addPostParameter('lastname', $_SESSION['name2']);//add the parameter, last name for customer info
    $request->addPostParameter('addy', $_SESSION['address']);//add the parameter, address for customer info
    $request->addPostParameter('city', $_SESSION['city']);//add the parameter, city for customer info
    $request->addPostParameter('states', $_SESSION['state']);//add the parameter, state for customer info
    $request->addPostParameter('zip', $_SESSION['zip']);//add the parameter, zip for customer info
    $request->addPostParameter('email', $_SESSION['email']);//add the parameter, email for customer info

    $request->addPostParameter('cctype', $_SESSION['ctype']);//add the parameter, credit card type for billing info
    $request->addPostParameter('ccnum', $_SESSION['cnum']);//add the parameter, credit card number for billing info
    $request->addPostParameter('ccdate', $_SESSION['cdate']);//add the parameter, credit card expiration date for billing info

    $request->addPostParameter('shipstreet', $_SESSION['address']);//add the parameter, address for shipping info
    $request->addPostParameter('shipcity', $_SESSION['city']);//add the parameter, city for shipping info
    $request->addPostParameter('shipstate', $_SESSION['state']);//add the parameter, state for shipping info
    $request->addPostParameter('shipzip', $_SESSION['zip']);//add the parameter, zip for shipping info

    $request->addPostParameter('PRODUCTS', $ORDER_VECTOR);//add the parameter, PRODUCT_VECTOR for ORDERS
    $request->addPostParameter('ordertotal', $OrderTOTAL);//add the parameter, order total for ORDERS

//fix the SSL issue  NOTE: THIS CODE WAS GIVEN
    $request->setConfig(array(
        'ssl_verify_peer' => FALSE,
        'ssl_verify_host' => FALSE
    ));
//invoke request and get the response
    try {
        $response = $request->send(); //Set response to status of send request
        if (200 == $response->getStatus()) { //check status, if received, print the body of what was sent back
            echo $response->getBody();
        } else {        //else print the error messages
            echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
                $response->getReasonPhrase();
        }
    } catch (HTTP_Request2_Exception $e) {
        echo 'Error: ' . $e->getMessage();
        //}
}
?>
</body>

</html>
