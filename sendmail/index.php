<?php
// Налаштування відправки
require 'config.php';

//Від кого лист
$mail->setFrom('some@gmail.com', 'Тестовий лист'); // Вказати потрібний E-mail
//Кому відправити
$mail->addAddress('djlabuh@gmail.com'); // Вказати потрібний E-mail
//Тема листа
$mail->Subject = 'Вітання! Це тестовий лист!';

//Тіло листа
$body = '<h1>Зустрічайте тестовий лист!</h1>';

if (!empty(trim($_POST['name']))) {
    $body .= '<p>Name: ' . htmlspecialchars($_POST['name']) . '</p>';
}

if (!empty(trim($_POST['email']))) {
    $body .= '<p>Email: ' . htmlspecialchars($_POST['email']) . '</p>';
}

if (!empty(trim($_POST['message']))) {
    $body .= '<p>Message: ' . htmlspecialchars($_POST['message']) . '</p>';
}

/*
	//Прикріпити файл
	if (!empty($_FILES['image']['tmp_name'])) {
		//шлях завантаження файлу
		$filePath = __DIR__ . "/files/sendmail/attachments/" . $_FILES['image']['name']; 
		//грузимо файл
		if (copy($_FILES['image']['tmp_name'], $filePath)){
			$fileAttach = $filePath;
			$body.='<p><strong>Фото у додатку</strong>';
			$mail->addAttachment($fileAttach);
		}
	}
	*/

$mail->Body = $body;

//Відправляємо
if (!$mail->send()) {
	$message = 'Помилка';
} else {
	$message = 'Дані надіслані!';
}

$response = ['message' => $message];

header('Content-type: application/json');
echo json_encode($response);
