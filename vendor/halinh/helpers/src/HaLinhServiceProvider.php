<?php
/**
 * Created By PhpStorm
 * User: trungphuna
 * Date: 5/10/24
 * Time: 1:36 AM
 */

namespace Halinh\Helpers;
use \Illuminate\Support\ServiceProvider;

class HaLinhServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $modulePath = __DIR__."/";
        // boot all helpers
        if (\File::exists($modulePath . "Helpers")) {
            $helper_dir = \File::allFiles($modulePath . "Helpers");
            // Khai báo helpers
            foreach ($helper_dir as $key => $value) {
                $file = $value->getPathName();
                require $file;
            }
        }
    }

    public function register()
    {

    }
}