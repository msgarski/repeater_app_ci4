<?php

namespace App\Controllers;

use App\Controllers\Porch;
class Course extends BaseController
{
    private $courseModel;

    public function __construct()
    {
        $this->courseModel = service('courseModel');
    }

    public function newCourse()
    {
        return view('Course/new_view');
    }

    public function createCourse()
    {
        $user_id = session()->get('user_id');

        $course = $this->request->getPost();

        $course += ['user_id' => $user_id];

        if ($this->courseModel->insert($course)) 
        {          
            // tu trzeba wywołać metodę z innego kontrolera
            // bo muszę wrócić do widoku okna głównego z kursami      
            $porch = new Porch();

            return $porch->getInto();
        } 
        else 
        {
            return redirect()->back()
                             ->with('errors', $this->courseModel->errors())
                             ->with('warning', 'Nieprawidłowe dane')
                             ->withInput();
        }
    }

    public function getInsideCourse($courseId)
    {
        /*
        *   method for conveying specific course data (found by courseId), 
        *   to this course view
        */
        $lessonModel = service('lessonModel');

        $courseInfo = $this->courseModel->getCourseByCourseId($courseId);

        $allLessons = $lessonModel->getAllLessonsByCourseId($courseId);

        return view('Course/course_view', ['courseInfo' => $courseInfo,
                                            'lessons'   => $allLessons
        ]);
    }


    public function proba()
    {
        $wyn = ['score' => 'robert'];
        return $this->response->setJSON($wyn);
    }
}