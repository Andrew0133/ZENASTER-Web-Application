<?php
    if (!isset($_SESSION))
    {
        session_start();
    }
    // se settata variabile sessione carrello
    if (isset($_SESSION['prodCart']))
    {
        require 'connect_db.php';
        // raccolta id prodotti nel carrello
        $auxToSlide = [];
        $auxToSlide = array_count_values($_SESSION['prodCart']);
        
        $sql = "SELECT * FROM prodotti WHERE";
        $sql .= " gid IN (";
        $stringOfTypes="";
        
        if (!$stmt = mysqli_stmt_init($conn))
        {
            header("Location: ../index.php?error=somethingIsWrong");
            exit();
        }

        // Preparazione della query per quanti prodotti sono stati inseriti
        for($i=0; $i < count($_SESSION['prodCart']); ++$i){
            $sql.= "?,";
            $stringOfTypes.="s";
        }

        $sql[strlen($sql)-1] = ")";

        if (!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: ../index.php?error=somethingIsWrong");
            exit();
        }

        if (!mysqli_stmt_bind_param($stmt, $stringOfTypes, ...$_SESSION['prodCart']))
        {
            header("Location: ../index.php?error=somethingIsWrong");
            exit();
        }

        if (!mysqli_stmt_execute($stmt))
        {
            header("Location: ../index.php?error=somethingIsWrong");
            exit();
        }

        if (!$result = mysqli_stmt_get_result($stmt)){
            header("Location: ../index.php?error=somethingIsWrong");
            exit(); 
        }
        // controllo risultato query
        if ($result){
            $query = mysqli_num_rows($result);
        }else{
            $query = 0;
        }
            if ($query > 0)
            {
                // display prodotti carrello dinamicamente
                    echo '
                <div class="row blockCart" id= "tableCart">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col"> </th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col" class="text-center">Quantity</th>
                                    <th scope="col" class="text-right">Total Price</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>';
                            $total = 0;
                            $shipping = 5;
                            while($row = mysqli_fetch_assoc($result))
                            {
                            echo'
                                <tr>
                                    <td><img src="'.$row['path_img'].'" width="50px" height="50px" /> </td>
                                    <td>'.$row['title'].'</td>
                                    <td>'.$row['prezzo'].'</td>
                                    <td class="text-center">'.htmlspecialchars($auxToSlide[$row['gid']]).'</td>
                                    <td class="text-right">'.htmlspecialchars($row['prezzo'] * $auxToSlide[$row['gid']]).' €</td>
                                    <td class="text-right"><button class="btn btn-sm btn-danger removeCart" id = "'.$row['gid'].'" value="'.$row['gid'].'"><i class="fa fa-trash"></i> </button> </td>
                                </tr>';
                                $total += $row['prezzo']*$auxToSlide[$row['gid']];
                            }
                            echo'<tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Sub-Total</td>
                                    <td class="text-right">'.htmlspecialchars($total).' €</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Shipping</td>
                                    <td class="text-right">'.$shipping.'€</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Total</strong></td>
                                    <td class="text-right"><strong>'.($total+$shipping).' €</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col mb-2">
                    <div class="row">
                        <div class="col-sm-12  col-md-6">
                            <a href="products.php" class="btn btn-block btn-light">Continue Shopping</a>
                        </div>
                        <div class="col-sm-12 col-md-6 text-right">
                            <a href="checkout.php" class="btn btn-lg btn-block btn-success text-uppercase">Checkout</a>
                        </div>
                    </div>
                </div>
            </div>';
            }else{
                echo'<h4 class="text-muted">Il tuo carrello è vuoto </h4> <br>
                <img src="photos/sad_robot.png" id="sadRobot">';
            }

            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
        else
        {
            echo'<h4 class="text-muted">Il tuo carrello è vuoto </h4> <br>
                <img src="photos/sad_robot.png" id="sadRobot">';
        }


?>