<?php return function($req, $res) {
if(1!=($req->session('id')))
{
    $res->redirect('/');
}
require_once 'models/Product.php';
require_once 'models/Review.php';
if($req->param('id')!=null)
{
$product = Product::findOneById(intval($req->param('id')));
$review = Review::findByProductId($product->getProductId());
}
else
{
    $product = new Product([]);
    $review = null;
}
$form_posted = (!$req->body('product_name') == null);
if($form_posted)
{
    $product->setProductId($req->body('product_id')??null);
    $product->setProductName($req->body('product_name'));
    $product->setProductType($req->body('product_type'));
    $product->setProductDetail($req->body('product_details'));
    $product->setProductPrice($req->body('product_price'));
    if($_FILES['image']['name']!=null)
    {
    require_once 'lib/ImageStore.php';
    $targetdir = "assets/img/productImg/";
    $success= ImageStore::storeImage($_FILES, $targetdir);
    }
    if($success)
    {
        $product->setProductImageAddr($_FILES['image']['name']);
        if($product->save()){
        $res->redirect('/productadmin');
        }
        else
        {
            $error = 'Not Saved';
        }
    }
    else
    {
        $error = 'Not Saved';
    }
}
$res->render('admin', 'productedit', [
  'page_title' => 'Products','product'=>$product,'review'=>$review,'error'=>$error??null
]);
}
?>