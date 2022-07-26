<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Organik Haberleşme</title>
	</head>
    <body> 
        <?php 
            function send_sms($data, $api){
                $url = 'https://api.organikhaberlesme.com/sms/send';
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,$data);  //Post Fields
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER,  array(
                    'Content-Type: application/json',
                    'X-Organik-Auth: '.$api,
                ));
                $result = curl_exec ($ch);
                curl_close ($ch);
                return  $result;
            };
        ?> 
        <?php 
            if (isset($_GET["send"])) {
                if (isset($_POST['api_key'])) {
                    $data = array(
                    'header' => 100001,
                    'recipients' => $_POST['recipients'],
                    'message' => $_POST['message']
                    );
                    print_r(send_sms(json_encode($data), $_POST['api_key']));
                } else {
                    header('Location: index.php');
                }
            } 
            else {
        ?> 
                <form action="index.php?send" method="POST">
                    <label for="api_key">API Key:</label>
                    <br>
                    <input type="text" id="api_key" name="api_key" placeholder="API Key'inizi giriniz.">
                    <br>
                    <label for="recipients">Alıcı:</label>
                    <br>
                    <input type="text" id="recipients" name="recipients" placeholder="905307702435">
                    <br>
                    <label for="message">Mesaj:</label>
                    <br>
                    <input type="text" id="message" name="message" placeholder="Mesaj giriniz.">
                    <br>
                    <br>
                    <input type="submit" value="Sms Gönder!">
                </form> 
        <?php
            }
        ?> 
    </body>
</html>