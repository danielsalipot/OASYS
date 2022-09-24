<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class EmailSendingController extends Controller
{
    function sendNotifEmail($head,$body,$reciever){
        $config = \SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
        $apiInstance = new \SendinBlue\Client\Api\TransactionalEmailsApi(
            // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
            // This is optional, `GuzzleHttp\Client` will be used as default.
            new \GuzzleHttp\Client(),
            $config
        );

        $template = view('EmailTemplates.EmailNotif')
            ->with(['head'=>$head, 'body' => $body])
            ->render();

        $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail();
        $sendSmtpEmail['subject'] = 'Oasys Notification';
        $sendSmtpEmail['htmlContent'] = $template;
        $sendSmtpEmail['sender'] = array('name' => 'Oasys', 'email' => 'noreply@oasys.com');
        $sendSmtpEmail['to'] = $reciever;
        $sendSmtpEmail['headers'] = array('Some-Custom-Name' => 'unique-id-1234');
        $sendSmtpEmail['params'] = array('parameter' => 'My param value', 'subject' => 'New Subject');

        try {
            $apiInstance->sendTransacEmail($sendSmtpEmail);
        } catch (Exception $e) {
            echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
        }
    }

    function sendCOE($link,$email,$fname,$lname){
        $config = \SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
        $apiInstance = new \SendinBlue\Client\Api\TransactionalEmailsApi(
            // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
            // This is optional, `GuzzleHttp\Client` will be used as default.
            new \GuzzleHttp\Client(),
            $config
        );

        $template = view('EmailTemplates.CoeEmailTemplate')
            ->with(['link' => $link])
            ->render();

        $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail();
        $sendSmtpEmail['subject'] = 'Cerftificate Of Employment';
        $sendSmtpEmail['htmlContent'] = $template;
        $sendSmtpEmail['sender'] = array('name' => 'Oasys', 'email' => 'noreply@oasys.com');
        $sendSmtpEmail['to'] = array(
            array('email' => $email, 'name' => $fname . ' ' . $lname)
        );
        $sendSmtpEmail['headers'] = array('Some-Custom-Name' => 'unique-id-1234');
        $sendSmtpEmail['params'] = array('parameter' => 'My param value', 'subject' => 'New Subject');

        try {
            $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
        } catch (Exception $e) {
            echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
        }
    }
}
