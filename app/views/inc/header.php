 <?php 
    $init = new Core();
    // echo '<pre>';
    $controller = isset($init->getUrl()[0]) ? $init->getUrl()[0] : 'home';
    $method = isset($init->getUrl()[1]) ? $init->getUrl()[1] : '';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?php echo SITENAME; ?></title>
        <!-- Custom fonts for this template-->
        <link href="<?php echo URLROOT; ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <!-- Custom styles for this template-->
        <link href="<?php echo URLROOT; ?>/css/sb-admin-2.css" rel="stylesheet">
        <!-- Custom styles for this page -->
        <link href="<?php echo URLROOT; ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
        <style type="text/css">
            .nav-caixa .nav-tabs .nav-link{
                color: #6e707e !important;
            }

            .tab-content .tab-pane h6{
                font-size: 0.9rem !important;
            }

            .nav-caixa .nav-tabs .nav-link.active{
                color: #6e707e !important;
                background-color: #fff !important;
                border: none !important;
                border-bottom: 2.5px solid #15bf82 !important;

            }

            #table-pro thead tr th, #table-pro tfoot tr th{
                padding: .5rem !important;
                font-size: 0.9rem !important;
            }

            #table-pro tbody tr td{
                padding: .5rem !important;
                font-size: 0.9rem !important;
            }

            

           /* .kkk{
                background: rgb(60,54,54) !important;
background: linear-gradient(90deg, rgba(60,54,54,1) 0%, rgba(117,47,47,1) 1%, rgba(192,37,37,1) 37%, rgba(202,36,36,1) 54%, rgba(206,36,36,1) 69%, rgba(211,35,35,1) 100%, rgba(253,29,29,1) 100%) !important;
            }*/
        </style>
    </head>
    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion kkk" id="accordionSidebar">
                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo URLROOT; ?>">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-hamburger"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">Assakabrasa</div>
                </a>
                <!-- Divider -->
                <hr class="sidebar-divider my-0">
                <!-- Nav Item - Dashboard -->
                <li class="nav-item <?php echo $controller == 'home' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Início</span></a>
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider">
                <!-- Heading -->
                <div class="sidebar-heading">
                    Principal
                </div>
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item <?php echo $controller == 'mesas' ? 'active' : '' ?>">
                    <a class="nav-link <?php echo $controller == 'mesas' ? '' : 'collapsed' ?>" href="#" data-toggle="collapse" data-target="#mesas" aria-expanded="true" aria-controls="mesas">
	                    <i class="fas fa-object-group"></i>
	                    <span>Mesas</span>
                    </a>
                    <div id="mesas" class="collapse <?php echo $controller == 'mesas' ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item <?php echo $controller == 'mesas' && $method == 'salao' ? 'active' : '' ?>" href="<?php echo URLROOT; ?>/mesas/salao">Mostrar Salão</a>   
                            <?php if ($_SESSION['nivel'] == 1): ?>
                            <a class="collapse-item <?php echo $controller == 'mesas' && $method == 'gerenciar' ? 'active' : '' ?>" href="<?php echo URLROOT; ?>/mesas/gerenciar">Gerenciar</a>   
                            <?php endif ?>
                            <!-- <a class="collapse-item" href="<?php echo URLROOT; ?>/mesas/comandas">Comandas</a>  -->         
                        </div>
                    </div>
                </li>
                <?php if ($_SESSION['nivel'] == 1): ?>
                <li class="nav-item <?php echo $controller == 'produtos' ? 'active' : '' ?> d-none d-sm-block">
                    <a class="nav-link <?php echo $controller == 'produtos' ? '' : 'collapsed' ?>" href="#" data-toggle="collapse" data-target="#produtos" aria-expanded="true" aria-controls="produtos">
	                    <i class="fas fa-cubes"></i>
	                    <span>Produtos</span>
                    </a>
                    <div id="produtos" class="collapse <?php echo $controller == 'produtos' ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item <?php echo $controller == 'produtos' && $method == 'gerenciar' ? 'active' : '' ?>" href="<?php echo URLROOT; ?>/produtos/gerenciar/">Gerenciar</a>
                            <a class="collapse-item <?php echo $controller == 'produtos' && $method == 'categorias' ? 'active' : '' ?>" href="<?php echo URLROOT; ?>/produtos/categorias/">Categorias</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item <?php echo $controller == 'caixas' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?php echo URLROOT; ?>/caixas/">
                    	<i class="fab fa-buffer"></i>
                    	<span>Caixa</span>
                    </a>
                </li>
                <?php endif ?>
                <!-- Divider -->
                <hr class="sidebar-divider">
                <!-- Heading -->
                <!-- <div class="sidebar-heading">
                    Configs
                </div> -->
                <?php if ($_SESSION['nivel'] == 1): ?>
                    <li class="nav-item <?php echo $controller == 'users' ? 'active' : '' ?> d-none d-sm-block">
                        <a class="nav-link" href="<?php echo URLROOT; ?>/users/">
                        <i class="fas fa-users"></i>
                        <span>Usuários</span></a>
                    </li>
                    <li class="nav-item <?php echo $controller == 'configuracoes' ? 'active' : '' ?> ">
                        <a class="nav-link" href="<?php echo URLROOT; ?>/configuracoes">
                        	<i class="fas fa-cogs"></i>
                        <span>Configurações</span></a>
                    </li>
                <?php endif ?>
                <li class="nav-item">
                    <?php if (isset($_SESSION['id_caixa'])): ?>
                        <a class="nav-link" href="#logoutModal" data-toggle="modal">
                            <i class="fas fa-sign-out-alt"></i>
                        <span>Sair</span></a>
                    <?php else: ?>
                        <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout">
                        	<i class="fas fa-sign-out-alt"></i>
                        <span>Sair</span></a>
                    <?php endif; ?>
                </li>
                
            </ul>
            <!-- End of Sidebar -->
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                        </button>
                        
                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- <li class="nav-item dropdown no-arrow d-sm-none">
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto w-100 navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li> -->

                           <!--  <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bell fa-fw"></i>
                                    <span class="badge badge-danger badge-counter">3+</span>
                                </a>
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                    <h6 class="dropdown-header">
                                        Alerts Center
                                    </h6>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-primary">
                                                <i class="fas fa-file-alt text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">December 12, 2019</div>
                                            <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-success">
                                                <i class="fas fa-donate text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">December 7, 2019</div>
                                            $290.29 has been deposited into your account!
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-warning">
                                                <i class="fas fa-exclamation-triangle text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">December 2, 2019</div>
                                            Spending Alert: We've noticed unusually high spending for your account.
                                        </div>
                                    </a>
                                    <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-envelope fa-fw"></i>
                                    <span class="badge badge-danger badge-counter">7</span>
                                </a>
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                    <h6 class="dropdown-header">
                                        Message Center
                                    </h6>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                                            <div class="status-indicator bg-success"></div>
                                        </div>
                                        <div class="font-weight-bold">
                                            <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                                            <div class="small text-gray-500">Emily Fowler · 58m</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                                            <div class="status-indicator"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                                            <div class="small text-gray-500">Jae Chun · 1d</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                                            <div class="status-indicator bg-warning"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                                            <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                                            <div class="status-indicator bg-success"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                                            <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                                </div>
                            </li> -->
                            <div class="topbar-divider d-none d-sm-block"></div>
                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['nome'] ?></span>
                                    <img class="img-profile rounded-circle" src="<?php echo URLROOT."/img/users/".$_SESSION['img'] ?>">

                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                    </a>
                                    <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                    </a>
                                    <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                    </a>
                                    <div class="dropdown-divider"></div> -->
                                    <a class="dropdown-item" href="<?php echo URLROOT; ?>/users/perfil/">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Editar Perfil
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <?php if (isset($_SESSION['id_caixa'])): ?>
                                        <a class="dropdown-item" href="#logoutModal" data-toggle="modal">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Sair
                                        </a>
                                    <?php else: ?>
                                        <a class="dropdown-item" href="<?php echo URLROOT; ?>/users/logout">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Sair
                                        </a>
                                    <?php endif; ?>
                                    
                                    <!-- data-target="#logoutModal" -->
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <div class="container-fluid px-4 fadeIn">
  
