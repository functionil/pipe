<?php

use functionil\pipe\pipeline;
use functionil\pipe\placeholder;

if (!defined('_')) {
    define('_', new placeholder);
}

if (!function_exists('pipe')) {
    /**
     * Construct a new `Pipe` instance.
     *
     * @param mixed $subject
     * @return pipeline
     */
    function pipe(mixed $subject): pipeline {
        return pipeline::new($subject);
    }
}

if (!function_exists('take')) {
    /**
     * Construct a new `Pipe` instance.
     *
     * @param mixed $subject
     * @return pipeline
     */
    function take(mixed $subject): pipeline {
        return pipeline::new($subject);
    }
}