<?php
/**
 * Main controller
 */
namespace Hdip\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MainController
 * @package Hdip\Controller
 */
class MainController
{
    /**
     * action for route:    /
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function indexAction(Request $request, Application $app)
    {
        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);
        $argsArray = array(
            'username' => $username
        );

        // render (draw) template
        // ------------
        $templateName = 'index';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * action for route:    /about
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function aboutAction(Request $request, Application $app)
    {
        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);
        $argsArray = array(
            'username' => $username
        );

        // render (draw) template
        // ------------
        $templateName = 'about';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }
}