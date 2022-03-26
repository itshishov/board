<?php session_start()?>
<!Doctype html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title>Добавить комментарий</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="shortcut icon" type="image/x-icon" href="public/img/favicon.png">
   <link rel="stylesheet" href="/public/css/bootstrap.min.css">
   <link rel="stylesheet" href="/public/css/slicknav.css">
   <link rel="stylesheet" href="/public/css/style.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>	
<script src="/public/js/jquery-3.0.0.min.js"></script><br>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
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
                                     <li>Логотип
</li>
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
                             <div class="mobile_menu d-block d-lg-none"></div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </header>
   <section>
      <div class="container">
         <div class="row">
            <div class="col-lg-8 posts-list">  
              <br><br><br><br><br>
             <div class="comment-list">
                 <h1 style="text-align:center;padding-bottom:30px">Комментарии</h1>
                     <div class="single-comment justify-content-between d-flex">
                        <div class="user justify-content-between d-flex">
                           <div class="desc" style="padding-left: 10px">
                            <span style="font-weight: bold;font-size: 20px">№<?php echo $ads["id"]?> <?php echo $ads["name"] ?></span> 
                              <p class="comment">
                            <?php echo $ads["text"] ?>
                              </p>
                              <div class="d-flex justify-content-between">
                                 <div class="d-flex align-items-center">
                                <ul>
                            <li style="color: blue;font-size: 16px"><?php echo $ads["login"] ?></li>       
                             <li  style="font-size: 16px;"><?php echo $ads["data"] ?></li> 
                               </ul>
                                 </div>
                              </div>
                               
                       
                               
                           </div>
                        </div>
                         
                     </div>
                 
                 
                 
                 <?php if(!empty($resilt)): ?> 
                <?php foreach($resilt as $comment) :?>           
                
                <br><br>
                <div style="height:120px;background-color:#e8e8e8;">              
                <p style="padding-top:10px;padding-bottom:10px;padding-left:20px;height:80px"><?php echo $comment["text"]?></p><span style="padding-left:20px">   <?php echo $comment["data_add"] ?></span><span style="padding-left:10px;color:blue;padding-left:20px"><?php echo $comment["login"] ?></span>    
                </div> 
                <?php endforeach ?>               
                <?php else: ?>
                <br><br>               
                <p style="background-color:#e8e8e8;padding-top:10px;padding-bottom:10px;padding-left:20px">Нет добавленных комментариев</p>               
                <?php endif ?>         
                 
                 
                 
                 
                     <br>
               
                  </div><br>
                <p style="color:green;text-align:center;font-size:30px"><?php echo $mess["success"] ?></p>
               <div class="comment-form">
                  <h1 style="text-align: center">Добавить коментарий</h1>
                  <form method="post" action="/comments/index/<?php echo $ads["id"]?>"  data-id="<?php echo $ads["id"]?>">
                     <div class="row">
                        <div class="col-12">
                           <div class="form-group">
                              <textarea class="form-control w-100"  cols="30" rows="9"
                                 placeholder="Введите текст коментария" name="comment" id="text" required></textarea>
                           </div>
                        </div>
                     </div>
                      <?php if(isset($_SESSION['login'])):?>
					 <?php if ($res["role"] == 1 OR $res["role"] == 10):?> 
					  <?php if ($res["ban"] == 0):?> 
					  <div class="form-group">
                       <button type="submit" class="button button-contactForm btn_1 boxed-btn">Отправить</button>
                     </div>
                      
                      <p id="text_change" style="color:green"></p>
                      
 <script>
   $(Document).on('click', '.button button-contactForm btn_1 boxed-btn', function(e){
   e.preventDefault();
   var id = $(this).data('id');
   var text = $('#text').val();
   $.ajax({
            url: '/comments/index/<?php echo $ads["id"]?>',
            data: {'id': id,'text': text},
       dataType : "html",
       method: 'post',
       
          	success: function(data){
                 if ($("#text").val().length == 0){
              alert("Введите комментарий");
              }
                else{
                     	text_out();
}},
});
});				
</script>
                      
<script>
    function text_out(){
    var p;
     p = document.getElementById('text_change');
    p.innerHTML = 'Комментарий отправлен на проверку';
    }        
</script>
                      
					  <?php else:?>
                     <div class="form-group">
    <p style="color:red">За нарушение правил вы были заблокированы до <?php echo $res["date_ban"] ?></p> 
                     </div>
					 <?php endif?> 
					   <?php else:?>
					  <div class="form-group">
    <p style="color:red">Необходимо подтвердить регистрацию. Вам было отправлено письмо на Email, который вы указывали при регистрации.</p> 
                     </div>
					  <?php endif?>
                      <?php else:?>
                      <div class="form-group">
                      <p style="color:red">Для того, чтобы добавить коментарий необходимо войти в личный кабинет</p>
                     </div>
                       <?php endif?>
                  </form>
               </div>
            </div>    
           <div class="col-lg-4">
               <div class="blog_right_sidebar">
                     <?php if(!isset($_SESSION['login'])):?>
                   <br><br><br><br><br>
                   <aside class="single_sidebar_widget search_widget">
                     <form action="/user/auth" method="post">
                        <div class="form-group">
                              <input type="text" class="form-control" placeholder='Email' name="email">
                                 </div>
                                 <div class="form-group"> 
                              <input type="text" class="form-control" placeholder='Пароль' name="password">
                                 </div>
                           
                                <button type="submit" class="btn btn-success">Войти</button>
                                 <a href="/user/forgot"><p style="color: blue">Забыли пароль?</p></a>
                                
                                <a href="/user/reg"><button type="button" class="btn btn-primary">Регистрация</button></a>
                     </form>
                  </aside>
                   <?php else:?>
                      <br><br><br><br><br>
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
                            
                                      <?php if ($comments["vip"] == 1): ?>           
                           <a href="/comments/ads"><p style="color:blue">Комментарии к моим объявлениям</p></a> 
                              <p style="font-weight:bold">Срок действия бизнес-акаунта истекает 
                                    <?php echo  $comments["date_vip_off"] ?></p>
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
<div style="padding-top:180px"> <?php require_once 'public/blocks/footer.php' ?>
</div>