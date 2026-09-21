<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Something Went Wrong</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .error-box {
            width: 90%;
            max-width: 500px;
            padding: 40px;
            background: #fff;
            text-align: center;
            border-radius: 12px;
            box-shadow: 0 5px 25px rgba(0,0,0,.08);
        }

        .error-code {
            font-size: 70px;
            font-weight: bold;
            color: #003366;
            margin-bottom: 10px;
        }

        h2 {
            color: #333;
        }

        p {
            color: #666;
            line-height: 1.6;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background: #003366;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
        }
    </style>
</head>

<body>

<div class="error-box">

    <div class="error-code">500</div>

    <h2>Something Went Wrong</h2>

    <p>
        We're sorry, but we couldn't process your request.
        Please try again later.
    </p>

    <a href="{{ url()->previous() }}">
        Try Again
    </a>

</div>

</body>
</html>