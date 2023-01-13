<?php 

namespace App\Controllers;

use App\Controllers\Course;
use App\Models\CourseTableModel;

class Lesson extends BaseController
{
    private $lessonModel;

    public function __construct()
    {
        $this->lessonModel = service('lessonModel');
    }

    public function toNewLessonForm($courseId)
    {
        return view('Lessons/newLesson_view', ['courseId' => $courseId]);
    }

    public function create()
    {
        // $lesson posiada też course_id dla tabeli lesson
        // jako ukryte pole formularza tworzenia nowej lekcji
        $lesson = $this->request->getPost();

        $courseId = $lesson['course_id'];

        if ($this->lessonModel->insert($lesson)) 
        {          
            // po sukcesie insertu, wracamy do widoku kursu
            // dla którego dodaliśmy lekcję: 
            // trzeba jednak przekazać course_info, a nie samo course_id 
            // więc najłatwiej wywołać znaną metodę z klasy Course:
            $course = new Course(); 

            return $course->getInsideCourse($courseId);
        } 
        else 
        {
            return redirect()->back()
                             ->with('errors', $this->lessonModel->errors())
                             ->with('warning', 'Nieprawidłowe dane')
                             ->withInput();
        }
        
    }

    public function getInsideLesson($lessonId)
    {
        $lesson = $this->lessonModel->getLessonByLessonId($lessonId);

        return view('Lessons/lesson_view', ['lessonInfo' => $lesson]);
    }

    
}