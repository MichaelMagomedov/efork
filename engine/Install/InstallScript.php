<?php


namespace Engine\Install;

use Composer\Script\Event;

class InstallScript
{

    static function postInstall(Event $event)
    {
        $event->getComposer()->getConfig()->get('vendor-dir');
        return $event->getComposer()->getConfig()->get('vendor-dir');
    }


}