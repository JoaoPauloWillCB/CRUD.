<?php

namespace App\Classes;

use \Rain\Tpl;

class Page
{
    
    private $tpl;

    private $options = array();

    private $defaults = array(
        'header'=>true,
        'footer'=>true,
        'data'=>array()
    );
    
    public function __construct($opts = array(), $tpl_dir = '/views/')
    {
        
        $this->options = array_merge($this->defaults, $opts);
        
        if(!is_dir('views-cache')){
            
            mkdir('views-cache');

        }
        
        $config = array(
            'tpl_dir' => $_SERVER['DOCUMENT_ROOT'] . $tpl_dir,
            'cache_dir' => $_SERVER['DOCUMENT_ROOT'] . '/../views-cache/',
            'debug' => false
        );
        
        Tpl::configure($config);

        $this->tpl = new Tpl;

        $this->setData($this->options['data']);

        if($this->options['header'] == true){

            $this->tpl->draw('header');

        }
        
    }

    private function setData($data=array())
    {

        foreach($data as $key => $value){

            if(is_array($value)){

                foreach($value as $k => $v){

                    if(is_array($v)){

                        foreach($v as $kk => $vv){

                            if($vv === NULL){

                                $v[$kk] = '';

                            }

                        }

                        $value[$k] = $v;

                    } else if($v === NULL){

                        $value[$k] = '';

                    }

                }

            }
            
            $this->tpl->assign($key, $value);
            
        }

    }

    public function setTpl($name, $data=array(), $returnHTML = false)
    {
        
        $this->setData($data);
        
        return $this->tpl->draw($name, $returnHTML);
        
    }

    public function __destruct()
    {

        if($this->options['footer'] == true){

            $this->tpl->draw('footer');

        }

    }

}