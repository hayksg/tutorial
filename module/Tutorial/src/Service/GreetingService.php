<?php

namespace Tutorial\Service;

use Tutorial\Service\GreetingServiceInterface;

class GreetingService implements GreetingServiceInterface
{
    public function getGreeting()
    {
        date_default_timezone_set('Asia/Yerevan');
        $output = '';
        $hour = date('H');

        if ($hour > 5 && $hour <= 11) {
            $output = 'Good morning';
        } elseif ($hour > 11 && $hour <= 17) {
            $output = 'Good day';
        } elseif ($hour > 17 && $hour <= 23) {
            $output = 'Good evening';
        } else {
            $output = 'Good night';
        }

        return $output;
    }
}
