<?php

session_start();

// Globals
$product            =   null;
$products           =   null;
$categories         =   null;
$msg                =   null;        // msg var is used to display alert box above form
$isError            =   null;
$refresh            =   false;

/* ============================================
COMMON FUNCTIONS
===============================================*/

function makeDate($dd, $mm, $yy)
{
    return $dd . '/' . $mm . '/' . $yy;
}

function print_array($title, $array)
{
    if (is_array($array)) {
        echo $title . "<br/>" .
            "||---------------------------------||<br/>" .
            "<pre>";
        print_r($array);
        echo "</pre>" .
            "END " . $title . "<br/>" .
            "||---------------------------------||<br/>";
    } else {
        echo $title . " is not an array.";
    }
}

/* ============================================
USER FUNCTIONS
===============================================*/

function userLoggedIn()
{
    if (isset($_SESSION['user'])) {
        return true;
    }

    return false;
}

function loginUser()
{
    global $conn;
    global $msg;
    global $isError;
    global $refresh;

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email AND password = :password");

    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':password', $_POST['password']);

    try {
        $stmt->execute();
        $num = $stmt->rowCount();

        if ($num > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user'] = $user;

            $msg = 'Signed In';
            $isError = false;
            $refresh = true;
        } else {
            $msg = 'Invalid Credentials';
            $isError = true;
        }
    } catch (PDOException $e) {
        $msg = $e->getMessage();
        $isError = true;
    }
}

function insertUser()
{
    global $conn;
    global $msg;
    global $isError;

    $dataOfBirth = makeDate($_POST['date'], $_POST['month'], $_POST['year']);

    $stmt = $conn->prepare("INSERT INTO users (name, email, workPhone, phone, address, password, intrested, dateOfBirth) Values(:name, :email, :workPhone, :phone, :address, :password, :intrested, :dateOfBirth)");

    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':workPhone', $_POST['workPhone']);
    $stmt->bindParam(':phone', $_POST['phone']);
    $stmt->bindParam(':address', $_POST['address']);
    $stmt->bindParam(':password', $_POST['password']);
    $stmt->bindParam(':intrested', $_POST['intrested']);
    $stmt->bindParam(':dateOfBirth', $dataOfBirth);

    try {
        $stmt->execute();
        $msg = 'Signup success';
        $isError = false;
    } catch (PDOException $e) {
        $msg = $e->getMessage();
        $isError = true;
    }
}


/* ============================================
CATEGORY FUNCTIONS
===============================================*/

function getSubCategories($parentId)
{

    global $conn;

    $stmt = $conn->prepare("SELECT * FROM sub_categories where parentId = :parentId");

    $stmt->bindParam(':parentId', $parentId);

    try {
        $stmt->execute();
        $num = $stmt->rowCount();

        if ($num > 0) {
            $sub_categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $sub_categories;
        } else {
            return array();
        }
    } catch (PDOException $e) {
        echo $e;
        die();
    }
}


function getCategories()
{
    global $conn;
    global $categories;
    $catsWithSubs = array();

    $stmt = $conn->prepare("SELECT * FROM categories");

    try {
        $stmt->execute();
        $num = $stmt->rowCount();

        if ($num > 0) {
            $catArr = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($catArr as $category) {
                $sub_categories = getSubCategories($category['id']);

                array_push($catsWithSubs, array(
                    "parent" => $category,
                    "sub_cats" => $sub_categories
                ));
            }

            $categories = $catsWithSubs;
        } else {
            echo 'No categories found!';
        }
    } catch (PDOException $e) {
        echo $e;
        die();
    }
}

/* ============================================
PRODUCT FUNCTIONS
===============================================*/

function getProducts()
{
    global $conn;
    global $products;

    $stmt = $conn->prepare("SELECT * FROM products");

    try {
        $stmt->execute();
        $num = $stmt->rowCount();

        if ($num > 0) {
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            echo 'No products found!';
        }
    } catch (PDOException $e) {
        echo $e;
        die();
    }
}

function getProduct($id)
{
    global $conn;
    global $product;

    $stmt = $conn->prepare('select * from products where id = :id');

    $stmt->bindParam(':id', $id);

    try {
        $stmt->execute();
        $num = $stmt->rowCount();

        if ($num > 0) {
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }
}

function getProductsFromCat($catId)
{
    global $conn;
    global $products;

    $stmt = $conn->prepare("SELECT * FROM products WHERE catId = :catId");

    $stmt->bindParam(':catId', $catId);

    try {
        $stmt->execute();
        $num = $stmt->rowCount();

        if ($num > 0) {
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            echo 'No products found!';
        }
    } catch (PDOException $e) {
        echo $e;
        die();
    }
}

function searchProducts($query)
{
    global $conn;
    global $products;

    $stmt = $conn->prepare("SELECT * FROM products WHERE name like :name");

    $stmt->bindParam('%:name%', $query);

    try {
        $stmt->execute();
        $num = $stmt->rowCount();

        if ($num > 0) {
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        throw $e;
    }
}

/* ============================================
CART FUNCTIONS
===============================================*/

function cartIsEmpty()
{
    if (array_key_exists('cart', $_SESSION) && empty($_SESSION['cart'])) {
        return true;
    }

    return false;
}

function itemFoundInCart($item)
{
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();


    foreach ($cart as $cartItem) {
        if ($cartItem['product']['id'] === $item['product']['id']) {
            return true;
        }
    }

    return false;
}

function addNewItemToCart($item)
{
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();

    array_push($cart, $item);

    $_SESSION['cart'] = $cart;
}

function clearCart()
{
    $_SESSION['cart'] = null;
}

function incrementCartItem($item)
{
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    $updatedCart = array();
    $idForIncrement = $item['product']['id'];
    $qtyForIncrement = 1;

    foreach ($cart as $cartItem) {
        if ($cartItem['product']['id'] === $idForIncrement) {
            $updatedQty = (int) $cartItem['qty'] + (int) $qtyForIncrement;

            if ($updatedQty > 5) {
                $updatedQty = 5;
            }

            array_push($updatedCart, array(
                "product" => $cartItem['product'],
                "qty"     => (string) $updatedQty,
                "cartItemPrice" => $cartItem['product']['price'] * $updatedQty
            ));
        } else {
            array_push($updatedCart, $cartItem);
        }
    }


    $_SESSION['cart'] = $updatedCart;
}

function decrementCartItem($item)
{
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    $updatedCart = array();
    $idForDecrement = $item['product']['id'];
    $qtyForDecrement = 1;

    foreach ($cart as $cartItem) {
        if ($cartItem['product']['id'] === $idForDecrement) {
            $updatedQty = (int) $cartItem['qty'] - (int) $qtyForDecrement;

            if ($updatedQty < 1) {
                $updatedQty = 1;
            }

            array_push($updatedCart, array(
                "product" => $cartItem['product'],
                "qty"     => (string) $updatedQty
            ));
        } else {
            array_push($updatedCart, $cartItem);
        }
    }

    $_SESSION['cart'] = $updatedCart;
}

function removeItemFromCart($item)
{
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    $updatedCart = array();
    $idForRemove = $item['product']['id'];

    foreach ($cart as $cartItem) {
        if ($cartItem['product']['id'] !== $idForRemove) {
            array_push($updatedCart, $cartItem);
        }
    }

    $_SESSION['cart'] = $updatedCart;
}

function addToCart($productId, $qty)
{
    global $conn;
    global $product;

    $cart = array();

    getProduct($productId); // this saves the product in global $product variable

    $cartItem = array(
        "product" => $product,
        "qty" => $qty,
        "cartItemPrice" => $product['price'] * $qty
    );


    if (cartIsEmpty()) {
        array_push($cart, $cartItem);
        $_SESSION['cart'] = $cart;

        return;
    }

    if (itemFoundInCart($cartItem)) {
        incrementCartItem($cartItem);
    } else {
        addNewItemToCart($cartItem);
    }
}

function getCart()
{
    if (isset($_SESSION['cart'])) {
        return $_SESSION['cart'];
    }

    return array();
}

function getCartTotal()
{
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    $total = 0;

    foreach ($cart as $cartItem) {
        $total += $cartItem['cartItemPrice'];
    }

    return $total;
}


/* ============================================
Placing Order FUNCTIONS
===============================================*/

function saveOrderedProducts($orderId)
{
    global $conn;

    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
    $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;


    foreach ($cart as $cartItem) {
        $stmt = $conn->prepare("INSERT INTO ordered_products (user_id, prod_id, order_id, qty, price) VALUES (:user_id, :prod_id, :order_id, :qty, :price)");

        $stmt->bindParam(':user_id', $user['id']);
        $stmt->bindParam(':prod_id', $cartItem['product']['id']);
        $stmt->bindParam(':order_id', $orderId);
        $stmt->bindParam(':qty', $cartItem['qty']);
        $stmt->bindParam(':price', $cartItem['cartItemPrice']);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            throw $e;
        }
    }
}

function getOrderId()
{
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM orders");

    try {
        $stmt->execute();
        $num = $stmt->rowCount();

        return ++$num;
    } catch (PDOException $e) {
        throw $e;
    }
}

function placeOrder($order)
{
    global $conn;
    global $msg;
    global $isError;
    $newOrderId = getOrderId();

    $stmt = $conn->prepare("INSERT INTO orders (id, userId, name, address, email, phone, total) VALUES (:id, :userId, :name, :address, :email, :phone, :total )");

    $stmt->bindParam(':id', $newOrderId);
    $stmt->bindParam(':userId', $order['userId']);
    $stmt->bindParam(':name', $order['name']);
    $stmt->bindParam(':address', $order['address']);
    $stmt->bindParam(':email', $order['email']);
    $stmt->bindParam(':phone', $order['phone']);
    $stmt->bindParam(':total', $order['total']);

    try {
        $stmt->execute();
        $msg = 'Order is Placed';
        $isError = false;

        saveOrderedProducts($newOrderId);
        clearCart();
    } catch (PDOException $e) {
        throw $e;
        $msg = $e->getMessage();
        $isError = true;
    }
}
