<?php

namespace App\Controllers;

class Study extends BaseController
{
    public function presentation($courseId, $userId)
    {
        $data = [];
        return view('Presentation/presentation_view', $data);
    }

}