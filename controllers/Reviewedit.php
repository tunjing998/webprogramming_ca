<?php return function ($req, $res) {

    $layout = Utils::checkLayout($req->session('id'));
    if ($layout == 'main') {
        $res->redirect('/');
    }

    $client_id = $req->session('id');
    $product_id = $req->param('id');

    $form_posted = (!$req->body('review_title') == null);

    if ($form_posted) {
        require_once 'models/Review.php';
        $args = [
            'product_id' => $product_id,
            'client_id' => $client_id,
            'review_title' => $req->body('review_title'),
            'review_text' => $req->body('review_text'),
            'suggest' => $req->body('suggest')
        ];
        $review = new Review($args);
        $review->save();
        $res->redirect('/product/' . $product_id);
    } else {
        require_once 'models/Order.php';
        $orders = Order::findByClientId($client_id);
        $bought = false;
        foreach ($orders as $order) {
            $order_details = Order::findOrderDetailById($order->getOrderId());
            foreach ($order_details as $order_detail) {
                if ($order_detail['product_id'] == $product_id) {
                    $bought = true;
                    break;
                }
                if ($bought) {
                    break;
                }
            }
        }
        if ($bought) {

                $res->render($layout, 'reviewedit', [
                    'page_title' => 'Review Details',
                    'product_id' => $product_id,
                    'client_id' => $client_id
                ]);
            } else {
                $res->redirect('/product/' . $product_id);
            }
    }
}
?>