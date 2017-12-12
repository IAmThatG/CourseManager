<?php
    /**
     * Created by PhpStorm.
     * User: GABRIEL
     * Date: 9/9/2016
     * Time: 4:25 PM
     */
    $path = 'classes/'. PATH_SEPARATOR .'../classes/';

    set_include_path(get_include_path() . PATH_SEPARATOR . $path);

    defined('SITE_ROOT')           ? null : define('SITE_ROOT', "/course_manager/");
    defined('SITE_LOC')            ? null : define('SITE_LOC','C:/wamp/www/course_manager/');
    defined('PUBLIC_LOC')          ? null : define('PUBLIC_LOC', 'C:/wamp/www/course_manager/public/');
    defined('INC_PATH')            ? null : define('INC_PATH', "/");
    defined('PUBLIC_PATH')         ? null : define('PUBLIC_PATH', "/course_manager/public/");
    defined('PROFILE_PIC_PATH')    ? null : define('PROFILE_PIC_PATH','C:/wamp/www/course_manager/public/assets/profile_pic/');
    defined('PROFILE_PIC_URL')     ? null : define('PROFILE_PIC_URL','http://localhost/course_manager/public/assets/profile_pic/');
    defined('COURSE_PIC_PATH')     ? null : define('COURSE_PIC_PATH','C:/wamp/www/course_manager/public/assets/course_pic/');
    defined('COURSE_PIC_URL')      ? null : define('COURSE_PIC_URL','/course_manager/public/assets/course_pic/');
    defined('RESOURCE_PATH')       ? null : define('RESOURCE_PATH','C:/wamp/www/course_manager/public/assets/resources/');
    defined('RESOURCE_URL')        ? null : define('RESOURCE_URL','/course_manager/public/assets/resources/');
    defined('ALLOWED_IMAGES')      ? null : define('ALLOWED_IMAGES',':jpeg:jpg:png:');
    defined('MAX_IMAGE_SIZE')      ? null : define('MAX_IMAGE_SIZE','1024000');
    defined('MAX_RESOURCE_SIZE')   ? null : define('MAX_DOC_SIZE', '10240000');
    defined('PROFILE_PIC_DEFAULT') ? null : define('PROFILE_PIC_DEFAULT','default_large.png');
    defined('COURSE_PIC_DEFAULT')  ? null : define('COURSE_PIC_DEFAULT', 'defbookcover.jpg');

    defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
//
//    defined('SITE_ROOT')  ? null : define('SITE_ROOT', 'C:'.DS.'wamp'.DS.'www'.DS.'course_manager');
//    defined('INC_PATH')   ? null : define('INC_PATH', SITE_ROOT.DS.'includes');
//    defined('CLASS_PATH') ? null : define('CLASS_PATH', SITE_ROOT.DS.'classes');
//    defined('CTRL_PATH')  ? null : define('CTRL_PATH', SITE_ROOT.DS.'controllers');
//    defined('MODEL_PATH') ? null : define('MODEL_PATH', SITE_ROOT.DS.'models');
//    //load config file first
//    require_once (INC_PATH.DS."config.php");
//    //load basic functions next so that everything after can use them
//    /** @noinspection PhpIncludeInspection */
//    require_once (CLASS_PATH.DS."functions.php");
//    //load core objects
//    /** @noinspection PhpIncludeInspection */
//    require_once (CLASS_PATH.DS."database.php");
//    /** @noinspection PhpIncludeInspection */
//    require_once (CLASS_PATH.DS."session.php");
//    /** @noinspection PhpIncludeInspection */
//    require_once (CLASS_PATH.DS."enroled.php");
//    //require_once (LIB_PATH.DS."database_objects.php");
//    //load database related classes
//    /** @noinspection PhpIncludeInspection */
//    require_once (CLASS_PATH.DS."admin.php");
//    /** @noinspection PhpIncludeInspection */
//    require_once (CLASS_PATH.DS."lecturer.php");
//    /** @noinspection PhpIncludeInspection */
//    require_once (CLASS_PATH.DS."student.php");
//    //load controllers
//    /** @noinspection PhpIncludeInspection */
//    require_once (CTRL_PATH.DS."lecturer_controller.php");
//    /** @noinspection PhpIncludeInspection */
//    require_once (CTRL_PATH.DS."student_controller.php");
//    //load models
//    /** @noinspection PhpIncludeInspection */
//    require_once (MODEL_PATH.DS."lecturer_model.php");
//    /** @noinspection PhpIncludeInspection */
//    require_once (MODEL_PATH.DS."student_model.php");
