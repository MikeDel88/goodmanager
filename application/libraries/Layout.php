<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Layout
 * Le Layout de l'application
 */
class Layout
{
    private $CI;
    private $var = array();
    private $theme = "";
    
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->var['output'] = '';
        $this->var['title'] = '';
        $this->var['css'] = '';
        $this->var['js'] = '';
        $this->var['page'] = '';
        $this->var['message'] = '';
    }

    public function view($name, $data = array())
    {
        $this->var['output'] .= $this->CI->load->view($name, $data, true);

        $this->CI->load->view("../views/{$this->theme}.php", $this->var);
    }

    public function views($name, $data = array())
    {
        $this->var['output'] .= $this->CI->load->view($name, $data, true);
        return $this;
    }

    /*public function debug($str) {
        if(!isset($this->var['debug']) && ENVIRONMENT!='production') {
            if(is_array($str)){
            $str = print_r($str, true);
            }
            $this->var['debug'] = '<pre>'.print_r($str, true).'</pre>';
        } elseif(ENVIRONMENT!='production'){
            $this->var['debug'] .= '<pre>'.print_r($str, true).'</pre>';
        }
        return true;
    }*/

    public function set_theme($theme)
    {
        if (is_string($theme) and !empty($theme) and file_exists("./application/views/$theme.php")) {
            $this->theme = $theme;
            return true;
        }
        return false;
    }

    public function set_title($title)
    {
        if (is_string($title) and !empty($title)) {
            $this->var['title'] = $title;
            return true;
        }
        return false;
    }

    public function set_css($css)
    {
        if (is_string($css) and !empty($css)) {
            $this->var['css'] = $css;
            return true;
        }
        return false;
    }


    public function set_js($js)
    {
        if (is_string($js) and !empty($js)) {
            $this->var['js'] = $js;
            return true;
        }
        return false;
    }

    public function set_page($page)
    {
        if (is_string($page) and !empty($page)) {
            $this->var['page'] = $page;
            return true;
        }
        return false;
    }

    public function set_message($message)
    {
        if (is_string($message) and !empty($message)) {
            $this->var['message'] = $message;
            return true;
        }
        return false;
    }

    // public function add_css_files($css_files) {
    //     if(is_array($css_files)) {
    //         foreach($css_files as $path){
    //         $this->var['css'][] = $path;
    //     }
    //     return true;
    //     }
    //     return false;
    // }

    // public function add_js_files($js_files) {
    //     if(is_array($js_files)) {
    //         foreach($js_files as $path){
    //         $this->var['js'][] = $path;
    //     }
    //     return true;
    //     }
    //     return false;
    // }

    public function set_header($header)
    {
        if (is_string($header)) {
            $this->var['header'] = $header;
            return true;
        }
        return false;
    }
}
