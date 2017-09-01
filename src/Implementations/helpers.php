<?php

$rootApp = null;

function view(string $viewName, array $variable = null)
{
    if (isset($variable)) {
        extract($variable);
    }
    return include $_SERVER['DOCUMENT_ROOT'] . "/../views/" . $viewName . '.view.php';

}

function setApp($app)
{
    global $rootApp;

    $rootApp = $app;

}

function app()
{
    global $rootApp;

    return $rootApp;
}

