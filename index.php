<?php
require __DIR__ . '/vendor/autoload.php';


$checkout = false;

if(!empty($_GET['checkout']) && $_GET['checkout'] == true) {

    $checkout = true;


    /*
     * Merchant model
     */
    $merchant = new stdClass();
    $merchant->confirm_on_checkout = true;
    $merchant->confirmation_url = "https://www.northdeco.com/aplazame_callback.php"; // url that the JS client sent to confirming the order.
    $merchant->cancel_url = "https://www.northdeco.com";        // url that the customer is sent to if there is an error in the checkout.
    $merchant->success_url = "https://www.northdeco.com";      // url that the customer is sent to after confirming their order.
    $merchant->checkout_url = "https://www.northdeco.com";    // url that the customer is sent to if the customer chooses to back to the e-commerce, by default is /.

    //must be unique
$id = 111111 . (strtotime(date('Y-m-d h:i:s')));

    /*
     * Article model
     */
    $article = new stdClass();
    $article->id = $id;                                  // The article ID.
    $article->name = "Reloj en oro blanco de 18 quilates y diamantes";      // Article name.
    $article->url = "http://shop.example.com/product.html";                 // Article url.
    $article->quantity = 2;                                                 // Article quantity.
    $article->price = Aplazame\Serializer\Decimal::fromFloat(4020.00);      // Article price (tax is not included). (4,020.00 €)
    $article->description = "Movimiento de cuarzo de alta precisión";       // Article description.
    $article->tax_rate = Aplazame\Serializer\Decimal::fromFloat(21.00);     // Article tax rate. (21.00%)

// ... rest of articles in the shopping cart.

    /*
     * Articles collection
     */
    $articles = array($article);


    /*
     * Order model
     */
    $order = new stdClass();
    $order->id = $id;                                       // Your order ID.
    $order->currency = "EUR";                                                  // Currency code of the order.
    $order->tax_rate = Aplazame\Serializer\Decimal::fromFloat(21.00);          // Order tax rate. (21.00%)
    $order->total_amount = Aplazame\Serializer\Decimal::fromFloat(4620.00);    // Order total amount. (4,620.00 €)
    $order->articles = $articles;                                              // Articles in cart.

    /*
     * Customer address model
     */
    $customerAddress = new stdClass();
    $customerAddress->first_name = "John";                              // Address first name.
    $customerAddress->last_name = "Coltrane";                           // Address last name.
    $customerAddress->street = "Plaza del Angel nº10";                  // Address street.
    $customerAddress->city = "Madrid";                                  // Address city.
    $customerAddress->state = "Madrid";                                 // Address state.
    $customerAddress->country = "ES";                                   // Address country code.
    $customerAddress->postcode = "28012";                               // Address postcode.
    $customerAddress->phone = "616123456";                              // Address phone number.
    $customerAddress->alt_phone = "+34917909930";                       // Address alternative phone.
    $customerAddress->address_addition = "Cerca de la plaza Santa Ana"; // Address addition.

    /*
     * Customer model
     */
    $customer = new stdClass();
    $customer->id = "1618";                                                                               // Customer ID.
    $customer->email = "rafael@latevaweb.com";                                                                // The customer email.
    $customer->type = 'e';                                                                                // Customer type, the choices are g:guest, n:new, e:existing.
    $customer->gender = 0;                                                                                // Customer gender, the choices are 0: not known, 1: male, 2:female, 3: not applicable.
    $customer->first_name = "John";                                                                       // Customer first name.
    $customer->last_name = "Coltrane";                                                                    // Customer last name.
    $customer->birthday = Aplazame\Serializer\Date::fromDateTime(new DateTime("1990-08-21 13:56:45"));    // Customer birthday.
    $customer->language = "es";                                                                           // Customer language preferences.
    $customer->date_joined = Aplazame\Serializer\Date::fromDateTime(new DateTime("2014-08-21 13:56:45")); // A datetime designating when the customer account was created.
    $customer->last_login = Aplazame\Serializer\Date::fromDateTime(new DateTime("2014-08-27 19:57:56"));  // A datetime of the customer last login.
    $customer->address = $customerAddress;                                                                // Customer address.


    /*
     * Billing address model
     */
    $billingAddress = new stdClass();
    $billingAddress->first_name = "Bill";                        // Billing first name.
    $billingAddress->last_name = "Evans";                        // Billing last name.
    $billingAddress->street = "Calle de Las Huertas 22";         // Billing street.
    $billingAddress->city = "Madrid";                            // Billing city.
    $billingAddress->state = "Madrid";                           // Billing state.
    $billingAddress->country = "ES";                             // Billing country code.
    $billingAddress->postcode = "28014";                         // Billing postcode.
    $billingAddress->phone = "+34914298407";                     // Billing phone number.
    $billingAddress->alt_phone = null;                           // Billing alternative phone.
    $billingAddress->address_addition = "Cerca de la pizzería"; // Billing address addition.


    /*
     * Shipping info model
     */
    $shippingInfo = new stdClass();
    $shippingInfo->first_name = "Django";                                        // Shipping first name.
    $shippingInfo->last_name = "Reinhard";                                       // Shipping last name.
    $shippingInfo->street = "Plaza del Angel nº10";                              // Shipping street.
    $shippingInfo->city = "Madrid";                                              // Shipping city.
    $shippingInfo->state = "Madrid";                                             // Shipping state.
    $shippingInfo->country = "ES";                                               // Shipping country code.
    $shippingInfo->postcode = "28012";                                           // Shipping postcode.
    $shippingInfo->name = "Planet Express";                                      // Shipping name.
    $shippingInfo->price = Aplazame\Serializer\Decimal::fromFloat(5.00);         // Shipping price (tax is not included). (5.00 €)
    $shippingInfo->phone = "616123456";                                          // Shipping phone number.
    $shippingInfo->alt_phone = "+34917909930";                                   // Shipping alternative phone.
    $shippingInfo->address_addition = "Cerca de la plaza Santa Ana";             // Shipping address addition.
    $shippingInfo->tax_rate = Aplazame\Serializer\Decimal::fromFloat(21.00);     // Shipping tax rate. (21.00%)


    /*
     * Checkout model
     */
    $checkout = new stdClass();
    $checkout->toc = true;
    $checkout->merchant = $merchant;
    $checkout->order = $order;
    $checkout->customer = $customer;
    $checkout->billing = $billingAddress;
    $checkout->shipping = $shippingInfo;

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Checkout example for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.1/examples/checkout/form-validation.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container">
    <div class="py-5 text-center">
        <h2>Checkout form</h2>
        <p class="lead">Below is an example form built entirely with Bootstrap's form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
    </div>

    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
                <span class="badge badge-secondary badge-pill">3</span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Product name</h6>
                        <small class="text-muted">Brief description</small>
                    </div>
                    <span class="text-muted">$12</span>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Second product</h6>
                        <small class="text-muted">Brief description</small>
                    </div>
                    <span class="text-muted">$8</span>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Third item</h6>
                        <small class="text-muted">Brief description</small>
                    </div>
                    <span class="text-muted">$5</span>
                </li>
                <li class="list-group-item d-flex justify-content-between bg-light">
                    <div class="text-success">
                        <h6 class="my-0">Promo code</h6>
                        <small>EXAMPLECODE</small>
                    </div>
                    <span class="text-success">-$5</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (USD)</span>
                    <strong>$20</strong>
                </li>
            </ul>

            <form class="card p-2">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Promo code">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary">Redeem</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Billing address</h4>

            <div data-aplazame-simulator
                 data-amount="2900"
                 data-currency="EUR"
                 data-country="ES"
                 data-view="product"></div>

            <a href="index.php?checkout=true" class="btn btn-primary">CHECKOUT</a>

            <div data-aplazame-payment-info="">
                Información acerca del pago con Aplazame que aparecerá y se ocultará con el botón
            </div>

        </div>
    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2017-2018 Company Name</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Privacy</a></li>
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
    </footer>
</div>


<script src="https://aplazame.com/static/aplazame.js"
        data-aplazame=""
        data-sandbox="true"></script>




<?php if($checkout): ?>
<script> aplazame.checkout( <?php echo json_encode(Aplazame\Serializer\JsonSerializer::serializeValue($checkout)); ?> );</script>
<?php endif; ?>


</body>
</html>
