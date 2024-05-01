<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login V1</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            text-align: center;
            padding: 40px 0;
            background-image: linear-gradient(to right top, #d1fb7b, #c0f785, #b0f28f, #a2ec98, #97e6a0);
            min-height: 100vh;
        }
        h1 {
            color: 	#22bb33;
            font-weight: 900;
            font-size: 40px;
            margin-bottom: 10px;
        }
        p {
            color: #404F5E;
            font-size:20px;
            margin: 0;
        }
        i {
            color: 	#22bb33;
            font-size: 170px;
            line-height: 200px;
            margin-left:-15px;
        }
        .card {
            background: white;
            padding: 60px;
            border-radius: 4px;
            box-shadow: 0 2px 3px #C8D0D8;
            display: inline-block;
            margin: 0 auto;
        }
        .circle{
            border-radius:200px;
            height:200px;
            width:200px;
            background: #F8FAF5;
            margin:0 auto;
            justify-content: center;
            align-items: center;
            display: flex;
        }
        a{
            color: 	#22bb33;
            text-decoration: none;
        }
    </style>
</head>

<body>
<div class="card">
    <div class="circle">
        <i class="bi bi-check2"></i>
    </div>
    <h1>Success</h1>
    <p>Your password has been changed;<br/> <a href="login.php">Click here</a> to back to login page</p>
</div>
</body>
</html>