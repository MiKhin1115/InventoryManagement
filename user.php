<?php
$page_title = 'User Dashboard';
require_once('includes/load.php');
// Only logged in users of level 2 or lower can access this page
page_require_level(3);
if (!$session->isUserLoggedIn(true)) {
    redirect('index.php', false);
}
$c_sale = count_by_id('sales');
$recent_sales = find_recent_sale_added('5');
include_once('layouts/header.php');
?>

<div class="row">
    <div class="col-md-12">
        <?php echo display_msg($msg); ?>
    </div>
</div>

<div class="row">
    <a href="sales.php" style="color:black;">
        <div class="col-md-4">
            <div class="panel panel-box clearfix">
                <div class="panel-icon pull-left bg-green">
                    <i class="glyphicon glyphicon-usd"></i>
                </div>
                <div class="panel-value pull-right">
                    <h2 class="margin-top"><?php echo $c_sale['total']; ?></h2>
                    <p class="text-muted">Total Sales</p>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Latest Sales</span>
                </strong>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Date</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_sales as $recent): ?>
                        <tr>
                            <td class="text-center"><?php echo count_id(); ?></td>
                            <td>
                                <a href="edit_sale.php?id=<?php echo (int) $recent['id']; ?>">
                                    <?php echo remove_junk(first_character($recent['name'])); ?>
                                </a>
                            </td>
                            <td><?php echo remove_junk($recent['date']); ?></td>
                            <td>$<?php echo remove_junk($recent['price']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include_once('layouts/footer.php'); ?>