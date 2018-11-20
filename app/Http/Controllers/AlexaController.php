<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\APIs\UrlInfo;
use App\Network;
use App\Metric_description;
use App\Account;
use App\Company;
use App\Metric_value;

class AlexaController extends Controller
{
    //

    public function addAlexaData(Company $company) {
        
        // Add alexa data for given company to the data base
        $companyname = $company->name;
        $companywebsite = $company->website;
        $companyid = $company->id;
        $urlInfo = new UrlInfo(env('ALEXA_ACCESS_KEY_ID'),env('ALEXA_SECRET_ACCESS_KEY'), $companywebsite);
        $valuesfromapi=$urlInfo->getUrlInfo();
        
        echo "<br> Here are metric values from API <br>";   
        print_r($valuesfromapi);

    
        // Fetch Alexa network id from db
        $rs = Network::where('name','like','Alexa')->get();
        $alexaid=$rs[0]->id;
        
        
        // For each metric value returned by alexa api do -->
        foreach($valuesfromapi as $k => $v) {
            
            if (empty($v)) {
                echo "<br> Found no value for {$k}";
            } else {

                // Get metric_description id
                $rs = Metric_description::where('network_id','=',$alexaid)->where('description','like',$k)->get();
                if (count($rs) == 0) {
                    // No record for metric description exists, create a new entry and get it's id
                    $metric_desc_id = Metric_description::create(['description' => $k, 'network_id' => $alexaid, 'endpoint' => '']) ->id;
                } else {
                    // Metric description exists in the table, get the id for the metric description
                    $metric_desc_id = $rs[0]->id;
                }

                // Get account id 
                $rs = Account::where('network_id','=',$alexaid)->where('company_id','=',$companyid)->get();
                if (count($rs) == 0) {
                    // No record for metric description exists, create a new entry and get it's id
                    $account_id = Account::create(['handle' => $companywebsite, 'company_id' => $companyid, 'network_id' => $alexaid])->id;
                } else {
                    // Metric description exists in the table, get the id for the metric description
                    $account_id = $rs[0]->id;
                }


                // Add metric value to metric_values table

                // If metric value for today's date already exist in the DB then delete it
                Metric_value::where('date','=',date("Y-m-d"))->where('account_id','=',$account_id)->where('metric_description_id','=',$metric_desc_id)->delete();
        
                // Push latest metric value for today's date in the DB
                Metric_value::create(['date' => date("Y-m-d"), 'value' => $v, 'account_id' => $account_id, 'metric_description_id'  => $metric_desc_id]);
            
            }
        }
    
        echo "<br>Finished adding Alexa values to DB<br><br>";
    }



    public function index() {
        
        $allcompanies = Company::all();

        // Fetch Alexa data using API and add to DB for each company
        foreach($allcompanies as $onecompany){
            echo "Fetching Alexa values and adding to DB for ".$onecompany->name."<br>";
            self::addAlexaData($onecompany);
        }
    }

}


