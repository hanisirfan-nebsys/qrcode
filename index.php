<?php

use chillerlan\QRCode\QRCode;

include './vendor/autoload.php';

$result = '';

if (isset($_GET['content']) && !empty($_GET['content'])) {
    $result = (new QRCode())->render($_GET['content']);
}
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>PHP QR Code Generator</title>
    <style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>
    
</head>

<body class="h-screen w-full flex flex-col items-center justify-center gap-10">

<h1 class="text-5xl font-bold font-serif">
    PHP QR Code Generator
</h1>

<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'Scanner')">Scanner</button>
  <button class="tablinks" onclick="openCity(event, 'Generator')">Generator</button>
</div>

<div id="Scanner" class="tabcontent">
  <p><div id="reader" width="1000px"></div>
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
function onScanSuccess(decodedText, decodedResult) {
        console.log(`Scan result: ${decodedText}`, decodedResult);
        document.getElementById("barcode").value = decodedResult;
    }

    function onScanFailure(error) {
        //console.warn(`Code scan error = ${error}`);
    }
    setTimeout( () => {
        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    }, 1000)
</script></p>
</div>

<div id="Generator" class="tabcontent">
  <p>

<div class="w-full px-28 grid grid-cols-2 gap-4">
    <div class="border border-gray-300 p-6 rounded-lg">
        <form action="index.php" method="get">
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Content</label>
                <textarea type="text"
                          name="content"
                          class="block p-4 w-full rounded-lg border border-gray-300 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
            </div>

            <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Generate
            </button>
        </form>
    </div>

    <div class="border border-gray-300 p-6 rounded-lg flex items-center justify-center">
        <?php if (isset($result) && !empty($result)): ?>
            <img src="<?= $result ?>"/>
        <?php endif; ?>
    </div>
</div>.</p> 
</div>

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>


</body>
</html>