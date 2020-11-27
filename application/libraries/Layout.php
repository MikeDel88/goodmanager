<?
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Layout
 * Le Layout de l'application
 */
class Layout {
    
    private $CI;
    private $var = array();
    private $theme = "";
    
    public function __construct() {

        $this->CI =& get_instance();
        $this->var['output'] = '';
        $this->var['title'] = '';
        $this->var['css'] = array();
        $this->var['js'] = array(); 
    }

    public function view($name, $data = array()) {

        $this->var['output'] .= $this->CI->load->view($name, $data, true);
        

        $this->CI->load->view('../views/layout.php', $this->var);
    }

    public function views($name, $data = array()) {
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

    public function set_theme($theme) {
        if(is_string($theme) AND !empty($theme) AND file_exists('./application/views/'.$theme.'/layout.php')) {
            $this->theme = $theme;
            return true;
        }
        return false;
    }

    public function set_title($title) {
        if(is_string($title) AND !empty($title)) {
            $this->var['title'] = $title;
        return true;
        }
        return false;
    }

    public function add_css_files($css_files) {
        if(is_array($css_files)) {
            foreach($css_files as $path){
            $this->var['css'][] = $path;
        }
        return true;
        }
        return false;
    }

    public function add_js_files($js_files) {
        if(is_array($js_files)) {
            foreach($js_files as $path){
            $this->var['js'][] = $path;
        }
        return true;
        }
        return false;
    }

    public function set_sub_id($sub_id) {
        if($sub_id>0) {
            $this->var['sub_id'] = $sub_id;
            return true;
        }
        return false;
    }

    public function set_datas_missing($data) {
        $this->var['datas_missing'] = $data;
        return true;
    }

    public function set_header($header) {
        if(is_string($header)) {
            $this->var['header'] = $header;
            return true;
        }
        return false;
    }

    public function set_active_menu($str, $root=''){
        if(is_string($str)) {
            $this->var['active_menu'] = $str;
            if(is_string($root) && !empty($root)){
                $this->var['toggle_menu'] = $root;
            }
            return true;
        }
        return false;
    }

    public function categories_list($categories){
        if(is_array($categories)) {
            $this->var['cat_list'] = $categories;
        }
        return false;
    }

    public function set_maintenance($bool){
        $this->var['maintenance'] = $bool;
    }

    public function set_modules_menu($module_list){
        $this->var['modules'] = $module_list;
    }
}