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
  <title>Административная панель</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="/public/admin/plugins/fontawesome-free/css/all.min.css">
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
    <ul class="navbar-nav ml-auto">
    </ul>
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
            <h1>Права пользователей</h1>
          </div>     
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        </div>
        <div class="row">
          <div class="col-12">
            <div>
              <div class="card-header">             
              <!--  <div class="card-tools">
					<div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>-->
              </div>
              <div style="height: 300px;">
                <table class="table">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>Логин</th>
                      <th>Бан</th>
                      <th>Бизнес-аккаунт</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach($data as $user): ?>
                     <tr>
                      <td><?php echo $user["id"]?></td>
                      <td><?php echo $user["login"]?></td>
					  <?php if ($user["ban"] == 0) : ?>
					  <td><a href="/user/ban/<?php echo $user["id"]?>"><button style="background-color:green">Забанить</button></a></td>
                     <?php else: ?>
				     <td><a href="/user/unban/<?php echo $user["id"]?>"><button style="background-color:red">Разблокировать</button></a></td>
                      <?php endif ?>
                         
                       <?php if ($user["vip"] == 0) : ?>
					  <td><a href="/user/on/<?php echo $user["id"]?>"><button style="background-color:green">Включить</button></a></td>
                     <?php else: ?>
				     <td><a href="/user/off/<?php echo $user["id"]?>"><button style="background-color:red">Выключить</button></a></td>    
                     <?php endif ?>
                         
                    </tr>
                    <?php endforeach ?>   
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <footer class="main-footer">
  </footer>
  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>
<script src="/public/admin/plugins/jquery/jquery.min.js"></script>
<script src="/public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/public/admin/dist/js/adminlte.min.js"></script>
</body>
</html>
<?php endif ?>