<?php
class StockController extends CController
{
    
    public function actions()
    {
        return array(
            'quote'=>array(
                'class'=>'CWebServiceAction',
                 //'classMap'=>array('ActiveModules'=>'ActiveModules')
            ),
        );
    }
    /**
     * @param string the symbol of the stock
     * @return string the stock price
     * @param string $v hashup
     * @soap
     * http://www.yiiframework.com/doc/guide/1.1/en/topics.webservice
     */
    
    /*public function getPrice($symbol)
    {
        $prices=array('IBM'=>'9vg', 'GOOGLE'=>'350 cvb');
        return isset($prices[$symbol])?$prices[$symbol]:0;
        
   
    }*/
    
    
    public function getActiveModules($client_id){
        
        
        $modules = array('1'=>'club','2'=>'inventory','3'=>'crm','4'=>'golf','5'=>'site configuration','6'=>'spa');
        
        $client_modules = array($this->hashUp('test_client_id') =>array('1'=>$this->hashUp('club'),'2'=>$this->hashUp('crm'),'3'=>$this->hashUp(strtotime(date('d-m-Y')))));
        
        
        return isset($client_modules[$client_id])?CJSON::encode($client_modules[$client_id]):'-1';
        
        /*
        if(isset($client_modules[$client_id])){
            return CJSON::encode($client_modules[$client_id]);
        }
        
        return 'bad';
         * *
         */
        
        
    }
    
    /**
     * @param string the symbol of the stock
     * @return string the stock price
     * @soap
     */
    public function hashUp($v){
        return hash('md5',$v);
        //return $v;
    }
}
?>
