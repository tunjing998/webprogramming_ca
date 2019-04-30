<div class="container">
	<table class="table">
		<thead>
			<tr>
				<th>Order Id</th>
				<!-- <th>clientid</th> -->
				<th>Order Date</th>
				<th>Order status</th>
				<th>Show</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($locals['orders'] as $order) {
				switch ($order->getOrderStatus()) {
					case 'Unpaid':
						$class = 'bg-light';
						break;
					case 'Dispatching':
						$class = 'bg-warning';
						break;
					case 'Completed':
						$class = 'bg-success';
						break;
					case 'Canceled':
						$class = 'bg-danger';
						break;
				}
				?>
				
					<tr class="<?= $class ?>">
						<td><?= $order->getOrderId() ?></td>
						<td><?= $order->getOrderDate() ?></td>
						<td><?= $order->getOrderStatus() ?></td>
						<td><a href='<?= BASE_DIR ?>/order/<?= $order->getOrderId() ?>'>Show Order Details</a></td>
						<!-- <td>待发货</td> -->
					</tr>
			
			<?php } ?>
		</tbody>
	</table>
</div>