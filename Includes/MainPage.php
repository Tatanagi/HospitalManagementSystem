<?php
// You can add dynamic PHP logic here if needed in the future
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hanami Hospital</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        } 
        .header {
            background: #080394;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            text-align: center;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        h1 {
            color: white;
            font-size: 35px;
            margin-left: 20px;
        }
        .admin-button {
            background-color: #f39c12;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            margin-right: 20px;
        }
        .admin-button:hover {
            background-color: #e67e22;
        }
        .content {
            flex: 1; 
            text-align: center;
            padding: 150px 20px 20px;
        }
        p { 
            font-size: 55px;
            max-width: 800px;
            margin: 0 auto;
        }
        .footer {
            background: #080394;
            width: 100%;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            padding: 50px 0;
        }
        .my-button {
            background-color: #0b03d0;
            color: white;
            padding: 20px 250px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }
        .my-button:hover {
            background-color: #030060;
        }  
        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://st3.depositphotos.com/2712843/14504/i/450/depositphotos_145046321-stock-photo-blurred-hospital-background.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            z-index: -1;
        } 
        .background::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body>
    <div class="background"></div>

    <header class="header">
        <h1>Hanami Hospital</h1>
        <a href="Admin.php">
            <button class="admin-button">Admin Page</button>
        </a>
    </header>

    <div class="content">
        <p>
            Welcome to Hanami Hospital!
			This website is designed to make managing your medical appointments 
			much more easier and more convenient. Whether you need to book a new 
			appointment, reschedule, or cancel an existing one, our system is here to help, 
			ensuring a smoother experience for everyone. 
			Reserve now by pressing the button below.
        </p>
    </div>

    <footer class="footer">
        <a href="Information.php">
            <button class="my-button">Reserve Now</button>
        </a>
    </footer>
</body>
</html>
