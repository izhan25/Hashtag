<?php

session_start();

// Globals
$msg = null;
$isError = false;

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


function adminLoggedIn()
{
    if (isset($_SESSION['admin'])) {
        return true;
    }

    return false;
}

function loginAdmin($admin)
{
    global $conn;
    global $isError;
    global $msg;



    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = :email AND password = :password");

    $stmt->bindParam(':email', $admin['email']);
    $stmt->bindParam(':password', $admin['password']);

    try {
        $stmt->execute();
        $num = $stmt->rowCount();

        if ($num > 0) {
            $_SESSION['admin'] = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $isError = true;
            $msg = 'Invalid Credentials';
        }
    } catch (PDOException $e) {
        throw $e;
    }
}


function getCategories()
{
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM categories");

    try {
        $stmt->execute();
        $num = $stmt->rowCount();

        if ($num > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return array();
    } catch (PDOException $e) {
        throw $e;
    }
}

function createCategory($name)
{
    global $conn;

    $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (:name)");

    $stmt->bindParam(':name', $name);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        throw $e;
    }
}

function deleteCategory($id)
{
    global $conn;

    $stmt = $conn->prepare("DELETE FROM categories WHERE id = :id");

    $stmt->bindParam(':id', $id);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        throw $e;
    }
}

function getCategory($id)
{
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM categories WHERE id = :id");

    $stmt->bindParam(':id', $id);

    try {
        $stmt->execute();
        $num = $stmt->rowCount();

        if ($num > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return '';
        }
    } catch (PDOException $e) {
        throw $e;
    }
}


function updateCategory($updCat)
{
    global $conn;

    $stmt = $conn->prepare("UPDATE categories SET name = :name WHERE id = :id");

    $stmt->bindParam(':id', $updCat['id']);
    $stmt->bindParam(':name', $updCat['name']);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        throw $e;
    }
}

function getSubCats()
{
    global $conn;
    $subCatsWithCats = array();

    $stmt = $conn->prepare("SELECT * FROM sub_categories");

    try {
        $stmt->execute();
        $num = $stmt->rowCount();

        if ($num > 0) {
            $subCats = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($subCats as $subCat) {
                $cat = getCategory($subCat['parentId']);

                array_push($subCatsWithCats, array(
                    'parent' => $cat,
                    'subCat' => $subCat
                ));
            }

            return $subCatsWithCats;
        }

        return array();
    } catch (PDOException $e) {
        throw $e;
    }
}

function createSubCat($subCat)
{
    global $conn;

    $stmt = $conn->prepare("INSERT INTO sub_categories (name, parentId) VALUES (:name, :parentId)");

    $stmt->bindParam(':name', $subCat['name']);
    $stmt->bindParam(':parentId', $subCat['parentId']);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        throw $e;
    }
}

function deleteSubCategory($id)
{
    global $conn;

    $stmt = $conn->prepare("DELETE FROM sub_categories WHERE id = :id");

    $stmt->bindParam(':id', $id);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        throw $e;
    }
}

function getSubCat($id)
{
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM sub_categories WHERE id = :id");

    $stmt->bindParam(':id', $id);

    try {
        $stmt->execute();
        $num = $stmt->rowCount();

        if ($num > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return '';
        }
    } catch (PDOException $e) {
        throw $e;
    }
}

function getSubCatsFromCat($parentId)
{
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM sub_categories WHERE parentId = :parentId");

    $stmt->bindParam(':parentId', $parentId);

    try {
        $stmt->execute();
        $num = $stmt->rowCount();

        if ($num > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return array();
    } catch (PDOException $e) {
        throw $e;
    }
}

function updateSubCategory($updSubCat)
{
    global $conn;

    $stmt = $conn->prepare("UPDATE sub_categories SET name = :name, parentId = :parentId WHERE id = :id");

    $stmt->bindParam(':id', $updSubCat['id']);
    $stmt->bindParam(':name', $updSubCat['name']);
    $stmt->bindParam(':parentId', $updSubCat['parentId']);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        throw $e;
    }
}

function getUser($id)
{
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");

    $stmt->bindParam(':id', $id);

    try {
        $stmt->execute();
        $num = $stmt->rowCount();

        if ($num > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    } catch (PDOException $e) {
        throw $e;
    }
}

function getProducts()
{
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM products");

    try {
        $stmt->execute();
        $num = $stmt->rowCount();

        if ($num > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return null;
    } catch (PDOException $th) {
        throw $th;
    }
}

function getProduct($id)
{
    global $conn;

    $stmt = $conn->prepare('select * from products where id = :id');

    $stmt->bindParam(':id', $id);

    try {
        $stmt->execute();
        $num = $stmt->rowCount();

        if ($num > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        throw $e;
    }
}

function deleteProduct($id)
{
    global $conn;

    $stmt = $conn->prepare("DELETE FROM products WHERE id = :id");

    $stmt->bindParam(':id', $id);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        throw $e;
    }
}

function updateProduct($prod)
{
    global $conn;

    $stmt = $conn->prepare("UPDATE products SET name = :name, catId = :catId, subCatId = :subCatId, price = :price, information = :information, image = :image WHERE id = :id");


    $stmt->bindParam(':id', $prod['id']);
    $stmt->bindParam(':name', $prod['name']);
    $stmt->bindParam(':catId', $prod['catId']);
    $stmt->bindParam(':subCatId', $prod['subCatId']);
    $stmt->bindParam(':price', $prod['price']);
    $stmt->bindParam(':information', $prod['info']);
    $stmt->bindParam(':image', $prod['image']);

    try {
        $stmt->execute();
    } catch (PDOException $th) {
        throw $th;
    }
}

function getOrderedProds($orderId, $userId)
{
    global $conn;

    $prods = array();

    $stmt = $conn->prepare("SELECT * FROM ordered_products WHERE user_id = :user_id AND order_id = :order_id");

    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':order_id', $orderId);

    try {
        $stmt->execute();
        $num = $stmt->rowCount();

        if ($num > 0) {
            $prodIds = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($prodIds as $prodId) {
                $prod = getProduct($prodId['prod_id']);

                array_push($prods, array(
                    'prod' => $prod,
                    'info' => $prodId
                ));
            }

            return $prods;
        } else {
            return null;
        }
    } catch (PDOException $e) {
        throw $e;
    }
}

function getOrders()
{
    global $conn;
    $orders = array();

    $stmt = $conn->prepare("SELECT * FROM orders");

    try {
        $stmt->execute();
        $num = $stmt->rowCount();

        if ($num > 0) {
            $orderTable = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($orderTable as $orderRow) {
                $user = getUser($orderRow['userId']);
                $orderedProds = getOrderedProds($orderRow['id'], $orderRow['userId']);

                $order = array(
                    'user' => $user,
                    'products' => $orderedProds,
                    'info' => $orderRow
                );

                array_push($orders, $order);
            }

            return $orders;
        }

        return array();
    } catch (PDOException $e) {
        throw $e;
    }
}

function getOrder($id)
{
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM orders WHERE id = :id");

    $stmt->bindParam(':id', $id);

    try {
        $stmt->execute();
        $num = $stmt->rowCount();

        if ($num > 0) {
            $orderTable = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($orderTable as $orderRow) {
                $user = getUser($orderRow['userId']);
                $orderedProds = getOrderedProds($orderRow['id'], $orderRow['userId']);

                $order = array(
                    'user' => $user,
                    'products' => $orderedProds,
                    'info' => $orderRow
                );

                return $order;
            }
        }

        return array();
    } catch (PDOException $th) {
        throw $th;
    }
}

function dispatchOrder($id)
{
    global $conn;

    $stmt = $conn->prepare("UPDATE orders SET dispatched = 'yes' WHERE id = :id");

    $stmt->bindParam(':id', $id);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        throw $e;
    }
}

function unDispatchOrder($id)
{
    global $conn;

    $stmt = $conn->prepare("UPDATE orders SET dispatched = 'no' WHERE id = :id");

    $stmt->bindParam(':id', $id);

    try {
        $stmt->execute();
        unDeliverOrder($id);
    } catch (PDOException $e) {
        throw $e;
    }
}

function deliverOrder($id)
{
    global $conn;

    $stmt = $conn->prepare("UPDATE orders SET delivered = 'yes' WHERE id = :id");

    $stmt->bindParam(':id', $id);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        throw $e;
    }
}

function unDeliverOrder($id)
{
    global $conn;

    $stmt = $conn->prepare("UPDATE orders SET delivered = 'no' WHERE id = :id");

    $stmt->bindParam(':id', $id);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        throw $e;
    }
}

function deleteOrder($id)
{
    global $conn;

    $stmt = $conn->prepare("DELETE FROM orders  WHERE id = :id");

    $stmt->bindParam(':id', $id);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        throw $e;
    }
}

function addProduct($prod)
{
    global $conn;

    $stmt = $conn->prepare("INSERT INTO products (name, price, catId, subCatId, information, image) VALUES (:name, :price, :catId, :subCatId , :information, :image)");

    $stmt->bindParam(':name', $prod['name']);
    $stmt->bindParam(':price', $prod['price']);
    $stmt->bindParam(':catId', $prod['catId']);
    $stmt->bindParam(':subCatId', $prod['subCatId']);
    $stmt->bindParam(':information', $prod['info']);
    $stmt->bindParam(':image', $prod['image']);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        throw $e;
    }
}


function addProductAndImage($prod, $file)
{
    $target_dir = '../assets/img/product/'; // path relative to addProd.php
    $target_file = $target_dir . basename($file["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($file["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo '<div class="alert alert-danger">Sorry, file already exists.</div>';
        $uploadOk = 0;
    }
    // Check file size
    if ($file["image"]["size"] > 500000) {
        echo 'Sorry, your file is too large.';
        $uploadOk = 0;
    }
    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        // echo ', your file was not uploaded.';
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($file["image"]["tmp_name"], $target_file)) {
            // echo "The file " . basename($file["image"]["name"]) . " has been uploaded.";

            // Adding Product To Table
            addProduct($prod);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
