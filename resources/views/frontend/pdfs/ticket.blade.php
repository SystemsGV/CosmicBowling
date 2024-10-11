<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Ingreso</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .ticket {
            width: 500px;
            border: 2px solid black;
            padding: 10px;
            margin: 0 auto;
        }
        .header {
            background-color: #d3d3d3;
            padding: 10px;
            text-align: center;
            font-weight: bold;
        }
        .header .title {
            font-size: 22px;
        }
        .header .subtitle {
            font-size: 16px;
        }
        .content {
            padding: 10px;
        }
        .content .section {
            display: flex;
            justify-content: space-between;
        }
        .content .section div {
            width: 45%;
        }
        .content .section div p {
            margin: 5px 0;
        }
        .qr-code {
            text-align: center;
            margin-top: 20px;
        }
        .qr-code img {
            width: 160px;
            height: 160px;
        }
        .footer {
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="header">
            <div class="title">COSMIC BOWLING</div>
            <div class="subtitle">TICKET DE RESERVA</div>
        </div>
        <div class="content">
            <div class="section">
                <div>
                    <p><strong>APELLIDOS Y NOMBRES</strong><br>GORA RAMOS Marlon Emerson</p>
                    <p><strong>DNI</strong><br>75214038</p>
                </div>
                <div>
                    <p><strong>NRO TICKET</strong><br>110758</p>
                    <p><strong>PRECIO</strong><br>96</p>
                </div>
            </div>
            <div class="qr-code">
                <!-- Aquí insertas la imagen del QR -->
                <img src="{{$qr}}" alt="QR Code">
            </div>
        </div>
        <div class="footer">
            <p><strong>FECHA ENTRADA</strong><br>31/10/2024</p>
        </div>
    </div>
</body>
</html>
