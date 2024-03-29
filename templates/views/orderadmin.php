<div class="container">
	<table class="table">
		<thead>
			<tr>
				<th>orderid</th>
				<th>clientid</th>
				<th>orderdate</th>
				<th>orderstatus</th>
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
                        <td><?= $order->getClientId()?></td>
						<td><?= $order->getOrderDate() ?></td>
						<td><?= $order->getOrderStatus() ?></td>
						<td><a href='<?= BASE_DIR ?>/order/<?= $order->getOrderId() ?>'>Show Order Details</a></td>
					</tr>
			<?php } ?>
		</tbody>
	</table>
</div>