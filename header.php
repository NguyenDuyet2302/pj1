<div class="app">
    <header class="header">
        <div class="grid">
            <nav class="header_navbar">
                <ul class="header_navbar-list">
                    <li class="header_navbar-item header__navbar-item--has-qr header_navbar-item--separate">
                        Vào trang BOOKSHOP
                    </li>
                    <li class="header_navbar-item">
                        <span class="header__navbar-title--no-pointer">Kết nối</span>
                        <a class="header_navbar-icon-link" href="">
                            <i class="header__navbar-icon fa-brands fa-facebook"></i>
                        </a>

                        <a class="header_navbar-icon-link" href="">
                            <i class="header__navbar-icon fa-brands fa-instagram"></i>
                        </a>
                    </li>
                </ul>

                <ul class="header_navbar-list">
                    <li class="header_navbar-item">
                        <a href="" class="header_navbar-item-link">
                            <i class="header__navbar-icon fa-solid fa-bell"></i>
                            Thông báo
                        </a>
                    </li>
                    <li class="header_navbar-item">
                        <a href="" class="header_navbar-item-link">
                            <i class="header__navbar-icon fa-solid fa-question"></i>
                            Trợ giúp
                        </a>
                    </li>
                    <?php
                        if (isset($_SESSION['username'])) {
                    ?>
                    <li class="header_navbar-item header__navbar-user">
                        <span class="header__navbar-user-name"><?= $_SESSION['username'] ?></span>

                        <ul class="header__navbar-user-menu">
                            <li class="header__navbar-user-item">
                                <a href="layout_user.php?pageLayout=user_info">Tài khoản của tôi</a>
                            </li>
                            <li class="header__navbar-user-item">
                                <a href="layout_user.php?pageLayout=history">Đơn mua</a>
                            </li>
                            <li class="header__navbar-user-item">
                                <a href="logout.php">Đăng xuất</a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    } else {
                    ?>
                    <li class="header_navbar-item header_navbar-item--strong header_navbar-item--separate">
                        <a class="header_navbar-item-link" href="?pageLayout=register">Đăng ký</a>
                    </li>
                    <li class="header_navbar-item header_navbar-item--strong">
                        <a class="header_navbar-item-link" href="?pageLayout=login">Đăng nhập</a>
                    </li>
                    <?php
                    }
                    ?>
                </ul>
            </nav>

            <!-- Header with search -->
            <div class="header-with-search">
                <div class="header__logo">
                    <a href="layout_user.php" class="header__logo-link">
                        <img src="asset/img/logo.png" alt="Logo" class="header__logo-img">
                    </a>
                </div>

                <form action="layout_user.php" method="GET" class="header__search">
                    <input type="hidden" name="pageLayout" value="search">
                    <input type="text" name="keyword" class="header__search-input" placeholder="Nhập để tìm kiếm sản phẩm">
                    <button type="submit" class="header__search-btn">
                        <i class="header__search-btn-icon fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>

                <!-- Cart layout -->
                <div class="header__cart">
                    <a href="?pageLayout=cart" class="header_navbar-item-link">
                        <div class="header__cart-wrap">
                            <i class="header__cart-icon fa-solid fa-cart-shopping"></i>
    <!--                        <div class="header__cart-list header__cart-list--no-cart">-->
    <!--                            <img src="asset/img/no__cart.png" alt="" class="header__cart-no-cart-img">-->
    <!--                            <span class="header__cart-list-no-cart-msg">-->
    <!--                                Chưa có sản phẩm-->
    <!--                            </span>-->
    <!--                        </div>-->
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </header>
