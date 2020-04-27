<?php

namespace App\Nova\Metrics;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Value;
use Facilitador\Models\Post;

class NewUsers extends Value
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function calculate(Request $request)
    {

        //The average method may be used to calculate the average of a given column compared to the previous time interval / range:
        //return $this->average($request, Post::class, 'word_count');

        // The sum method may be used to calculate the sum of a given column compared to the previous time interval / range:
        // return $this->sum($request, Order::class, 'price');



        return $this->count($request, config('sitec.core.models.user', \App\Models\User::class));
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
            30 => '30 Days',
            60 => '60 Days',
            365 => '365 Days',
            'MTD' => 'Month To Date',
            'QTD' => 'Quarter To Date',
            'YTD' => 'Year To Date',
        ];
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'new-users';
    }
}
