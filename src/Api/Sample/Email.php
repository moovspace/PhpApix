<?php
/* Your class PhpApi namespace !!! */
namespace PhpApi\Api\Sample;

// Import classes
use \Exception;

// import composer class (require phpmailer)
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Email
{
    function Send(){
		echo "<br> You can send email here.";

		// Send email with smtp php mailer
		// $this->MailerSmtp('root@local.host', 'Subject hello', '<h1Hello email test</h1>');
	}

    function MailerSmtp($email, $subject, $html, $files = [], $from_email = 'admin@localhost', $from_user = 'Admin', $smtpUser = '', $smtpPass = '', $smtpHost = '127.0.0.1', $smtpTls = false, $smtpAuth = false, $smtpPort = 25, $smtpDebug = 0){
		$m = new PHPMailer(true); // Passing `true` enables exceptions
		try {
			//Server settings
			$m->SMTPDebug = (int) $smtpDebug;
			$m->isSMTP();
			$m->SMTPOptions = array('ssl' => array('verify_peer' => false,'verify_peer_name' => false,'allow_self_signed' => true));
			$m->CharSet = "UTF-8";
			// Host, port
			$m->Host = $smtpHost;
			$m->Port = $smtpPort;
			// Auth
			$m->SMTPAuth = $smtpAuth;
			$m->Username = $smtpUser;
			$m->Password = $smtpPass;
			// Ssl
			if($smtpTls == true){
				$m->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
			}
			// Sender
			$m->setFrom($from_email, $from_user);
			$m->addReplyTo($from_email, $from_user);
			// Add a recipient
			$m->addAddress($email);
			// Subject
			$m->Subject = $subject;
			// Html
			$m->isHTML(true); // Set email format to HTML
			$m->Body    = $html;
			$m->AltBody = 'This is html message!';
			// Add files from array
			foreach ($files as $path) {
				if(file_exists($path)){
					$m->addAttachment($path);
				}
			}
			// Send
			if (!$m->send()) {
				$this->ErrorMsg = $m->ErrorInfo;
				$this->Error = 0;
				return 0;
			}else{
				$this->ErrorMsg = "Email has been sent.";
				$this->Error = 1;
				return 1;
			}
		} catch (Exception $e) {
			// echo $e->getMessage();
			$this->ErrorMsg = $m->ErrorInfo;
			$this->Error = 0;
			return 0;
		}
	}
}
?>
