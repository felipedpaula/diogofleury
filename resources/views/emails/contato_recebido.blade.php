<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 5px;
        }
        .header {
            background-color: #292929;
            color: #686868;
            padding: 10px 0;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 20px;
        }
        .content p {
            font-size: 16px;
            line-height: 1.5;
        }
        .footer {
            background-color: #f4f4f4;
            color: #777777;
            text-align: center;
            padding: 10px;
            border-radius: 0 0 5px 5px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Nova Mensagem</h1>
        </div>
        <div class="content">
            <p>Olá,</p>
            <p>Você recebeu uma nova mensagem de contato através do seu site: </p>
            <p><strong>Nome:</strong> {{$dados['nome']}}</p>
            <p><strong>Email:</strong> {{$dados['email']}}</p>
            <p><strong>Telefone:</strong> {{$dados['tel']}}</p>
            <p><strong>Mensagem:</strong></p>
            <p>{{$dados['mensagem']}}</p>
        </div>
        <div class="footer">
            <p>Este é um e-mail automático, por favor, não responda.</p>
            <p>&copy; 2024 Diogo Fleury Fotografia. Todos os direitos reservados.</p>
        </div>
    </div>
</body>
</html>
