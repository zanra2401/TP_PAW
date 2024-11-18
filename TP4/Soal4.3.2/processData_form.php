<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 100vw;
            height: fit-content;
            padding-top: 50px;
        }

        form {
            color: #575757;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: 800;
        }

        form {
            display: flex;
            flex-direction: column;
            justify-content: start;
            align-items: start;
            width: 500px;
        }

        form > * {
            box-sizing: border-box;
            width: 100%;
        }

        form > label {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php
        require "./processData.php";

        if ((!isset($_POST["submit"]) and count($errors) < 1) or count($errors) > 0) {
            require "./form.inc";
        }
    ?>
</body>
</html>
