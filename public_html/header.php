<header>
    <div class="header">
    <div class="content">
        <nav class="customNav navbar navbar-expand-lg navbar-light bg-light">
            <a class="customTextNav navbar-brand" href="index.php">ZENASTER</a>
            <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav customMenuBar">
                    <li class="nav-item active">
                        <a class="nav-link " href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="products.php">Games, Film e Merchandising</a>
                    </li>
                </ul>
                <ul class="navbar-nav mx-auto">
                    <li id = "navItemSearch">
                        <form action = "products.php" method ="post" class="form-inline">
                            <input class="form-control searchForm mr-sm-2 searchCustom " type="search" placeholder="Search" name="search" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0 searchBtn " type="submit" name="searchbar-submit">Search </button>
                        </form>
                    </li>
                </ul>
                <?php
                    // se admin allora mostra area "admin"
                    if (isset($_SESSION['admin']))
                    {
                        echo '<ul class="navbar-nav customMenuBar">
                            <li class="nav-item active">
                                <a class="nav-link " href="admin/adm_index.php">Admin </a>
                            </li>
                        </ul>';
                    }
                ?>

                <ul class="navbar-nav ml-auto">
                    <?php 
                        // conteggio prodotti carrello(se ci sono)
                        if (isset ($_SESSION['prodCart']) && count($_SESSION['prodCart']) != 0 && !isset($inCart)){
                            $auxToCount = 0;
                            foreach(array_count_values($_SESSION['prodCart']) as $key => $value)
                            {
                                $auxToCount += $value;
                            }
                            echo'<li id = "cart" class="nav-item">
                            <a class="nav-link" href="cart.php">Carrello <i class="fas fa-shopping-cart"></i><span id="numOfProd" class="badge">'.$auxToCount.'</span></a>
                            </li>';
                        }else{
                            echo '<li id = "cart" class="nav-item">
                            <a class="nav-link " href="cart.php">Carrello <i class="fas fa-shopping-cart"></i></a>
                            </li>';
                        }
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle"></i>
                        </a>
                        <div id="navbarDropdown"class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <?php
                                // se loggato mostra "profilo e logout", "login e sign-in" altrimenti
                                if (isset($_SESSION['userId']))
                                {
                                    echo '
                                    <a class="dropdown-item " href="show_profile.php">My Profile<i class="fas fa-address-card"></i></a>
                                    <a class="dropdown-item " href="utils/logout.php">Logout <i class="fas fa-sign-out-alt"></i></a> ';
                                }
                                else
                                {
                                    echo '
                                    <a class="dropdown-item " href="login_form.php">Login <i class="fas fa-sign-out-alt"></i></a>
                                    <a class="dropdown-item " href="registration_form.php">Sign-in <i class="fas fa-sign-out-alt"></i></a> ';
                                }
                            ?>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div></div>
</header>