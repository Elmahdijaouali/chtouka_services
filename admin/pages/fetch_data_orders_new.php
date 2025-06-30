<?php  
session_start();

if (isset($_SESSION['admin'])) {
    require_once '../includes/con_db.php';

    // SQL query to join orders with products
    $sql = "SELECT order_id, pt.name as name_product, name_client, city_client, tel_client, qte_product, order_date, price, status
            FROM orders o
            INNER JOIN product p ON o.product_id = p.product_id 
            LEFT JOIN product_translation pt ON pt.product_id = p.product_id AND pt.language_code = 'fr'
            WHERE `status` = ?
            ORDER BY order_date DESC 
             ";
    
    $req = $con->prepare($sql);
    $req->execute(["pending"]);
    $orders = $req->fetchAll(PDO::FETCH_ASSOC);
    
    ?>
    <style>
        @media (max-width:1000px) {
            .table_orders th, .table_orders td {
                min-width: 160px;
            }
            .table_orders th:last-child, .table_orders td:last-child {
                min-width: 220px !important;
            }
        }
    </style>
    <table class="posts-table styled-table table_orders">
        <thead>
            <tr class="users-table-info">
                <th>Order ID</th>
                <th>Name client</th>
                <th>Phone number</th>
                <th>City</th>
                <th>Name product</th>
                <th>Qte product</th>
                <th>Total Price</th>
                <th>Order Date</th>   
                <th>Status</th> <!-- New Status Column -->
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($orders)):
                foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                        <td><?php echo htmlspecialchars($order['name_client']); ?></td>
                        <td>0<?php echo htmlspecialchars($order['tel_client']); ?></td>
                        <td><?php echo htmlspecialchars($order['city_client']); ?></td>
                        <td><?php echo htmlspecialchars($order['name_product']); ?></td>
                        <td><?php echo htmlspecialchars($order['qte_product']); ?></td>
                        <td><?php echo htmlspecialchars($order['price'] * $order['qte_product']); ?> DH</td>
                        <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                        <td>
                            <form action="pages/update_order_status.php" method="POST">
                                <select name="status" onchange="this.form.submit()">
                                    <option value="pending" <?php echo $order['status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                                    <option value="processing" <?php echo $order['status'] === 'processing' ? 'selected' : ''; ?>>Processing</option>
                                    <option value="completed" <?php echo $order['status'] === 'completed' ? 'selected' : ''; ?>>Completed</option>
                                    <option value="cancelled" <?php echo $order['status'] === 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                                </select>
                                <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order['order_id']); ?>">
                            </form>
                        </td>
                        <td>
                            <a class="btn btn-info" href="whatsapp://send?phone=212<?php echo htmlspecialchars($order['tel_client']); ?>">Contact</a>

                            <?php if ($_SESSION['role'] == "superadmin"): ?> 
                                <a class="btn btn-danger" href="pages/delete_order.php?order_id=<?php echo htmlspecialchars($order['order_id']); ?>">Delete</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10">No orders found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

<?php
} else {
    header('Location: login.php');
    exit();
}
?>
