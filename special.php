<?php
$page_title = 'Special User Dashboard';
require_once('includes/load.php');
page_require_level(2); // Adjust this depending on the role level for special user
if (!$session->isUserLoggedIn(true)) {
    redirect('index.php', false);
}
$c_categorie = count_by_id('categories');
$c_product = count_by_id('products');
$recent_products = find_recent_product_added('5');
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <?php echo display_msg($msg); ?>
    </div>
</div>

<div class="row">
    <a href="categorie.php" style="color:black;">
        <div class="col-md-6">
            <div class="panel panel-box clearfix">
                <div class="panel-icon pull-left bg-red">
                    <i class="glyphicon glyphicon-indent-left"></i>
                </div>
                <div class="panel-value pull-right">
                    <h2 class="margin-top"><?php echo $c_categorie['total']; ?></h2>
                    <p class="text-muted">Categories</p>
                </div>
            </div>
        </div>
    </a>

    <a href="product.php" style="color:black;">
        <div class="col-md-6">
            <div class="panel panel-box clearfix">
                <div class="panel-icon pull-left bg-blue2">
                    <i class="glyphicon glyphicon-th-large"></i>
                </div>
                <div class="panel-value pull-right">
                    <h2 class="margin-top"><?php echo $c_product['total']; ?></h2>
                    <p class="text-muted">Products</p>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong><span class="glyphicon glyphicon-th"></span> Recently Added Products</strong>
            </div>
            <div class="panel-body">
                <div class="list-group">
                    <?php foreach ($recent_products as $recent_product): ?>
                        <a class="list-group-item clearfix"
                            href="edit_product.php?id=<?php echo (int) $recent_product['id']; ?>">
                            <h4 class="list-group-item-heading">
                                <?php if ($recent_product['media_id'] === '0'): ?>
                                    <img class="img-avatar img-circle" src="uploads/products/no_image.png" alt="">
                                <?php else: ?>
                                    <img class="img-avatar img-circle"
                                        src="uploads/products/<?php echo $recent_product['image']; ?>" alt="">
                                <?php endif; ?>
                                <?php echo remove_junk(first_character($recent_product['name'])); ?>
                                <span
                                    class="label label-warning pull-right"><?php echo (int) $recent_product['sale_price']; ?></span>
                            </h4>
                            <span
                                class="list-group-item-text pull-right"><?php echo remove_junk(first_character($recent_product['categorie'])); ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once('layouts/footer.php'); ?>