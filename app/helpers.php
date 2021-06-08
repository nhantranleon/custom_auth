<?php
use Illuminate\Support\Str;
//define permission for user interactive with post
define('PERMISSION_FOR_USER_HAVE_NOTHING_ON_POST', 0);
define('PERMISSION_FOR_USER_ONLY_VIEW_ON_POST', 1);
define('PERMISSION_FOR_USER_CAN_VIEW_AND_INTERACTIVE_ON_THEIR_POST', 2);
define('PERMISSION_FOR_USER_CAN_DO_EVERYTHING_ON_POST', 3);

define('NUMBER_OF_PERPAGE_POST_LIST', 30);

if (! function_exists('plural_from_model')) {
    function plural_from_model($model)
    {
        $plural = Str::plural(class_basename($model));

        return Str::kebab($plural);
    }
}
