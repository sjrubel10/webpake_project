<!-- Remove the container if you want to extend the Footer to full width. -->
<?php

$data=[];
$val=(int)14;
$serverName="localhost";
$userName="root";
$passWord="";
$db="test";
$mysqli=new mysqli($serverName,$userName,$passWord,$db);
if($mysqli->connect_error){
    echo "No connection establishment ".$mysqli->connect_error;
    exit();
}
$query="SELECT `item_code`,`value`,`quantity` FROM item WHERE `value`=?";
$statement =$mysqli -> prepare($query);
$statement->bind_param("i",$val);
$statement->execute();
$statement->bind_result($item_code,$value,$quantity);
$statement->store_result();
while ($statement->fetch()){
    $data[]= array(
        'item_code'=>$item_code,
        'value'=>$value,
        'quantity'=>$quantity
    );
}
$statement -> close();
$mysqli -> close();

var_dump($data);
?>

<div class="container my-5">

    <footer class=" text-left text-dark">
        <!-- Grid container -->
        <div class="container p-4">
            <!--Grid row-->
            <div class="row mt-4">
                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-purple">Kabbo</h5>

                    <ul class="list-unstyled mb-0">
                        <h6 class="btn-text-size">language EN(UK)</h6>
                        <p class="btn-text-size "><a class="text-dark" href="#">CAREER</a> <a class="text-dark" href="#">CONTACT</a> <a class="text-dark" href="#">PRIVACY</a></p>
                        <i class="button-bg-color-parple margin-right fa-2x rounded-circle fa-brands fa-facebook"></i>
                        <i class="button-bg fa-brands fa-twitter"></i>
                    </ul>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h6 class="btn-text-size font-weight-bold">Information</h6>

                    <ul class="list-unstyled">
                        <p class="btn-text-size font-color-gray">113 momo street, BD 721</br>NY 20012</p>
                        <p class="btn-text-size font-color-gray">kabbohelp@gmail.com</p>
                        <p class="btn-text-size text-purple">+88 (0) 29292162</p>
                    </ul>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h6 class="btn-text-size font-color-gray font-weight-bold">About Company</h6>
                    <ul class="list-unstyled btn-text-size">
                        <p><a href="#!" class="font-color-gray">How it works</a></p>
                        <p><a href="#!" class="font-color-gray">Development</a></p>
                        <p><a href="#!" class="font-color-gray">Digital marketing</a></p>
                        <p><a href="#!" class="font-color-gray">Service</a></p>
                        <p><a href="#!" class="font-color-gray">Security</a></p>
                    </ul>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h6 class="btn-text-size font-weight-bold">Stay In Loop</h6>
                    <ul class="list-unstyled">
                        <p class="btn-text-size font-color-gray">Subscribe to receive biweekly tips on creative automationa and digital advertising</p>
                    </ul>
                </div>
                <!--Grid column-->
            </div>
            <!--Grid row-->
        </div>

    </footer>

</div>
<!-- End of .container -->