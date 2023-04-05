<?php

namespace App\Helpers;

class StringHelper
{
    public static function generateRandomString($length = 10): string
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function replacePattern($pattern, $variables): string
    {
        foreach ($variables as $patternKey => $patternValue) {
            $pattern = preg_replace(
                '/' . $patternKey . '/',
                is_array($patternValue) ? implode('<br>', $patternValue) : $patternValue,
                $pattern
            );
        }
        return $pattern;
    }

    public static function currentLanguageDateFormat(string $date): string
    {
        return preg_replace([
            '/January/',
            '/February/',
            '/March/',
            '/April/',
            '/May/',
            '/June/',
            '/July/',
            '/August/',
            '/September/',
            '/October/',
            '/November/',
            '/December/',
            '/Monday/',
            '/Tuesday/',
            '/Wednesday/',
            '/Thursday/',
            '/Friday/',
            '/Saturday/',
            '/Sunday/',
        ], [
            __('January'),
            __('February'),
            __('March'),
            __('April'),
            __('May'),
            __('June'),
            __('July'),
            __('August'),
            __('September'),
            __('October'),
            __('November'),
            __('December'),
            __('Monday'),
            __('Tuesday'),
            __('Wednesday'),
            __('Thursday'),
            __('Friday'),
            __('Saturday'),
            __('Sunday'),
        ], $date);
    }
}
