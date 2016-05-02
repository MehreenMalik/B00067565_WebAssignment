<?php
/**
 * User controller
 */
namespace Hdip\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Hdip\Model\User;

/**
 * Class UserController
 * @package Hdip\Controller
 */
class UserController
{
    /**
     * action for POST route:    /processLogin
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function processLoginAction(Request $request, Application $app)
    {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        // search for user with username in repository
        $isLoggedIn = User::canFindMatchingUsernameAndPassword($username, $password);
        if ($isLoggedIn)
        {
            // store username in 'user' in 'session'
            $app['session']->set('user', array('username' => $username) );

            return $app->redirect('/admin');
        }

        // login page with error message
        $templateName = 'login';
        $argsArray = array
        (
            'errorMessage' => 'bad username or password - please re-enter'
        );

        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * action for route:    /login
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function loginAction(Request $request, Application $app)
    {
        // logout any existing user
        $app['session']->set('user', null );

        // build args array
        // ------------
        $argsArray = [];

        // render (draw) template
        // ------------
        $templateName = 'login';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * action for route:    /logout
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function logoutAction(Request $request, Application $app)
    {
        // logout any existing user
        $app['session']->set('user', null );

        // redirect to home page
        //return $app->redirect('/');

        // render (draw) template
        // ------------
        $templateName = 'index';
        return $app['twig']->render($templateName . '.html.twig', []);
    }
}