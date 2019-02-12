<?php
session_start();

?>


<!DOCTYPE html>
<html>
<head>
    <style>
        table#t01 {
        th, td {
            border-bottom: 1px solid #ddd;
        }

        tr: hover {
            background-color: #f5f5f5;
        }
        .button {
            -moz-border-radius: 25px;
            -moz-box-shadow: #000000 0px 0px 10px;
            -moz-transition: all 0.5s ease;
            -ms-transition: all 0.5s ease;
            -o-transition: all 0.5s ease;
            -webkit-border-radius: 25px;
            -webkit-box-shadow: #6E7849 0 0 10px;
            -webkit-transition: all 0.5s ease;
            background-color: #6b92ff;
            border-radius: 25px;
            border: 2px solid #000000;
            box-shadow: #000000 0px 0px 10px;
            color: #ffffff;
            display: inline-block;
            font-size: 0.8em;
            margin: auto;
            padding: 15px;
            text-decoration: none;
            text-shadow: #000000 5px 5px 15px;
            transition: all 0.5s ease;
        }
        .button:hover {
            padding: 15px;
        }

        }
    </style>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="cartstyle.css">
    <title>Shopping Cart</title>
    <script type="text/javascript">

    </script> </head>
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
<?php

        $verbose = true; //set to false to get rid of additional print outs

 

        //========================================
        // Class item = represents a product that is a item is in shopping basket
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

        //========================================
        // Class basket = represents shopping basket with the variable $session_basket representing the Array of item instances in basket

        /**
        * shopping basket class
        */
        class basket {

                /**
                * constructor
                */
                function basket() {
                        $this->sessionStart();
                }

                /**
                * start session OR if one already created retrieve shopping_basket
                */
                function sessionStart() {
                        global $session_basket;      //global variable ---array of items in basket

                        //start session or retrieve if already exists with client
                        session_start();

                        if($verbose) //verbose printout --not necessary
                                echo "session id ". session_id() . "<br>";

                        //if previouisly started grab data associated with session_basket
                        if(isset($_SESSION['session_basket']))
                        {
                                $session_basket = $_SESSION['session_basket'];
                                if($verbose) //verbose printout --not necessary
                                        {      echo "retrieved session basket is: ";
                                                print_r($session_basket);
                                                echo"<br>"; }
                        }
                        else
                        {      //if no session_basket initially to empty array
                                $session_basket = Array();

                                //store in SESSION variables
                                $_SESSION['session_basket'] = $session_basket;

                                if($verbose) //verbose printout --not necessary
                                        echo "session basket NEW";
                        }
                }

                

                /**
                * destory session -- call when someone wants to completely CLEAR the cart --get rid of session
                */
                function sessionEnd() {
                        session_unset();
                        session_destroy();
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
                        return $i;
                }

                /**
                * register item in session
                * if same code exist in session, modify it.
                */
                function registerItem($code, $name, $quantity, $price) {
                        global $session_basket;

                        // make session if not found
                        if ($session_basket == "") {
                                $this->sessionStart();
                        }

                        // test to see if this product (with id $code) is currently IN basket, if so EDIT IT (update)
                        if (! $this->editItem($code, $name, $quantity, $price)) {
                                $item = new item($code, $name, $quantity, $price); //if NOT in basket CREATE IT
                                $session_basket[] = $item;
                        }

 

                        //Make sure to add updated $session_basket array to the SESSION variables

                        $_SESSION['session_basket'] = $session_basket;
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

                        reset($session_basket);
                        while(list($k, $v) = each($session_basket)) { //search in $session_basket
                                if ($session_basket[$k]->code == $code) { //if found matching code (product id)
                                        // Found same code --- upade with new values the item
                                        $session_basket[$k]->name == $name;
                                        $session_basket[$k]->quantity = $quantity;
                                        $session_basket[$k]->price = $price;
                
                                       if($verbose) //verbose printout --not necessary
                                                echo "INSIDE editItem: " . $code . "<br>";

                                        return true; //return true we updated it
                                }
                        }

                        return false; //could not find the product currently in basket
                }

 

                /**
                * delete item from basket ($session_basket array) that has product id of $code and name of $name
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

 

 

//Create or Retrieve shopping basket if it already is in session
$basket = new basket();

        //If adding an item to the basket
if($_POST['Desired_Action'] == "Adding") //add and update case
 {
    //read in form data

    $code = $_POST['code']; //load value from form into $code
    $name = $_POST['name'];//load value from form into $name
    $quantity = $_POST['quantity']; //load value from form into $quantity
    $price = $_POST['price'];//load value from form into $price

    //add it to the basket
    $basket->registerItem($code, $name, $quantity, $price); //call register item to register the item with the param values
 
 }
 //if deleting an item from the basket
else if($_POST['Desired_Action'] == "Delete") //remove from cart case
{
     $code = $_POST['code']; //load value from form into $code
     $name = $_POST['name']; //load value from form into $name
    
    $basket->deleteItem($code, $name); //call delete item function and send $code and $name as param

 }

//if clearing the entire basket
else if($_POST['Desired_Action'] == "Clear Cart") //remove from cart case
{
    echo "Are you sure you want to remove all items from your cart?  Click Clear Cart again to confirm."; // double check user input
    $basket->sessionEnd();
 //end session
}



echo "<p align='center'> <font color=#4a68cb  size='6pt'> CART  </font> </p>";

?>
<table>
    <tbody>
    <tr>
        <td>
            <p>Make a mistake? No worries, click delete to remove your most recent item. </p>

        </td>
        <td>
            <form action = "cart.php" method="post">
                <input type='hidden' name='name' value='<?php echo "$name";?>'/>
                <input type='hidden' name='code' value='<?php echo "$code";?>'/>
                <input class = "btn2" name="Desired_Action" id="delete button"value="Delete" type="submit">
            </form>
        </td>
    </tr>
    </tbody>
</table>

<table id="t01" align = 'center'>
    <tr align = 'center'>
        <td align = 'center'> Product Image </td>
        <td align = 'center'> Product ID </td>
        <td align = 'center'> Product Name </td>
        <td align = 'center'> Quantity </td>
        <td align = 'center'> Price/item </td>
        <td align = 'center'> Cost </td>
        <td>
            <form action = "cart.php" method="post">
                <input class = "btn2"name="Desired_Action" id="clear cart button"value="Clear Cart" type="submit">
            </form>
        </td>
    </tr>
<?php
reset($session_basket);
$i=0;
while(list($k, $v) = each($session_basket)) {
$i++;
$item = $session_basket[$k];
if ($item->code!=21){

$image = "http://csweb01.csueastbay.edu/~zx9935/Project%201/Images/" . $item->code . ".jpg";
}
else {
    $image = "http://csweb01.csueastbay.edu/~zx9935/Project%201/Images/" . $item->code . ".png";
}

?>
<tr>
    <td><?php echo $i .")" ; ?> <img  src="<?php echo $image ?> " style="float: right; width: 145px; height: 145px;"></td>
    <td align = 'center'><?php echo $item->code; ?> </td>
    <td align = 'center'><?php echo $item->name; ?> </td>
    <td align = 'center'><?php echo $item->quantity; ?> </td>
    <td align = 'center'><?php echo "$".$item->price; ?> </td>
    <td align = 'center'><?php echo "$".($item->price*$item->quantity); ?> </td>
    </form>
</tr>

<?php
} //end of loop
?>
<br>
    <p style="float: right">
    <form action ="userinfo.php" method = post >
        <input class = "btn1" type = submit value = "Start Checkout ">

    </form> </p>
<br>
<br>
</body>
</html>
