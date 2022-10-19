<?php
    use Jenssegers\Blade\Blade;
    
    if(!function_exists('blade')){
        function blade($view, $data = []){
            $path = APPPATH.'Views';
            $blade = new Blade($path, $path.'/cache');
            return $blade->render($view, $data);
        }
    }