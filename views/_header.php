<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        label, input, textarea {
            display: block;
            width: 100%;
        }
        input, textarea {
            margin-top: 0.5rem;
            margin-bottom: 1rem;
            line-height: 1.5rem;
            padding: 0.5rem;
        }
        form {
            width: 500px;
            margin: 50px auto;
            border: 1px solid #333;
            padding: 2rem;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
        }
        h1 {
            margin-bottom: 2rem;
        }
        .message {
            width: 500px;
            margin: 50px auto;
            border: 1px solid #333;
            background: #ddd;
            padding: 1rem;
        }
    </style>
</head>
<body>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="message">
        <?php echo $_SESSION['message'];unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>

<a href=""></a>