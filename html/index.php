<!DOCTYPE html>
<html>
<head>
    <title>Redirect Example</title>
</head>
<body>

    <?php
        // Redirect to index.html after 5 seconds
        header("Refresh: 2; URL=../html/index.html");
    ?>

    <h1>You will be redirected to index.html in 5 seconds.</h1>

</body>
</html>