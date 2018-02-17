<?php
/**
 * Created by PhpStorm.
 * User: snark | itfrogs.ru
 * Date: 1/8/18
 * Time: 12:36 AM
 */


class siteFeedbackPluginHelper
{
    /**
     * @param string $form_selector
     * @param string $success_selector
     * @param string $error_selector
     * @throws waException
     */
    public static function handler($form_selector = '', $captcha_selector = '', $success_selector = '', $error_selector = '') {
        if (empty($form_selector)) {
            return '';
        }
        else {
            /*
             * @var siteFeedbackPlugin $plugin
             */
            $plugin = wa('site')->getPlugin('feedback');
            $view = wa('site')->getView();

            $view->assign('form_selector', $form_selector);
            $view->assign('captcha_selector', $captcha_selector);
            $view->assign('success_selector', $success_selector);
            $view->assign('error_selector', $error_selector);

            $siteUrl = wa('site')->getRouteUrl('site/frontend');
            $siteUrl = rtrim($siteUrl, '/my/') . '/';
            $view->assign('site_url', $siteUrl);

            return $view->fetch($plugin->getPluginPath() . '/templates/helpers/handler.html');
        }
    }
}