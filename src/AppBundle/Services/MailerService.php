<?php
/**
 * Created by PhpStorm.
 * User: tr1o
 * Date: 18.09.2018
 * Time: 23:23
 */

namespace AppBundle\Services;

use Symfony\Component\Filesystem\Filesystem;

use Swift_Attachment;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class MailerService
{

    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $port;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $subject;

    /**
     * @param $host
     * @param $port
     * @param $username
     * @param $password
     */
    public function setHost($host, $port, $username, $password)
    {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @param $subject
     * @param $text
     */
    public function setText($subject, $text)
    {
        $this->text = $text;
        $this->subject = $subject;
    }

    /**
     *
     */
    public function run() {

        $originDir = '';
        $lsFile = '';

        $formMail = ['from@example.com' => 'From'];
        $fromTo = ['to@example.com' => 'To'];

        $this->send($originDir, $lsFile, $formMail, $fromTo);
    }

    /**
     * @param $originDir
     * @param $lsFile
     * @param array $formMail
     * @param array $fromTo
     */
    private function send($originDir, $lsFile, $formMail = ['from@example.com' => 'From'],
                                                $fromTo = ['to@example.com' => 'To'])
    {

        $transport = (new Swift_SmtpTransport($this->host, $this->port))
            ->setUsername($this->username)
            ->setPassword($this->password);

        $mailer = new Swift_Mailer($transport);

        $this->newLink($originDir, $lsFile);

        $message = Swift_Message::newInstance()
            ->setFrom($formMail)
            ->setTo($fromTo)
            ->setSubject($this->subject)
            ->setBody($this->text)
            ->attach(Swift_Attachment::fromPath($lsFile));

        $mailer->send($message);
    }

    /**
     * @param $originDir
     * @param $targetDir
     */
    private function newLink($originDir, $targetDir) {
        $filesystem = new Filesystem;
        $filesystem->symlink($originDir, $targetDir, $copyOnWindows = false);

    }

}