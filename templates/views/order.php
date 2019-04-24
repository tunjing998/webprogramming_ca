<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>ordertable</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<table class="table">
	<caption>ordertable</caption> //根据发货状态不同颜色不同
	<thead>
		<tr>
			<th>orderid</th>
			<th>clientid</th>
			<th>orderdate</th>
			<th>orderstatus</th>
		</tr>
	</thead>
	<tbody>
		<tr class="active">
			<td></td>
			<td></td>
			<td></td>
			<td>待发货</td>
		</tr>
		<tr class="success">
			<td></td>
			<td></td>
			<td></td>
			<td>发货中</td>
		</tr>
		<tr  class="warning">
			<td></td>
			<td></td>
			<td></td>
			<td>待确认</td>
		</tr>
		<tr  class="danger">
			<td></td>
			<td></td>
			<td></td>
			<td>已退货</td>
		</tr>
	</tbody>
</table>

</body>
</html>