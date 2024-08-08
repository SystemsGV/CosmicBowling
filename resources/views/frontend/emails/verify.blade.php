<!DOCTYPE html>
<html>

<head>
    <title>Verificación de Cuenta</title>
</head>

<body>
    <h1>Verifica tu cuenta</h1>
    <p>Haz clic en el enlace a continuación para verificar tu cuenta:</p>
    <a href="{{ url('/verify?token=' . $token) }}">Verificar Cuenta</a>
</body>

</html>
