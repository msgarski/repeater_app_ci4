<?php

if(!function_exists('current_user'))
{
    function current_user()
    {
        $authentic = service('authentication');

        return $authentic->getCurrentUser();

        
    }
}