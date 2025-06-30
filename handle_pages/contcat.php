<?php

session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
    // Collect and sanitize input
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate the input
    if (empty($name) || empty($email) || empty($message)) {
        $_SESSION['handle_notification_error'] = ($lang == 'ar') ? "خطأ، جميع الحقول مطلوبة." : "Erreur, tous les champs sont requis.";
        header("location:../contact.php");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['handle_notification_error'] = ($lang == 'ar') ? "تنسيق البريد الإلكتروني غير صالح." : "Format d'email invalide.";
        header("location:../contact.php");
        exit;
    }

    // Prepare the email
    $to = "devmehdi0@gmail.com"; 
    $subject = ($lang == 'ar') ? "رسالة اتصال جديدة من $name" : "Nouveau message de contact de $name";
    $body = ($lang == 'ar') ? "الاسم: $name\nالبريد الإلكتروني: $email\nالرسالة:\n$message" : "Nom: $name\nEmail: $email\nMessage:\n$message";
    $headers = "From: $email\r\n" .
               "Reply-To: $email\r\n";

    // Send the email
    if (mail($to, $subject, $body, $headers)) {
        $_SESSION['handle_notification_success'] = ($lang == 'ar') ? "نجاح، تم إرسال الرسالة بنجاح!" : "Succès, message envoyé avec succès!";
        header("location:../index.php");
    } else {
        $_SESSION['handle_notification_error'] = ($lang == 'ar') ? "خطأ، فشل في إرسال الرسالة. يرجى المحاولة مرة أخرى" : "Erreur, échec de l'envoi du message. Veuillez réessayer!";
        header("location:../contact.php");
    }
} else {
    $_SESSION['handle_notification_error'] = ($lang == 'ar') ? "طلب غير صالح!" : "Méthode de requête invalide!";
    header("location:../contact.php");
}
?>
