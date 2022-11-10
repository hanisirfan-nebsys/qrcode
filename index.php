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
</head>

<body class="h-screen w-full flex flex-col items-center justify-center gap-10">

<h1 class="text-5xl font-bold font-serif">
    PHP QR Code Generator
</h1>

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
</div>
<div id="reader" width="1000px"></div>
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
</script>
</body>
</html>