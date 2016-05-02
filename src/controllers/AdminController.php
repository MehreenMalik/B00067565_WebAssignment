<?php
/**
 * Admin controller
 */
namespace Hdip\Controller;

use Hdip\Model\Classe;
use Hdip\Model\Student;
use Hdip\Model\User;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AdminController
 *
 * @package Hdip\Controller
 */
class AdminController
{
    /**
     * empty method
     */
    public function isAuthenticated()
    {

    }

    /**
     * action for route:    /admin
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function indexAction(Request $request, Application $app)
    {
        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);

        // check we are authenticated --------
        $isAuthenticated = (null != $username);
        if(!$isAuthenticated){
            // not authenticated, so redirect to LOGIN page
            return $app->redirect('/login');
        }

        // store username into args array
        $argsArray = array(
            'username' => $username
        );

        // render (draw) template
        $templateName = 'admin/index';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * action for route:    /adminProfile
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function profileAction(Request $request, Application $app)
    {
        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);
        $userProfile = User::getOneByUsername($username);

        // check we are authenticated --------
        $isAuthenticated = (null != $username);
        if(!$isAuthenticated){
            // not authenticated, so redirect to LOGIN page
            return $app->redirect('/login');
        }

        // store username into args array
        $argsArray = array(
            'username' => $username,
            'userProfile' => $userProfile
        );

        // render (draw) template
        $templateName = 'admin/profile';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * action for route:    /adminClasses
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function classesAction(Request $request, Application $app)
    {
        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);
        $classes = Classe::getAll();

        // check we are authenticated --------
        $isAuthenticated = (null != $username);
        if(!$isAuthenticated)
        {
            // not authenticated, so redirect to LOGIN page
            return $app->redirect('/login');
        }

        // store username into args array
        $argsArray = array
        (
            'username' => $username,
            'classes' =>$classes
        );

        // render (draw) template
        $templateName = 'admin/classes';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * action for route:    /adminStudents
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function studentsAction(Request $request, Application $app)
    {
        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);
        $students = Student::getAll();

        // check we are authenticated --------
        $isAuthenticated = (null != $username);
        if(!$isAuthenticated){
            // not authenticated, so redirect to LOGIN page
            return $app->redirect('/login');
        }

        // store username into args array
        $argsArray = array(
            'username' => $username,
            'students' => $students
        );

        // render (draw) template
        $templateName = 'admin/students';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * action for route: /showNewStudentForm
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function showNewStudentFormAction(Request $request, Application $app)
    {
        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);

        // check we are authenticated --------
        $isAuthenticated = (null != $username);
        if(!$isAuthenticated)
        {
            // not authenticated, so redirect to LOGIN page
            return $app->redirect('/login');
        }

        // store username into args array
        $argsArray = array
        (
            'username' => $username,
        );

        // render (draw) template
        $templateName = 'admin/newStudentForm';
        return $app['twig']->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * action for route:    /adminAddStudent
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
    public function processAddStudentAction(Request $request, Application $app)
    {
        // get data from POST
        $classId = filter_input(INPUT_POST, 'classId', FILTER_SANITIZE_NUMBER_INT);
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $instructorUsername = filter_input(INPUT_POST, 'instructorUsername', FILTER_SANITIZE_STRING);
        $currentGrade = filter_input(INPUT_POST, 'currentGrade', FILTER_SANITIZE_NUMBER_INT);
        $ageAttendance = filter_input(INPUT_POST, 'ageAttendance', FILTER_SANITIZE_STRING);
        $nextGrading = filter_input(INPUT_POST, 'nextGrading', FILTER_SANITIZE_STRING);
        $averageGrade = filter_input(INPUT_POST, 'averageGrade', FILTER_SANITIZE_STRING);
        $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);

        $s = new Student();
        $s->setClassId($classId);
        $s->setUsername($username);
        $s->setInstructorUsername($instructorUsername);
        $s->setCurrentGrade($currentGrade);
        $s->setAgeAttendance($ageAttendance);
        $s->setNextGrading($nextGrading);
        $s->setAverageGrade($averageGrade);
        $s->setStatus($status);

        $success = Student::insert($s);

        if($success)
        {
            // students page with error message
            $templateName = 'admin/students';
            $argsArray = array
            (
                'successMessage' => 'Student successfully entered.'
            );
            return $app['twig']->render($templateName . '.html.twig', $argsArray);
        }
        else
        {
            // students page with error message
            $templateName = 'admin/students';
            $argsArray = array
            (
                'errorMessage' => 'error - not able to CREATE item'
            );
            return $app['twig']->render($templateName . '.html.twig', $argsArray);
        }
    }

    /**
     * action for route: /processUpdate
     * @param Request $request
     * @param Application $app
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function processUpdateAction(Request $request, Application $app)
    {
        // test if 'username' stored in session ...
        $username = getAuthenticatedUserName($app);

        // check we are authenticated --------
        $isAuthenticated = (null != $username);
        if(!$isAuthenticated)
        {
            // not authenticated, so redirect to LOGIN page
            return $app->redirect('/login');
        }

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_NUMBER_INT);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);

        $user = new User();
        $user->setId($id);
        $user->setUsername($username);
        $user->setRole($role);
        $user->setEmail($email);

        $updateSuccess = User::update($user);

        if($updateSuccess)
        {
            // store username into args array
            $argsArray = array('username' => $username);

            // render (draw) template
            $templateName = 'admin/profile';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);
        }
        else
        {
            // store username into args array
            $argsArray = array('username' => $username,'errorMessage' => 'It didnt updtae');

            // render (draw) template
            $templateName = 'admin/profile';
            return $app['twig']->render($templateName . '.html.twig', $argsArray);
        }
    }
}