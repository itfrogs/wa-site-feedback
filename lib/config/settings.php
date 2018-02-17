<?php

return array (
    'from'              => array(
        'value'        => '',
        'title' => _wp("E-mail from which the message will be sent"),
        'description' => _wp('If you leave the field blank, the message will come from the buyer\'s mailbox. At the same time, the probability of getting into spam is high.'),
        'control_type' => 'text',
        'subject'       => 'basic_settings',
    ),
    'to'              => array(
        'value'        => '',
        'title' => _wp("E-mail to which the message will be sent"),
        'description' => _wp('Obligatory field. If it is not filled or not true, the plugin will not work.'),
        'control_type' => 'text',
        'subject'       => 'basic_settings',
    ),
    'subj_prefix'              => array(
        'value'        => _wp('Message from customer: '),
        'title' => _wp("E-mail subject prefix"),
        'description' => _wp('If your form has a field with the name="subject", then it will be added after the prefix.'),
        'control_type' => 'text',
        'subject'       => 'basic_settings',
    ),
    'body' => array(
        'value' => _wp('The customer left a message from {$email} through the feedback form:<br /><br />{$text}'),
        'title' => _wp('Mail body'),
        'description' => _wp('Set the mail body. Use Smarty.<br/>{$email} - Customer email.<br/>{$subject} - Email subject.<br/>{$text} - message text.' . '<br/>' . _wp('{$name} - Customer`s name.')),
        'control_type' => waHtmlControl::TEXTAREA,
        'subject' => 'basic_settings',
    ),
    'mail_log' => array(
        'value'         => 0,
        'title'         => _wp("Log sended e-mails"),
        'description'   => _wp('If checked, sended e-mails will be logged.'),
        'control_type'  => waHtmlControl::CHECKBOX,
        'subject'       => 'basic_settings'
    ),
    'feedback' => array(
        'title' => _wp('Ask for technical support'),
        'description'   => _wp('Click on the link to contact the developer.'),
        'control_type' => waHtmlControl::CUSTOM.' '.'siteFeedbackPlugin::getFeedbackControl',
        'subject'       => 'info_settings',
    ),
);
