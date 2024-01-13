<?php

namespace App\Traits;

trait FeedbackMessages 
{
    protected function success($message, $data = null)
    {
        return (object)['success' => true, 'message' => $message, 'data' => $data];
    }

    protected function error($message, $data = null)
    {
        return (object)['success' => false, 'message' => $message, 'data' => $data];
    }
}