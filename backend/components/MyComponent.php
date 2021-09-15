<?php

namespace backend\components;

use Exception;
use Yii;
use yii\base\Component;

class MyComponent extends Component
{
    public function hello()
    {
        return "Your first component";
    }

    function currencyConverter($currency_from, $currency_to, $currency_input) 
    {
        
        if( (Yii::$app->cacheApp->get('from') == $currency_from  && 
            Yii::$app->cacheApp->get('to') == $currency_to) )
        {
            return (float)Yii::$app->cacheApp->get('rate') * $currency_input;
        }
        elseif(Yii::$app->cacheApp->get('to') == $currency_from  && 
        Yii::$app->cacheApp->get('from') == $currency_to)
        {
            return (float)(1/Yii::$app->cacheApp->get('rate')) * $currency_input;
        }
        else
        {
            $req_url = 'https://v6.exchangerate-api.com/v6/a445f6904fec2741506efc30/pair/'
                        .$currency_from.'/'.$currency_to;
            $response_json = file_get_contents($req_url);

            // Continuing if we got a result
            if(false !== $response_json) 
            {
                // Try/catch for json_decode operation
                try 
                {
                    // Decoding
                    $response = json_decode($response_json);
                    
                    // Check for success
                    if('success' === $response->result) 
                    {
                        $rate = $response->conversion_rate;

                    }

                }
                catch(Exception $e) 
                {
                    // Handle JSON parse error...
                }

            }
            // $yql_base_url = "http://query.yahooapis.com/v1/public/yql";
            // $yql_query = 'select * from yahoo.finance.xchange where pair in ("' . $currency_from . $currency_to . '")';
            // $yql_query_url = $yql_base_url . "?q=" . urlencode($yql_query);
            // $yql_query_url .= "&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys";
            // $yql_session = curl_init($yql_query_url);
            // curl_setopt($yql_session, CURLOPT_RETURNTRANSFER, true);
            // $yqlexec = curl_exec($yql_session);
            // $yql_json =  json_decode($yqlexec, true);
            //$rate = $yql_json['query']['results']['rate']['Rate'];
            
            Yii::$app->cacheApp->set('from',$currency_from);
            Yii::$app->cacheApp->set('to',$currency_to);
            Yii::$app->cacheApp->set('rate',$rate);
            $currency_output = (float) $currency_input * $rate;
            
            return $currency_output;
        }
    }

}


?>