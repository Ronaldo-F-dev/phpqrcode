<?php
    /*
        Auteur : AWADEME Ronaldo
    */
    include 'phpqrcode/qrlib.php';
    if(isset($_POST['generer'])){
        extract($_POST);
        $ssid = htmlspecialchars($ssid);
        $encryption = htmlspecialchars($encryption);
        $password = htmlspecialchars($password);
        if(!empty($ssid) && !empty($encryption) && !empty($password)){
            $file_name = "qr_code.png";
            if($encryption == "wpa" || $encryption == "wpa2"){
                if(strlen($password) >= 8){
                    QRcode::png($password, $file_name);
                    header("location:qrcode.php");
                }else{
                    $erreur = "Minimum 08 caractères";
                }
            }elseif($encryption == "wep"){
                if(strlen($password) >= 10){
                    QRcode::png($password, $file_name);
                    header("location:qrcode.php");
                }else{
                    $erreur = "Minimum 10 caractères";
                }
            }else{
                $erreur = "Encryption incorrect ";
            }
            
        }else{
            $erreur = "Veuillez remplir tous les champs ";
        }
    }
?>
<!Doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta description="Génrérer facilement le QR Code de votre réseau wifi"/>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="flex justify-center items-center h-screen">
        <div class="mx-auto max-w-lg">
            <h1 class="text-3xl font-bold mb-4">QR Code Wifi</h1>
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post">
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="ssid">
                        SSID
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="ssid" type="text" name="ssid" />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="select">
                        Encryption
                    </label>
                    <div class="relative">
                        <select
                            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                            id="select" name="encryption">
                            <option value="wpa">WPA</option>
                            <option value="wpa2">WPA2</option>
                            <option value="wep">WEP</option>
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M10 12l-5-5 1.41-1.41L10 9.18l3.59-3.59L15 7l-5 5z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="password">
                        Mot de passe
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="password" type="text" name="password" />
                </div>
                <div class="flex items-center justify-center">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit" name="generer">
                        Générer le QR Code
                    </button>
                </div><br/>
                <?php
                if(isset($erreur)) {
                ?>
                <div class="mb-4">
                    <div class="bg-red-200 text-yellow-900 px-4 py-2 rounded-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M19.707,16.293l-7-7c-0.391-0.391-1.023-0.391-1.414,0l-7,7c-0.391,0.391-0.391,1.023,0,1.414l7,7c0.391,0.391,1.023,0.391,1.414,0l7-7C20.098,17.316,20.098,16.684,19.707,16.293z M10,18.586l-6.293-6.293l1.414-1.414L10,15.758l4.879-4.879l1.414,1.414L10,18.586z M10,4.414L5.121,9.293l-1.414-1.414L10,1.586l6.293,6.293l-1.414,1.414L10,4.414z"/>
                                </svg>
                            </div>
                        <div class="ml-3">
                            <p class="text-sm leading-5 font-medium"><?=$erreur?></p>
                        </div>
                    </div>
                </div>
                </div>
                <?php } ?>
            </form>
        </div>
    </div>
</body>
</html>