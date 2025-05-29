    <?php
require_once __DIR__ . '/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/src/SMTP.php';
require_once __DIR__ . '/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

    $userId = $_SESSION['user_id'] ?? 0;
    $cartItems = getCartItems($pdo);
    $total = 0;
    $items = [];

    foreach ($cartItems as $item) {
        $line = "{$item['name']} x {$item['quantity']}";
        $items[] = $line;
        $total += $item['price'] * $item['quantity'];
    }

    $itemStr = implode(", ", $items);
    $stmt = $pdo->prepare("INSERT INTO orders (user_id, items, total) VALUES (?, ?, ?)");
    $stmt->execute([$userId, $itemStr, $total]);

    // Send email
    $stmt = $pdo->prepare("SELECT email FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $userEmail = $stmt->fetchColumn();

   $mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'www.gmail.com'; // e.g., smtp.gmail.com
    $mail->SMTPAuth = true;
    $mail->Username = 'writerspowerful@gmail.com'; // Replace
    $mail->Password = 'Pluto10##';           // Replace
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('writerspowerful@gmail.com', 'E-commerce Shop');
    $mail->addAddress($userEmail);
    $mail->Subject = 'Order Confirmation';
    $mail->Body = "Thank you for your order!\n\nItems: $itemStr\nTotal: $$total";
    $mail->send();
} catch (Exception $e) {
    echo "Mail Error: " . $mail->ErrorInfo;
}

    $_SESSION['cart'] = [];
    ?>
    <h2 class="text-2xl">Order placed!</h2>
