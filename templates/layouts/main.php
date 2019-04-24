<!doctype html>
<html lang="zh">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bootstrap左侧下拉三级菜单导航</title>
        <!--<link rel="stylesheet" type="text/css" href="css/normalize.css" />-->

        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/metismenu.min.css">
        <link rel="stylesheet" href="assets/css/demo.css">
        <link rel="stylesheet" href="assets/css/prism.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/default.css">
        <!--[if IE]>
                <script src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
                <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="sucaihuo-container">
            <div class="sucaihuo-content bgcolor-7">
                <div class="clearfix">
                    <aside class="sidebar">
                        <nav class="sidebar-nav">
                            <ul id="menu">
                                <li class="active">
                                    <a href="#">
                                        <span class="sidebar-nav-item-icon fa fa-github fa-lg"></span>
                                        <span class="sidebar-nav-item">home</span>
                                        <span class="fa arrow"></span>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="" target="_blank">
                                                <span class="sidebar-nav-item-icon fa fa-code-fork"></span>
                                                牛逼
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" target="_blank">
                                                <span class="sidebar-nav-item-icon fa fa-star"></span>
                                                牛逼
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" target="_blank">
                                                <span class="sidebar-nav-item-icon fa fa-exclamation-triangle"></span>
                                                牛逼
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Menu 0 <span class="fa arrow"></span></a>
                                    <ul>
                                        <li><a href="#">item 0.1</a></li>
                                        <li><a href="#">item 0.2</a></li>
                                        <li><a href="http://www.sucaihuo.com/" target="_blank">onokumus</a></li>
                                        <li><a href="#">item 0.4</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Menu 1 <span class="glyphicon arrow"></span></a>
                                    <ul>
                                        <li><a href="#">item 1.1</a></li>
                                        <li><a href="#">item 1.2</a></li>
                                        <li>
                                            <a href="#">Menu 1.3 <span class="fa plus-times"></span></a>
                                            <ul>
                                                <li><a href="#">item 1.3.1</a></li>
                                                <li><a href="#">item 1.3.2</a></li>
                                                <li><a href="#">item 1.3.3</a></li>
                                                <li><a href="#">item 1.3.4</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">item 1.4</a></li>
                                        <li>
                                            <a href="#">Menu 1.5 <span class="fa plus-minus"></span></a>
                                            <ul>
                                                <li><a href="#">item 1.5.1</a></li>
                                                <li><a href="#">item 1.5.2</a></li>
                                                <li><a href="#">item 1.5.3</a></li>
                                                <li><a href="#">item 1.5.4</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Menu 2 <span class="glyphicon arrow"></span></a>
                                    <ul>
                                        <li><a href="#">item 2.1</a></li>
                                        <li><a href="#">item 2.2</a></li>
                                        <li><a href="#">item 2.3</a></li>
                                        <li><a href="#">item 2.4</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </aside>
                 
                    <section class="content">
                        <div class="col-xs-12">
                            <h3>home  <small>login in </small></h3>
                            <div class="panel panel-default">
								
                                <div class="panel-heading">
                                    balbalaba
                                    <span class="pull-right"><span class="fa fa-code"></span></span>
                                </div>
                                <div class="panel-body">
                                    <pre><code class="language-markup">put one login table or picture </code></pre>

                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="content">
                        <div class="col-xs-12">
                            <h3>home  <small>login in </small></h3>
                            <div class="panel panel-default">
								
                                <div class="panel-heading">
                                    balbalaba
                                    <span class="pull-right"><span class="fa fa-code"></span></span>
                                </div>
                                <div class="panel-body">
                                    <pre><code class="language-markup">put one login table or picture </code></pre>

                                </div>
                            </div>
                        </div>
                    </section>

                </div>





               
      


               
                    
     


                </div>
            </div>
        </div>

        <script src="assets/js/jquery.min.js"></script>

        <script src="assets/js/metismenu.js"></script>

        <script>
            $(function() {

                $('#menu').metisMenu();

                $('#menu2').metisMenu({
                    toggle: false
                });

                $('#menu3').metisMenu({
                    doubleTapToGo: true
                });
            });
        </script>

        <script src="assets/js/prism.min.js"></script>
    </body>
</html>

<!-- 以下是统计及其他信息，与演示无关，不必理会 -->
<p class="vad">
    <a href="" target="_blank">牛逼</a>
    <a href="" target="_blank">牛逼</a>
    <a href="" target="_blank">牛逼</a>
</p>
<style type="text/css">
    .vad { margin: 20px 0 5px; font-family: Consolas,arial,宋体,sans-serif; text-align:center;}
    .vad a { display: inline-block; height: 36px; line-height: 36px; margin: 0 5px; padding: 0 50px; font-size: 14px; text-align:center; color:#eee; text-decoration: none; background-color: #222;}
    .vad a:hover { color: #fff; background-color: #000;}
    .thead { width: 728px; height: 90px; margin: 0 auto; border-bottom: 40px solid #fff;}
</style>
<div style="width:728px;margin:0 auto">

//广告位置
    <script type="text/javascript">
        /*700*90 创建于 2015-06-27*/
        var cpro_id = "u2176575";
    </script>
    <script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script>
</div>
<!-- 以上是统计及其他信息，与演示无关，不必理会 -->