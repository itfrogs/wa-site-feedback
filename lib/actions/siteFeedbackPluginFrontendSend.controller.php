<?php
/**
 * Created by PhpStorm.
 * User: snark | itfrogs.ru
 * Date: 1/12/18
 * Time: 11:59 PM
 */

class siteFeedbackPluginFrontendSendController extends waJsonController
{
    /**
     * @throws waException
     */
    public function execute()
    {
        $data = waRequest::post();

        /**
         * @var siteFeedbackPlugin $plugin
         */
        $plugin = wa('site')->getPlugin('feedback');
        $settings = $plugin->getSettings();

        $pass = true;

        if (!filter_var($settings['to'], FILTER_VALIDATE_EMAIL)) {
            $this->setError(_wp('Site e-mail is invalid'));
            $pass = false;
        }
        else {
            $to = $settings['to'];
        }

        if (isset($data['captcha']) && !wa()->getCaptcha()->isValid($data['captcha'])) {
            $this->setError(_wp('Captha is invalid'));
            $pass = false;
        }

        if (isset($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->setError(_wp('Customer`s e-mail is invalid'));
            $pass = false;
        }
        else {
            if (empty($settings['from'])) {
                $from = $data['email'];
            }
            else {
                $from = $settings['from'];
            }
        }

        waLog::dump($data, 'site-feedback.log');

        if (isset($data['name']) && !empty($data['name'])) {
            $name = $data['name'];
        }
        else {
            $name = _wp('Customer');
        }

        if ($pass) {
            $view = wa()->getView();

            $view->assign('name', $name);
            $view->assign('email', $data['email']);
            $view->assign('subject', urldecode($data['subject']));
            $view->assign('text', nl2br(urldecode($data['text'])));

            $body = $view->fetch('string:' . $settings['body']);
            $subj = $settings['subj_prefix'];
            if (isset($data['subject']) && !empty($data['subject'])) {
                $subj .= urldecode($data['subject']);
            }

            try {
                $message = new waMailMessage($subj, $body);
                $message->addReplyTo($data['email']);
                $message->setFrom($from, $name);
                $message->setTo($to);
                $status = $message->send();

                if ($settings['mail_log'] == 1) {
                    if ($status) {
                        waLog::log(sprintf(_wp('Message from %s has been sent successfully'), $data['email']), 'site-feedback-mail.log');
                    }
                    else {
                        waLog::log(sprintf(_wp('Message from %s not been sended'), $data['email']), 'site-feedback-mail.log');
                    }
                }
            }
            catch (waException $e) {
                waLog::log(_wp('Error send email from ' . $data['email']), 'site-feedback-mail-error.log');
                waLog::log($e, 'site-feedback-mail-error.log');
            }
        }
    }
}