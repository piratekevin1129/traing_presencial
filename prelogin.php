<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include './layouts/css.php'; ?>
    
    <link href="./public/assets/css/modal.css" rel="stylesheet" type="text/css" />
    <link href="./public/assets/css/form.css" rel="stylesheet" type="text/css" />
    <link href="./public/assets/css/camara.css" rel="stylesheet" type="text/css" />
    
    <title>Traing Presencial - Escanear QR</title>
    <style type="text/css">
        #escanear-btn{
            width: fit-content;
            height: 50px;
            padding: 0px 30px;
            border-radius: 2px;
            background-color: var(--menugray);
            font-family: 'Quicksand-Medium';
            font-size: 1rem;
            color: var(--azul);
            margin: 200px auto;
            box-shadow: -1px 1px 2px 0px rgba(0,0,0,0.2);
        }
        #escanear-btn:hover{
            box-shadow: -1px 1px 3px 0px rgba(0,0,0,0.4);
        }
    </style>
</head>
<body>
    <button type="button" id="escanear-btn" onclick="clickEscanearQr()">
        <span>Escanear código QR</span>
    </button>
    <!--modales-->
    <?php include './components/modals/escanear-qrs.php'; ?>

    <script src="./public/assets/scripts/modal.js"></script>
    <script src="./public/assets/qr/qrCode.min.js"></script>
    <script src="./public/assets/scripts/qr.js"></script>

    <script>
        function confirmarQr(){
            location.href = './login-user.php'
        }
    </script>
</body>
</html>