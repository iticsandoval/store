<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Conekta Oxxo</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!-- styles itic -->
    <link rel="stylesheet" href="{{asset("/css/app.css")}}">


    <style>
        body
        {
            background-image: url({{ asset("/img/backgroung.png") }}) !important;
            background-size: cover !important;

        }
    </style>

</head>
<body>

<div class="container offset-md-2 col-md-8">
    <header class="main-header">
        <h4>
            <span class="icon-title">
                <i class="fas fa-cart-plus"></i>
            </span>
            Pago con Conekta | OXXO PAY
        </h4>
    </header>

    <br>

    <div id="loading" class="text-center d-none" style="position: absolute; z-index: 3; margin-top: 25vh; margin-left: 60vh;">
        <div class="spinner-border"></div>
    </div>

    <div class="row">
        <div class="card" style="width: 18rem; margin-right: 1%;">
            <img class="card-img-top" src="{{ asset("/img/iphone12.jpg") }}" style="height: 320px" >
            <div class="card-body">
                <h4 id="product_name">IPhone 12 Pro Max</h4>
                <h6 class="card-title">
                    $<span id="product_price"> 888.88 </span>
                    <span id="product_currency">MXN</span>
                    -
                    Piezas:
                    <span id="product_qty">1</span>
                </h6>
                <p class="card-text">Some quick example text to build on the card title and make up.</p>
            </div>
        </div>

        <div class="card" style="width: 22rem;">
            <div class="card-body">
                <ol class="text-justify text-secondary" style="font-size: .9rem">
                    <li class="pt-2">Haz click en el botón verde de "Generar Orden".</li>
                    <li class="pt-2">El sistema te generará un número de referencia.</li>
                    <li class="pt-2">Ve al OXXO que gustes y dale el número de referencia al cajero de forma verbal (como recargar saldo en tu cel) y realiza el pago en efectivo. (OXXO te cobrará una comisión al momento, aproximadamente $10 MXN.). NOTA: El cajero de OXXO debe ingresar la referencia en su pantalla inicial, como si fuera el código de cualquier artículo que venda OXXO, no tiene que buscar ningún servicio en su sistema.</li>
                    <li class="pt-2">Listo!</li>
                </ol>

                <a onclick="checkout()" class="btn btn-danger float-right text-white">Generar <strong>Orden</strong></a>

            </div>
        </div>
    </div>

</div>


<!-- modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="stub">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Talón de Pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <style>
                    /* Reset -------------------------------------------------------------------- */
                    *    { margin: 0;padding: 0; }
                    body { font-size: 14px; }

                    /* OPPS --------------------------------------------------------------------- */

                    h3 {
                        margin-bottom: 10px;
                        font-size: 15px;
                        font-weight: 600;
                        text-transform: uppercase;
                    }

                    .opps {
                        width: 496px;
                        border-radius: 4px;
                        box-sizing: border-box;
                        padding: 0 45px;
                        margin: 40px auto;
                        overflow: hidden;
                        border: 1px solid #b0afb5;
                        font-family: 'Open Sans', sans-serif;
                        color: #4f5365;
                    }

                    .opps-reminder {
                        position: relative;
                        top: -1px;
                        padding: 9px 0 10px;
                        font-size: 11px;
                        text-transform: uppercase;
                        text-align: center;
                        color: #ffffff;
                        background: #000000;
                    }

                    .opps-info {
                        margin-top: 26px;
                        position: relative;
                    }

                    .opps-info:after {
                        visibility: hidden;
                        display: block;
                        font-size: 0;
                        content: " ";
                        clear: both;
                        height: 0;

                    }

                    .opps-brand {
                        width: 45%;
                        float: left;
                    }

                    .opps-brand img {
                        max-width: 150px;
                        margin-top: 2px;
                    }

                    .opps-ammount {
                        width: 55%;
                        float: right;
                    }

                    .opps-ammount h2 {
                        font-size: 36px;
                        color: #000000;
                        line-height: 24px;
                        margin-bottom: 15px;
                    }

                    .opps-ammount h2 sup {
                        font-size: 16px;
                        position: relative;
                        top: -2px
                    }

                    .opps-ammount p {
                        font-size: 10px;
                        line-height: 14px;
                    }

                    .opps-reference {
                        margin-top: 14px;
                    }

                    h1 {
                        font-size: 27px;
                        color: #000000;
                        text-align: center;
                        margin-top: -1px;
                        padding: 6px 0 7px;
                        border: 1px solid #b0afb5;
                        border-radius: 4px;
                        background: #f8f9fa;
                    }

                    .opps-instructions {
                        margin: 32px -45px 0;
                        padding: 32px 45px 45px;
                        border-top: 1px solid #b0afb5;
                        background: #f8f9fa;
                    }

                    ol {
                        margin: 17px 0 0 16px;
                    }

                    li + li {
                        margin-top: 10px;
                        color: #000000;
                    }

                    a {
                        color: #1155cc;
                    }

                    .opps-footnote {
                        margin-top: 22px;
                        padding: 22px 20 24px;
                        color: #108f30;
                        text-align: center;
                        border: 1px solid #108f30;
                        border-radius: 4px;
                        background: #ffffff;
                    }
                </style>
                <div class="opps">
                    <div class="opps-header">
                        <div class="opps-reminder">Ficha digital. No es necesario imprimir.</div>
                        <div class="opps-info">
                            <div class="opps-brand"><img src="https://raw.githubusercontent.com/conekta-examples/oxxopay-payment-stub/master/demo/oxxopay_brand.png" alt="OXXOPay"></div>
                            <div class="opps-ammount">
                                <h3>Monto a pagar</h3>
                                <h2>$ <span id="stub_price" ></span> <sup id="stub_currency"></sup></h2>
                                <p>OXXO cobrar&aacute; una comisi&oacute;n adicional al momento de realizar el pago.</p>
                            </div>
                        </div>
                        <div class="opps-reference">
                            <h3>Referencia</h3>
                            <h1 id="stub_reference"></h1>
                        </div>
                    </div>
                    <div class="opps-instructions">
                        <h3>Instrucciones</h3>
                        <ol>
                            <li>Acude a la tienda OXXO m&aacute;s cercana. <a href="https://www.google.com.mx/maps/search/oxxo/" target="_blank">Encu&eacute;ntrala aqu&iacute;</a>.</li>
                            <li>Indica en caja que quieres realizar un pago de <strong>OXXOPay</strong>.</li>
                            <li>Dicta al cajero el n&uacute;mero de referencia en esta ficha para que tecle&eacute; directamete en la pantalla de venta.</li>
                            <li>Realiza el pago correspondiente con dinero en efectivo.</li>
                            <li>Al confirmar tu pago, el cajero te entregar&aacute; un comprobante impreso. <strong>En el podr&aacute;s verificar que se haya realizado correctamente.</strong> Conserva este comprobante de pago.</li>
                        </ol>
                        <div class="opps-footnote">Al completar estos pasos recibir&aacute;s un correo de <strong>Nombre del negocio</strong> confirmando tu pago.</div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-info" href="/orders">Ver Ordenes</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="stub">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Talón de Pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <style>
                    /* Reset -------------------------------------------------------------------- */
                    *    { margin: 0;padding: 0; }
                    body { font-size: 14px; }

                    /* OPPS --------------------------------------------------------------------- */

                    h3 {
                        margin-bottom: 10px;
                        font-size: 15px;
                        font-weight: 600;
                        text-transform: uppercase;
                    }

                    .opps {
                        width: 496px;
                        border-radius: 4px;
                        box-sizing: border-box;
                        padding: 0 45px;
                        margin: 40px auto;
                        overflow: hidden;
                        border: 1px solid #b0afb5;
                        font-family: 'Open Sans', sans-serif;
                        color: #4f5365;
                    }

                    .opps-reminder {
                        position: relative;
                        top: -1px;
                        padding: 9px 0 10px;
                        font-size: 11px;
                        text-transform: uppercase;
                        text-align: center;
                        color: #ffffff;
                        background: #000000;
                    }

                    .opps-info {
                        margin-top: 26px;
                        position: relative;
                    }

                    .opps-info:after {
                        visibility: hidden;
                        display: block;
                        font-size: 0;
                        content: " ";
                        clear: both;
                        height: 0;

                    }

                    .opps-brand {
                        width: 45%;
                        float: left;
                    }

                    .opps-brand img {
                        max-width: 150px;
                        margin-top: 2px;
                    }

                    .opps-ammount {
                        width: 55%;
                        float: right;
                    }

                    .opps-ammount h2 {
                        font-size: 36px;
                        color: #000000;
                        line-height: 24px;
                        margin-bottom: 15px;
                    }

                    .opps-ammount h2 sup {
                        font-size: 16px;
                        position: relative;
                        top: -2px
                    }

                    .opps-ammount p {
                        font-size: 10px;
                        line-height: 14px;
                    }

                    .opps-reference {
                        margin-top: 14px;
                    }

                    h1 {
                        font-size: 27px;
                        color: #000000;
                        text-align: center;
                        margin-top: -1px;
                        padding: 6px 0 7px;
                        border: 1px solid #b0afb5;
                        border-radius: 4px;
                        background: #f8f9fa;
                    }

                    .opps-instructions {
                        margin: 32px -45px 0;
                        padding: 32px 45px 45px;
                        border-top: 1px solid #b0afb5;
                        background: #f8f9fa;
                    }

                    ol {
                        margin: 17px 0 0 16px;
                    }

                    li + li {
                        margin-top: 10px;
                        color: #000000;
                    }

                    a {
                        color: #1155cc;
                    }

                    .opps-footnote {
                        margin-top: 22px;
                        padding: 22px 20 24px;
                        color: #108f30;
                        text-align: center;
                        border: 1px solid #108f30;
                        border-radius: 4px;
                        background: #ffffff;
                    }
                </style>
                <div class="opps">
                    <div class="opps-header">
                        <div class="opps-reminder">Ficha digital. No es necesario imprimir.</div>
                        <div class="opps-info">
                            <div class="opps-brand"><img src="https://raw.githubusercontent.com/conekta-examples/oxxopay-payment-stub/master/demo/oxxopay_brand.png" alt="OXXOPay"></div>
                            <div class="opps-ammount">
                                <h3>Monto a pagar</h3>
                                <h2>$ <span id="stub_price" ></span> <sup id="stub_currency"></sup></h2>
                                <p>OXXO cobrar&aacute; una comisi&oacute;n adicional al momento de realizar el pago.</p>
                            </div>
                        </div>
                        <div class="opps-reference">
                            <h3>Referencia</h3>
                            <h1 id="stub_reference"></h1>
                        </div>
                    </div>
                    <div class="opps-instructions">
                        <h3>Instrucciones</h3>
                        <ol>
                            <li>Acude a la tienda OXXO m&aacute;s cercana. <a href="https://www.google.com.mx/maps/search/oxxo/" target="_blank">Encu&eacute;ntrala aqu&iacute;</a>.</li>
                            <li>Indica en caja que quieres realizar un pago de <strong>OXXOPay</strong>.</li>
                            <li>Dicta al cajero el n&uacute;mero de referencia en esta ficha para que tecle&eacute; directamete en la pantalla de venta.</li>
                            <li>Realiza el pago correspondiente con dinero en efectivo.</li>
                            <li>Al confirmar tu pago, el cajero te entregar&aacute; un comprobante impreso. <strong>En el podr&aacute;s verificar que se haya realizado correctamente.</strong> Conserva este comprobante de pago.</li>
                        </ol>
                        <div class="opps-footnote">Al completar estos pasos recibir&aacute;s un correo de <strong>Nombre del negocio</strong> confirmando tu pago.</div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>



</body>
</html>


<!-- bootstrap -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<!-- axios -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!-- js itic -->
<script src="{{asset("/js/checkout.js")}}"></script>
