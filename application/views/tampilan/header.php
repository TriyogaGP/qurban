<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?=base_url('assets/')?>images/DP.png" type="image/ico" />

    <title><?=constant('TITLE')?></title>

    <?php $this->load->view('tampilan/css'); ?>
    
  </head>

  <body class="nav-md">
  <?php if($this->session->flashdata('success')){ ?>
    <div class="flash-data" data-dataflash="<?= $this->session->flashdata('success');?>" data-validasi="success"></div>
  <?php }else if($this->session->flashdata('error')){ ?>
    <div class="flash-data" data-dataflash="<?= $this->session->flashdata('error');?>" data-validasi="error"></div>
  <?php }else if($this->session->flashdata('info')){ ?>
    <div class="flash-data" data-dataflash="<?= $this->session->flashdata('info');?>" data-validasi="info"></div>    
  <?php } ?>
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?=base_url('dashboard')?>" class="site_title"><i style="font-size: 12px;">Q.com</i> <span style="font-size: 22px;"><?=constant('TITLE')?></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?=base_url('assets/production/')?>images/user.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Selamat Datang,</span>
                <h2><?=ucwords($this->session->userdata('ses_nama'));?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="<?=base_url('dashboard')?>"><i class="fa fa-home"></i> Dashboard</a></li>
                  <?php if($this->session->userdata('ses_level') != 3){ ?>
                    <li><a href="<?=base_url('admin')?>"><i class="fa fa-desktop"></i> Administrator & Reseller</a></li>
                  <?php } ?>
                  <li><a href="<?=base_url('compro')?>"><i class="fa fa-desktop"></i> Catalog Hewan Qurban</a></li>
                  <li><a><i class="fa fa-shopping-cart"></i> Purchase Order <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?=base_url('keranjang')?>"><i class="fa fa-shopping-cart"></i> Keranjang<?php if($this->session->userdata('ses_level') == 3){ ?> <span class="label label-success pull-right" data-toggle="tooltip" data-placement="right" title="Total keranjang anda"><div class="totalKeranjang"></div></span><?php } ?></a></li>
                      <li><a href="<?=base_url('historykeranjang')?>"><i class="fa fa-history"></i> History Keranjang</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-users"></i> Customers <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?=base_url('customer/0')?>"><i class="fa fa-user"></i> Customer<?php if($this->session->userdata('ses_level') == 3){ ?> <span class="label label-success pull-right" data-toggle="tooltip" data-placement="right" title="Total customer anda"><div class="totalCustomer"></div></span><?php } ?></a></li>
                      <li><a href="<?=base_url('historycustomer')?>"><i class="fa fa-history"></i> History Customer</a></li>
                    </ul>
                  </li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?=base_url('logout')?>">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?=base_url('assets/production/')?>images/user.png" alt=""><?=ucwords($this->session->userdata('ses_nama'));?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <!-- <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li> -->
                    <li><a href="<?=base_url('logout')?>"><i class="fa fa-sign-out pull-right"></i> Keluar</a></li>
                  </ul>
                </li>

                <?php if($this->session->userdata('ses_level') != 3){ ?>
                  <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-bell"></i>
                      <span class="badge bg-green total"></span>
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list notifikasi" role="menu"></ul>
                  </li>
                <?php }elseif($this->session->userdata('ses_level') == 3){ ?>
                  <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-bell"></i>
                      <span class="badge bg-green totall"></span>
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list notifikasis" role="menu"></ul>
                  </li>
                <?php } ?>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->