<?php

namespace App\Libraries;

class MassCardInput
{
    public function cardsInputFormatting($cardsAsString, $lineDelimiter = "\n", $colsDelimiter = "\t")
    {
        /*
        * function, which is used for transferring card's data from html form, to row table.
        * by now: for multiple input way
        *
        * In future: In both: single and multiple input manner
        *
        */
        //todo delimitery docelowo zalezne od wprowadzonej wartości w formularzu

        //! tu będę wpisywał nazwy kolejnych pól do wprowadzenia do tabeli:
        $parts = ['question', 'answer', 'pronounciation', 'sentence'];

        $score = [];
        
        $k = 0;

        $rows = explode($lineDelimiter, $cardsAsString);

        foreach($rows as $row)
        {
            $words = explode($colsDelimiter, $row);

            $word = [];

            //! możzna by jeszcze sprawdzać, czy nie ma " "...
            
            for($i=0; $i<sizeof($words); $i+=1)
            {
                $word[$parts[$i]] =  $words[$i];
            }
            array_push($score, $word);
        
            $k += 1;
        }
        return $score;
    }

    public function createCards($score, $lesson_id, $priority = 0)
    {
        $model = service('cardModel');

        array_pop($score);

        foreach($score as &$card)
        {
            
            $card['lesson_id'] = $lesson_id;
            $card['priority'] = $priority;
        }

        if ($model->insertBatch($score)) {
            return true;
        } 
        else 
        {
            return false;
        }
    }
}
