<?php include('header.php'); ?>

<?php 

    if(isset($_GET['product_id'])){

        $product_id = $_GET['product_id'];
        $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
        $stmt->bind_param('i', $product_id);
        $stmt->execute();
        
        $products = $stmt->get_result();

    }else if(isset($_POST['edit_btn'])){
        
        $product_id = $_POST['product_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        $stmt = $conn->prepare("UPDATE products SET product_name = ?, product_description = ?, product_price = ?
                 WHERE product_id = ?");
        $stmt->bind_param('sssi', $title, $description, $price, $product_id);


        if($stmt->execute()){
            header('location: products.php?edit_success_message=Product has been updated successfully');
        }else{
            header('location: products.php?edit_failure_message=Error occured, try again');
        }
        

        
    
    
    }else{
        header('location: products.php');
        exit;
    }
    
?>




<div class="container-fluid">
    <div class="row">


        <?php include('sidemenu.php'); ?>
        


    
        <main class="col-md-9 ms_sm_auto col_lg-10 px_md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Dashboard</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">

                    </div>
                </div>
            </div>

            <h2>Edit Products</h2>
            <div class="table-responsive">
                <div class="mx-auto container">
                    <form id="edit-form" method="POST" action="edit_product.php">
                        <p style="color :red;"><?php if(isset($_GET['error'])){echo $_GET ['error'];  }?></p>
                        <div class="form-group mt-2">
                            
                            <?php foreach($products as $product){ ?>

                                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
                            <label>Title</label>
                            <input type="text" class="form-control" id="product-name" value="<?php  echo $product['product_name'] ?>" name="title" placeholder="Title" required>
                        </div>
                        <div class="form-group mt-2">
                            <label>Description</label>
                            <input type="text" class="form-control" id="product-desc" value="<?php echo $product['product_description'] ?>" name="description" placeholder="Description" required>
                        </div>
                        <div class="form-group mt-2">
                            <label>Price</label>
                            <input type="text" class="form-control" id="product-price" value="<?php echo $product['product_price'] ?>" name="price" placeholder="Price" required> 
                        </div>
                        <div class="form-group mt-3">
                            <input type="submit" class="btn btn-primary" name="edit_btn" value="Edit"/> 
                        </div>
                        
                        <?php } ?>
                    </form>
                </div>


                










            </div>

        </main>
    </div>
</div>