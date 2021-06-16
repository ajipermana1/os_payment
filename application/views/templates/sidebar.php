  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <?php if ($this->session->userdata('role_id' === 1)) : ?>
          <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin') ?>">
          <?php else : ?>
              <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('user') ?>">
              <?php endif; ?>
              <div class="sidebar-brand-icon rotate-n-15">
                  <i class="fas fa-money-check-alt"></i>
              </div>
              <div class="sidebar-brand-text mx-3">One School Payment</div>
              </a>

              <!-- Divider -->
              <hr class="sidebar-divider my-0">
              <!-- QUERY MENU -->
              <?php
                $role_id = $this->session->userdata['role_id'];
                $queryMenu = " SELECT user_menu . id , menu
                        FROM user_menu JOIN user_acces_menu 
                        ON user_menu . id = user_acces_menu . menu_id
                        WHERE user_acces_menu . role_id = $role_id
                        ORDER BY user_acces_menu. menu_id ASC
                        ";
                $menu = $this->db->query($queryMenu)->result_array();

                ?>


              <!-- Looping Menu -->
              <?php foreach ($menu as $m) : ?>


                  <div class="sidebar-heading">
                      <?= $m['menu']; ?>
                  </div>
                  <?php
                    $menuId = $m['id'];
                    $querySubMenu = "SELECT *
            FROM user_sub_menu JOIN user_menu 
            ON user_sub_menu . menu_id = user_menu . id
            WHERE user_sub_menu . menu_id = $menuId
            AND user_sub_menu . is_active = '1'
            ";
                    $subMenu = $this->db->query($querySubMenu)->result_array();
                    ?>
                  <?php foreach ($subMenu as $sm) : ?>
                      <?php if ($title == $sm['title']) : ?>
                          <li class="nav-item active">
                          <?php else : ?>
                          <li class="nav-item">

                          <?php endif; ?>
                          <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                              <i class="<?= $sm['icon']; ?>"></i>
                              <span><?= $sm['title']; ?></span></a>
                          </li>

                      <?php endforeach; ?>

                      <hr class="sidebar-divider mt-3">

                  <?php endforeach; ?>

                  <!-- Nav Item - Dashboard -->




                  <!-- Heading -->


                  <!-- Nav Item - Pages Collapse Menu -->


                  <!-- Nav Item - Utilities Collapse Menu -->


                  <!-- Divider -->
                  <li class="nav-item">
                      <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                          <span>Logout</span></a>
                  </li>



                  <!-- Divider -->
                  <hr class="sidebar-divider d-none d-md-block">

                  <!-- Sidebar Toggler (Sidebar) -->
                  <div class="text-center d-none d-md-inline">
                      <button class="rounded-circle border-0" id="sidebarToggle"></button>
                  </div>

  </ul>
  <!-- End of Sidebar -->