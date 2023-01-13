<?php 

namespace App\Controllers;


class Porch extends BaseController
{
    private $courseModel;

    public function __construct()
    {
        $this->courseModel = service('courseModel');
    }

    public function index()
    {

    }

    public function repeatShortly()
    {
        return view('Repeat/repetition_view');
    }

    public function tasks()
    {
        return view('Tryouts/main_view');
    }

    public function getInto()
    {
        /*
        *   This method conveys info about user's courses to main view
        *   
        */
        if(session()->has('user_id'))
        {
            $data = $this->courseModel->getAllCoursesByUserId(session()->get('user_id'));
            //dd($data);
            
            return view('Main/main_view', ['courses' => $data]);
        }
        else
        {
            return null;
        }
    }
}