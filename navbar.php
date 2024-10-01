<!-- NAVBAR -->
<div class="navbar">
    <nav>
        <div class="container">
            <div class="nav-wrapper">
			<a href="index.php" class="brand-logo center"><img src="img/puuu.png" class="logo"></a>
                <a href="#" data-target="mobile-nav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul id="nav-mobile" class="left hide-on-med-and-down">
                    <li>
                        <a href="keranjang.php">Keranjang</a>
                    </li>
                    <li>
                        <a href="riwayat.php">Riwayat Belanja</a>
                    </li>
                </ul>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li>
                        <a href="checkout.php">Checkout</a>
                    </li>
                    <!-- Jika sudah login ada session pelanggan-->
                    <?php if (isset($_SESSION['pelanggan'])): ?>
                        <li>
                            <a href="logout.php" tabindex="-1" aria-disabled="true">Logout</a>
                        </li>
                        <li>
                            <span style="margin-left: 15px; display: flex; align-items: center;">
                                <i class="material-icons">account_circle</i>
                                <?php echo $_SESSION['pelanggan']['nama_pelanggan']; ?>
                            </span>
                        </li>
                    <!-- Selain itu (belom login || belom ada session pelanggan) -->
                    <?php else: ?>
                        <li>
                            <a href="login.php" tabindex="-1" aria-disabled="true">Login</a>
                        </li>
                        <li>
                            <a href="daftar.php">Register</a>
                        </li>    
                    <?php endif; ?>
                </ul>
            </div>        
        </div>
    </nav>
</div>
<!-- Sidenav -->
<ul class="sidenav" id="mobile-nav">
    <li>
        <a href="keranjang.php">Keranjang</a>
    </li>
    <li>
        <a href="riwayat.php">Riwayat Belanja</a>
    </li>
    <li>
        <a href="checkout.php">Checkout</a>
    </li>
    <li>
        <a href="daftar.php">Register</a>
    </li>   
    <!-- Jika sudah login ada session pelanggan-->
    <?php if (isset($_SESSION['pelanggan'])): ?>
        <li class="nav-item">
            <a href="logout.php" tabindex="-1" aria-disabled="true">Logout</a>
        </li>
        <li class="nav-item">
            <span style="margin-left: 15px; display: flex; align-items: center;">
                <i class="material-icons">account_circle</i>
                <?php echo $_SESSION['pelanggan']['nama_pelanggan']; ?>
            </span>
        </li>
    <!-- Selain itu (belom login || belom ada session pelanggan) -->
    <?php else: ?>
        <li class="nav-item">
            <a href="login.php" tabindex="-1" aria-disabled="true">Login</a>
        </li>    
    <?php endif; ?>
</ul>
