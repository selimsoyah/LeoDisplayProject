<?php include('header.php'); ?>

<?php 
    
    if($_GET['product_id']){

        $product_id = $_GET['product_id'];
        $stmt = $conn->prepare("SELECT * FROM products WHERE product_id =?");
        $stmt->bind_param('i', $product_id);
        $stmt->execute();
        
        $products = $stmt->get_result();

    }else{
        header('products.php');
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
                    <form id="edit-form" enctype="multipart/form_data">
                        <p style="color :red;"><?php if(isset($_GET['error'])){echo $_GET ['error'];  }?></p>
                        <div class="form-group mt-2">
                            <?php foreach($products as $product){ ?>
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
                        <div class="form-group mt-2">
                            <label>Category</label>
                            <select class="form-select" required name="category">
                                <option value="flags">Flag</option>
                                <option value="standmodulaire">Stand Modulaire</option>
                                <option value="standparapluie">Stand Parapluie</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <input type="submit" class="btn btn-primary" name="edit_product" value="Edit"/> 
                        </div>
                        
                        <?php } ?>
                    </form>
                </div>


                










            </div>

        </main>
    </div>
</div>