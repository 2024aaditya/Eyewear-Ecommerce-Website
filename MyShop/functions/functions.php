<?php
$con = mysqli_connect("localhost", "root", "", "myshop");
// Function for getting the IP address
function getRealIpAddr(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        // Check for shared client IPs
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // Check for IPs from a proxy or load balancer
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        // Default to the remote IP address
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    
    // Remove any potential extra IPs or whitespace
    $ip = trim($ip);
    $ipList = explode(',', $ip);
    $ip = trim($ipList[0]);
    
    return $ip;
}


function cart() {
    if (isset($_GET['add_cart'])) {
        global $con;
        $ip_add = getRealIpAddr();
        $p_id = $_GET['add_cart'];
        $check_pro = "SELECT * FROM cart WHERE ip_add='$ip_add' AND p_id='$p_id'";
        $run_check = mysqli_query($con, $check_pro);
        
        if (mysqli_num_rows($run_check) > 0) {
            echo "";
        } else {
            $q = "INSERT INTO cart (p_id, ip_add) VALUES ('$p_id', '$ip_add')";
            $run_q = mysqli_query($con, $q);
            echo "<script>window.open('index.php', '_self')</script>";
        }
    }
}

function items() {
    global $con;
    $ip_add = getRealIpAddr();

    if (isset($_GET['add_cart'])) {
        $get_items = "SELECT * FROM cart WHERE ip_add='$ip_add'";
        $run_items = mysqli_query($con, $get_items);
        $count_items = mysqli_num_rows($run_items);
    } else {
        $ip_add = getRealIpAddr();
        global $con;
        $get_items = "SELECT * FROM cart WHERE ip_add='$ip_add'";
        $run_items = mysqli_query($con, $get_items);
        $count_items = mysqli_num_rows($run_items);
    }

    echo $count_items;
}

function total_price() {
    $ip_add = getRealIpAddr();
    global $con;
    $total = 0;

    $sel_price = "SELECT * FROM cart WHERE ip_add='$ip_add'";
    $run_price = mysqli_query($con, $sel_price);

    while ($record = mysqli_fetch_array($run_price)) {
        $pro_id = $record['p_id'];
        $pro_price_query = "SELECT product_price FROM products WHERE product_id='$pro_id'";
        $run_pro_price = mysqli_query($con, $pro_price_query);

        if ($pro_price_record = mysqli_fetch_array($run_pro_price)) {
            $product_price = $pro_price_record['product_price'];
            $total += $product_price;
        }
    }

    echo "RS " . $total;
}


function getPro()
{
    global $con; 
    if (!isset($_GET['cat']) && !isset($_GET['brand'])) {
        $get_products = "select * from products order by rand() LIMIT 15";

        $run_products = mysqli_query($con, $get_products);
        while ($row_products = mysqli_fetch_array($run_products)) {
            $pro_id = $row_products['product_id'];
            $pro_title = $row_products['product_title'];
            $pro_cat = $row_products['cat_id'];
            $pro_brand = $row_products['brand_id'];
            $pro_desc = $row_products['product_desc'];
            $pro_price = $row_products['product_price'];
            $pro_image = $row_products['product_img1'];

            echo "
            <div id='single_product'>
            <h3>$pro_title</h3>
            <img src='admin_area/product_images/$pro_image' width='490' height='300'/><br>
            <p><b>Price: RS $pro_price  </b></p>
        
            <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
            <a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to Cart</button></a>
        </div>
            ";
        }
    }
}
function getPro1()
{
    global $con; 
    if (!isset($_GET['cat']) && !isset($_GET['brand'])) {
        $get_products = "select * from products order by rand() LIMIT 6";

        $run_products = mysqli_query($con, $get_products);
        while ($row_products = mysqli_fetch_array($run_products)) {
            $pro_id = $row_products['product_id'];
            $pro_title = $row_products['product_title'];
            $pro_cat = $row_products['cat_id'];
            $pro_brand = $row_products['brand_id'];
            $pro_desc = $row_products['product_desc'];
            $pro_price = $row_products['product_price'];
            $pro_image = $row_products['product_img1'];

            echo "
            <div id='single_product'>
            <h3>$pro_title</h3>
            <img src='admin_area/product_images/$pro_image' width='490' height='300'/><br>
            <p><b>Price: RS $pro_price  </b></p>
        
            <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
            <a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to Cart</button></a>
        </div>
            ";
        }
    }
}



function getCatPro()
{
    global $con; // Using global $con variable

    // Check if 'cat' parameter is set
    if (isset($_GET['cat'])){
        $cat_id = $_GET['cat'];
        $get_cat_pro = "select * from products where cat_id='$cat_id'";
        $run_cat_pro = mysqli_query($con, $get_cat_pro);
        $count = mysqli_num_rows($run_cat_pro);
        if($count==0){
            echo "<h2>No Products found in this category</h2>";
        }
    
        while ($row_cat_pro = mysqli_fetch_array($run_cat_pro)) {
            $pro_id = $row_cat_pro['product_id'];
            $pro_title = $row_cat_pro['product_title'];
            $pro_cat = $row_cat_pro['cat_id'];
            $pro_brand = $row_cat_pro['brand_id'];
            $pro_desc = $row_cat_pro['product_desc'];
            $pro_price = $row_cat_pro['product_price'];
            $pro_image = $row_cat_pro['product_img1'];
    
            echo "
            <div id='single_product'>
            <h3>$pro_title</h3>
            <img src='admin_area/product_images/$pro_image' width='490' height='300'/><br>
            <p><b>Price: RS $pro_price  </b></p>
        
            <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
            <a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to Cart</button></a>
            </div>
            ";
        }
    }
}

function getBrandPro()
{
    global $con; // Using global $con variable

    // Check if 'brand' parameter is set
    if (isset($_GET['brand'])) {
        $brand_id = $_GET['brand']; // Corrected the variable name to 'brand_id'
        $get_brand_pro = "select * from products where brand_id='$brand_id'";
        $run_brand_pro = mysqli_query($con, $get_brand_pro);
        $count = mysqli_num_rows($run_brand_pro);
        
        if ($count == 0) {
            echo "<h2>No Products found for this brand</h2>";
        } else {
            while ($row_brand_pro = mysqli_fetch_array($run_brand_pro)) {
                $pro_id = $row_brand_pro['product_id'];
                $pro_title = $row_brand_pro['product_title'];
                $pro_cat = $row_brand_pro['cat_id'];
                $pro_brand = $row_brand_pro['brand_id'];
                $pro_desc = $row_brand_pro['product_desc'];
                $pro_price = $row_brand_pro['product_price'];
                $pro_image = $row_brand_pro['product_img1'];

                echo "
                <div id='single_product'>
                <h3>$pro_title</h3>
                <img src='admin_area/product_images/$pro_image' width='490' height='300'/><br>
                <p><b>Price: RS $pro_price  </b></p>
            
                <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
                <a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to Cart</button></a>
                </div>
                ";
            }
        }
    }
}




function getBrands()
{
    global $con; // Using global $con variable

    $get_brands = "select * from brands";
    $run_brands = mysqli_query($con, $get_brands);

    while ($row_brands = mysqli_fetch_array($run_brands)) {
        $brand_id = $row_brands['brand_id'];
        $brand_title = $row_brands['brand_title'];

        echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
    }
}

function getCats()
{
    global $con; // Using global $con variable

    $get_cats = "select * from category";
    $run_cats = mysqli_query($con, $get_cats);

    while ($row_cats = mysqli_fetch_array($run_cats)) {
        $cat_id = $row_cats['cat_id'];
        $cat_title = $row_cats['cat_title'];

        echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
    }
}
?>
