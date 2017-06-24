<?php namespace App\Http\Controllers;

use App\Events\StudentWasCreated;
use App\Jobs\SendReminderEmail;
use App\Student;
use App\User;
use Carbon\Carbon;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        echo 'NOT....iiis it done???';
	echo 'surmount with jenkins testing';
        $this->middleware('auth');
    }

    /**
     * Show the application home page to the user.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        //\Event::fire(new StudentWasCreated(Student::find(9)));

        $title = \Lang::get('title.home_page');

        return view('home', compact('title'));
    }
}
