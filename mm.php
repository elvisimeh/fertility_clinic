<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <input type="text" name="" id="tcn" data-test='3' onkeyup="nn()">

    <p id="tc">
    
    </div>

<script src="../../assets/hms-js/jquery-1.11.1.min.js"></script>  
    <script>
    function nn(){
        alert(document.getElementById("tcn").getAttribute('data-test'));
    //document.getElementById("tc").innerHTML = 10-document.getElementById("tcn").value;
    }
    </script>
</body>
</html>