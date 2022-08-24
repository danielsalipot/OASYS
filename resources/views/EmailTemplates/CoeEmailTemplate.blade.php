<html>
    <style>
        body{
            text-align: center;
        }
        *{
            font-family:Arial, Helvetica, sans-serif;
        }

        .button {
            font: bold 11px Arial;
            text-decoration: none;
            background-color: #EEEEEE;
            color: #333333;
            padding: 2px 6px 2px 6px;
            border-top: 1px solid #CCCCCC;
            border-right: 1px solid #333333;
            border-bottom: 1px solid #333333;
            border-left: 1px solid #CCCCCC;
        }
    </style>
    <body>
        <h1 style="width: 100%; text-align:center; color:rgb(33, 55, 117);font-weight:bolder; margin:30px;font-size:60px">OASYS</h1>
        <h3 style="width: 100%; background-color:rgb(231, 231, 231); color:rgb(48, 48, 48);padding:15px">Certificate of Employment</h3>

        <p>Thank you for working on Beulah Land Christian College Inc, in order to download your certificate of employment, please click the button or use the link below</p>
        <br>
        <br>
        <a class="button" style="padding:15px; padding-left:40px; padding-right:40px;background-color:#1c367d;border-radius: 5px; color:white;" href="{{$link}}">Certificate of Employment</a>
        <br>
        <br>
        <br>
        <h5>Certificate of Employment link</h5>
        <a href="{{$link}}">{{$link}}</a>
    </body>
</html>
