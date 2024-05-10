<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #afc0ff, #b8edfc);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Roboto', sans-serif;
        }

        .custom-card {
            max-width: 400px;
            width: 90%;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .btn {
            margin-top: 15px;
            width: 100%;
            padding: 10px 0;
            border-radius: 5px; 
            color: white; 
            border: none;
            transition: background-color 0.2s;
        }
        .btn-primary {
            background-color: #0055c5; 
        }

        .btn-danger {
            background-color: #000000; 
        }
        .btn:hover {
            transform: translateY(-2px);  
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);  
        }

    </style>
</head>
<body>
<div class="custom-card">
    <h3 class="text-center mb-3">Quản lý học sinh</h3>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Chọn trang đăng nhập</h5>
            <h6 class="card-subtitle mb-2 text-muted">Chọn lựa chọn đăng nhập để bắt đầu</h6>
            <button onclick="location.href='Admin/login.php'" type="button" class="btn btn-primary">Đăng nhập cho admin</button>
            <button onclick="location.href='Student/login.php'" type="button" class="btn btn-danger">Đăng nhập cho học sinh</button>
        </div>
    </div>
</div>
</body>
</html>
