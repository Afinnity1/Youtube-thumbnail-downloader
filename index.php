<?php 

    if(isset($_POST['download'])){ //if download button is clicked
        $imgUrl = $_POST['imgurl']; //getting image url from hidden input
       
        $ch = curl_init($imgUrl); //initializing curl
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //it transfers data as the return value of curl_exec rather that outputting it directly
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // follow redirects if any
        $download = curl_exec($ch); //executing curl
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // get HTTP response code
        curl_close($ch); //closing curl session


        if ($httpCode == 200) { // check if the request was successful
            header('Content-Type: image/jpeg'); // setting Content-Type to image/jpeg
            header('Content-Disposition: attachment; filename="thumbnail.jpg"'); // setting Content-Disposition to attachment
            echo $download; // output image data
        } else {
            echo 'Error: Unable to download image'; // display error message
        }
    }

?>


<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>YTube thumbnail downloader</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <header>
            Download Thumbnail
        </header>
        <div class="url-input">
            <span class="title">Paste video url:</span>
            <div class="field">
                <input type="text" placeholder="https://www.youtube.com/watch?v=lqwdD2ivIbM" required>
                <input class="hidden-input" type="hidden" name="imgurl">
                <!--using hidden-input to download image using php -->
                <div class="bottom-line"></div>
            </div>
        </div>
        <div class="preview-area">
            <i class="icon fa fa-download"></i>
            <img src="" class="thumbnail" alt="thumbnail" />
            <span>Paste url to see preview</span>
        </div>
        <button class="download-btn" type="submit" name="download">Download thumbnail</button>
    </form>

    <script src="script.js"></script>
</body>
</html>