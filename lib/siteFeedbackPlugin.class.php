<?php

class siteFeedbackPlugin extends sitePlugin
{
    /**
     * @var waView $view
     */
    private static $view;
    /**
     * @var siteFeedbackPlugin $plugin
     */
    private static $plugin;

    /**
     * @return siteFeedbackPlugin|waPlugin
     * @throws waException
     */
    private static function getPlugin()
    {
        if (!isset(self::$plugin)) {
            self::$plugin = wa('site')->getPlugin('feedback');
        }
        return self::$plugin;
    }

    /**
     * @return waSmarty3View|waView
     * @throws waException
     */
    private static function getView()
    {
        if (!isset(self::$view)) {
            self::$view = waSystem::getInstance()->getView();
        }
        return self::$view;
    }

    /**
     * @return string
     */
    public function getPluginPath() {
        return $this->path;
    }

    /**
     * @return string
     * @throws waException
     */
    public static function getFeedbackControl() {
        $plugin = self::getPlugin();
        $view = self::getView();
        return $view->fetch($plugin->getPluginPath() . '/templates/controls/feedback.html');
    }
}
