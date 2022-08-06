<?php
session_start();
if ($_SESSION["role"] != 10):?>
<?php header("Location: /"); ?>
<?php else: ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Новые объявления</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="/public/admin/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="/public/admin/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
        <a href="/user/logout">Выход</a>
  </nav>
   <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
       <nav class="mt-2">
		  <h4 style="text-align:center;color:white">Административная панель управления</h4>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" style="padding-top:100px;text-align:center">
          <li class="nav-item">
              <a href="/user/admin"><p>
              Права пользователей
              </p><br></a>
              <a href="/ads/new"><p>
              Новые объявления
              </p><br></a>
                <a href="/comments/new"><p>
              Новые комментарии
              </p><br></a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Новые объявления от пользователей</h1>
          </div>
        </div>
      </div>
    </section>
      <?php if (!empty($data)): ?>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <?php foreach ($data as $ad):?>
            <div class="col-md-8">  
            <div class="card card-widget">      
              <div class="card-footer card-comments">      
                  <div class="comment-text">
                    <span class="username">
                   № <?php echo $ad["id"]?>  <?php echo $ad["name"]?>
                    <span class="text-muted float-right"><?php echo $ad["data"]?></span>
						
                    </span>
					  <span style="color:black"><?php echo $ad["text"]?></span><br><br><span style="color:blue"><?php echo $ad["login"]?></span><br><br>
                  </div>
					<a href="/user/delete/<?php echo $ad["id"]?>"><button style="margin-left:30px">Удалить</button></a>  
				  <div>
            <form method="post" action="/ads/main/<?php echo $ad["id"]?>">
			    <span style="padding-left:5px">
            <input type="checkbox" name="highlight"><span style="padding-left:10px">Выделить цветом</span>
            <input type="number" name="qty_main" placeholder="Кол-во" id="user" pattern="[0-9]" min="3">
              </span>
			<style>
			#user{                             
			 width: 100px;
			}             
			</style> 
			 <button type="submit" class="button button-contactForm btn_1 boxed-btn">Опубликовать на главную</button>	      
          </form>
		</div><br> 	  
            <form method="post" action="/ads/moderation/<?php echo $ad["id"]?>">
             <span style="padding-left:5px">
            <input type="checkbox" name="highlight"><span style="padding-left:10px">Выделить цветом</span>
            <input type="number" name="qty" placeholder="Кол-во" id="user" pattern="[0-9]" min="3">
              </span>
			<style>
			#user{                             
			 width: 100px;
			}             
			</style> 
        <button type="submit" class="button button-contactForm btn_1 boxed-btn">Опубликовать</button>	         
          </form>
		<br>   
              </div>             
            </div>      
          </div> 
           <?php endforeach ?> 
        </div>
      </div>
    </section>
      <?php else: ?>
      <p style="color:green;padding-left:20px">Новых сообщений нет</p>
      <?php endif?>
    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a>
  </div>
  <footer class="main-footer">
  </footer>
</div>
<script src="/public/admin/plugins/jquery/jquery.min.js"></script>
<script src="/public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/public/admin/dist/js/adminlte.min.js"></script>
</body>
</html>
<?php endif ?>