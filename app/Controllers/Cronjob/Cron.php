<?php
namespace App\Controllers\Cronjob;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Cron extends \App\Controllers\BaseController 
{
	public function __construct()
	{
  	$this->request = \Config\Services::request();
  }

  public function index()
	{
  	// cmd  : php index.php cronjob testcronjob message in public folder  o/p : Hello World!
  		
		if (! $this->request->isCLI())
		{
			return "This script can not access." . PHP_EOL;
		}	

		$result = $this->user->create(['status' => FALSE]);

		if ($result != FALSE)
		{
			$mail = new PHPMailer();
			//Server settings
			$mail->SMTPDebug = SMTP::DEBUG_SERVER; 						//Enable verbose debug output
			$mail->isSMTP(); 														//Send using SMTP
			$mail->Host = 'smtp.googlemail.com'; 							//Set the SMTP server to send through
			$mail->SMTPAuth = true; 											//Enable SMTP authentication
			$mail->Username = 'akashp@websoptimization.com'; 			//SMTP username
			$mail->Password = 'akash@wo`123'; 								//SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 		//Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
			$mail->Port = 587; 	//TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
			$mail->setFrom('akashp@websoptimization.com', 'ci practical test');

			if (count($result) > 0) 
			{
				foreach ($result as $key => $value)
				{
				//Recipients
				$mail->addBCC($value['email'], $value['name']); //Add a recipient
				}

				//Name is optional
				$mail->addReplyTo('akashp@websoptimization.com', 'akashp');

				//Content
				$mail->isHTML(true); //Set email format to HTML
				$mail->Subject = 'Account activated successfully';
				$mail->Body = 'Your account successfully activated.';
				$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

				if ($mail->send()) 
				{
					echo "Message has been sent to all activated account.\n";
				} 
				else 
				{
					echo "Message could not be sent. {$mail->ErrorInfo}\n";
				}
			}
		} 
			else
		{
			echo "Record not found.\n";
		}
	}
}