<?php session_start()?>
<!Doctype html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title>Доска объявлений</title>
   <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="shortcut icon" type="image/x-icon" href="public/img/favicon.png">
   <link rel="stylesheet" href="/public/css/bootstrap.min.css">
   <link rel="stylesheet" href="/public/css/slicknav.css">
   <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <header>
         <div class="header-area ">
             <div class="header_top">
                 <div class="container">
                     <div class="row align-items-center">
                         <div class="col-xl-4 col-md-4 d-none d-md-block">
                             <div class="header_links ">  
                                 <ul>
                                     <li>Логотип</li>
                                 </ul>  
                             </div>
                         </div>
                         <div class="col-xl-4 col-md-4">
                             <div class="logo">
                                 <a href="index.html">
                                   <span style="font-size: 20px">Краснодарская доска объявлений</span>
                                 </a>
                             </div>
                         </div>
                          <div class="col-xl-4 col-md-4 d-none d-md-block">
                             <div class="login_resiter">
                              <a href="/ads/add"><button type="button" class="btn btn-warning">Добавить объявление</button></a> 
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div id="sticky-header" class="main-header-area white-bg">
                 <div class="container">
                     <div class="row align-items-center">
                         <div class="col-xl-7 col-lg-7">
                             <div class="main-menu  d-none d-lg-block">
                                <nav>
                                     <ul id="navigation">
                                         <li><a href="/">Главная</a></li>
                                     </ul>
                                 </nav>
                             </div>
                         </div>
                         <div class="col-12">
                             <div class="mobile_menu d-block d-lg-none">
							 </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </header>
   <section class="blog_area single-post-area section-padding">
      <div class="container">
         <div class="row">
            <div class="col-lg-8 posts-list">
            <h1 style="text-align:center">Комментарии к моим объявлениям</h1>
                
              <?php foreach($ads as $comment):?>
              <div class="comment-list">
                     <div class="single-comment justify-content-between d-flex">
                        <div class="user justify-content-between d-flex">
                           <div class="desc" style="padding-left: 10px">
                            <span style="font-weight: bold;font-size: 20px">№<?php echo $comment["id"]?></span> 
                              <p class="comment">
                            <?php echo $comment["text"] ?>
                              </p>
                              <div class="d-flex justify-content-between">
                                 <div class="d-flex align-items-center">
                                <ul>
                                 <a href="/comments/delete/<?php echo $comment["id"]?>"><button type="button" class="btn btn-danger">Удалить</button></a>   
                             
                               </ul>
                                 </div>
                                 
                                    <div>
                                  
                                  </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <br>
                  </div><br>
              
              
                
              <?php endforeach ?>
         <?php if(empty($ads)): ?>
           <p>У вас нет комментариев</p>      
         <?php endif ?>       
            </div>
            <div class="col-lg-4">
               <div class="blog_right_sidebar">
                  <?php if(!isset($_SESSION['login'])):?>
                   <aside class="single_sidebar_widget search_widget">
                     <form action="/user/auth" method="post">
                        <div class="form-group">
                              <input type="text" class="form-control" placeholder='Введите email' name="email">
                                 </div>
                                 <div class="form-group"> 
                              <input type="text" class="form-control" placeholder='Введите пароль' name="password">
                                 </div>
                             
                                <button type="submit" class="btn btn-success">Войти</button>
                                 <a href="/user/forgot"><p style="color: blue">Забыли пароль?</p></a>
                                <a href="/user/reg"><button type="button" class="btn btn-primary">Регистрация</button></a>
                     </form>
                  </aside>
                   <?php else:?>
                       
                   <aside class="single_sidebar_widget search_widget">
                     <form action="/user/logout" method="post">
                     
                        <div class="form-group">
                      <?php echo   "Привет, ".$_SESSION['login']?>
                        </div>
                        
                         
                        <div class="form-group">
                           <?php if($_SESSION['role'] == 10):?>          
                           <a href="/user/admin"><p style="color:blue">Вход в админку</p></a>        
                           <?php endif?>          
                           <a href="/ads/myads"><p style="color:blue">Мои объявления</p></a>
                              <?php if ($res["vip"] == 1): ?>           
                           <a href="/comments/ads"><p style="color:blue">Комментарии к моим объявлениям</p></a> 
                          <p style="font-weight:bold">Срок действия бизнес-акаунта истекает 
                                    <?php echo  $res["date_vip_off"] ?></p>
                              <?php endif?>       
                        </div>  
                    <button type="submit" class="btn btn-success">Выйти</button>
                     </form>
                  </aside>

                   <?php endif?>             
                 <aside class="single_sidebar_widget post_category_widget">
                     <h4 class="widget_title">Категория</h4>
                     <ul class="list cat-list">
                         <?php foreach($data as $category):?>  
                         <li>
                           <a href="/ads/category/<?php echo $category["id"]?>" class="d-flex">
                              <p><?php echo $category['name']?></p>
                              <p>(<?php echo $category['count_total']?>)</p>
                           </a>
                        </li>
                     <?php endforeach ?>
                     </ul>
                  </aside>
               </div>
            </div>
         </div>
      </div>
   </section>
    <?php require_once 'public/blocks/footer.php' ?>