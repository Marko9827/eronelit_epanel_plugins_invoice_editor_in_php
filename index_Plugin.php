<?php
return 'einvoice';
class einvoice extends Eronelit__dash_plugin
{
    protected $name, $description, $image, $id, $url, $lang;

    private $DIR;

    public function einvoice($api)
    {
        parent::__construct($api);

        $this->conf();
    }



    public function conf()
    {
        $this->setDIR(__DIR__);
    }

    public function call()
    {
        $this->api->call('Called from Weather');
    }
    public function source($js)
    {
        $this->api->source("einvoice", $js);
    }

    public function ajax($content, $id)
    { 
        file_put_contents($this->getDIR() . "../data/index_$id.html", $content, LOCK_EX);
    }


    public function page()
    {
        include "dynamic/page.php";
    }

    public function config($name)
    {

        $this->api->config(__DIR__, $name);
    }


    public function whatever()
    {
        echo "Doing whatever from Whatever<br>\n";
    }

    public function time_api()
    {
        $this->api->TIME();
    }

    /**
     * Get the value of DIR
     */
    public function getDIR()
    {
        return $this->DIR;
    }

    /**
     * Set the value of DIR
     *
     * @return  self
     */
    public function setDIR($DIR)
    {
        $this->DIR = $DIR;

        return $this;
    }
}
