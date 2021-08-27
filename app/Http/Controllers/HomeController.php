<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use App\Plugindownload;
use App\Pluginversion;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        
        $startdate = $request->startdate;
        $enddate = $request->enddate;
        $pluginid = $request->pluginname;
        

        if(!empty($startdate) && $pluginid == 1){
            $wocommercedownlaodinfo = Plugindownload::where('_pluginname_id',1)->where('_download_date','>=',$startdate)->where('_download_date','<=',$enddate)->select('_download_date','_totaldownload')->get();
            
            $wocommercedownloadkey = array();
            $inactivedownload = array();
            $wocommercedownloadvalue = array();
            foreach($wocommercedownlaodinfo as $wocommercedownlaod_info){
                array_push($inactivedownload , 0);
                array_push($wocommercedownloadkey,$wocommercedownlaod_info->_download_date);
                array_push($wocommercedownloadvalue,$wocommercedownlaod_info->_totaldownload);
            }

            $downloadkey = json_encode($wocommercedownloadkey);
            $downloadvalue = json_encode($wocommercedownloadvalue);
            $inactive = json_encode($inactivedownload);
            $name = "WooCommerce";
            $start_date = $startdate;
            $end_date = $enddate;
        }else if(!empty($startdate) && $pluginid == 2){


            $contactformdownlaodinfo = Plugindownload::where('_pluginname_id',2)->where('_download_date','>=',$startdate)->where('_download_date','<=',$enddate)->select('_download_date','_totaldownload')->get();
            
            $contactformdownlaodkey = array();
            $contactformdownlaodvalue = array();
            $inactivedownload = array();
            foreach( $contactformdownlaodinfo as $contactformdownlaod_info){
                array_push($inactivedownload , 0);
                array_push($contactformdownlaodkey,$contactformdownlaod_info->_download_date);
                array_push($contactformdownlaodvalue,$contactformdownlaod_info->_totaldownload);
            }
            $inactive = json_encode($inactivedownload);
            $downloadkey = json_encode($contactformdownlaodkey);
            $downloadvalue = json_encode($contactformdownlaodvalue);
            $name = "Contact Form 7";
            $start_date = $startdate;
            $end_date = $enddate;

        }

        else if(!empty($startdate) && $pluginid == 3){
            $classiceditordownlaodinfo = Plugindownload::where('_pluginname_id',3)->where('_download_date','>=',$startdate)->where('_download_date','<=',$enddate)->select('_download_date','_totaldownload')->get();
            $inactivedownload = array();
            $classiceditordownlaodkey = array();
            $classiceditordownlaodvalue = array();
            foreach( $classiceditordownlaodinfo as $classiceditordownlaod_info){
                array_push($inactivedownload , 0);
                array_push($classiceditordownlaodkey,$classiceditordownlaod_info->_download_date);
                array_push($classiceditordownlaodvalue,$classiceditordownlaod_info->_totaldownload);
            }
            $inactive = json_encode($inactivedownload);
            $downloadkey = json_encode($classiceditordownlaodkey);
            $downloadvalue = json_encode($classiceditordownlaodvalue);
            $name = "Classic Editor";
            $start_date = $startdate;
            $end_date = $enddate;

        }

        else if(!empty($startdate) && $pluginid == 4){


            $wordpressseodownlaodinfo = Plugindownload::where('_pluginname_id',4)->where('_download_date','>=',$startdate)->where('_download_date','<=',$enddate)->select('_download_date','_totaldownload')->get();
            
            $wordpressseodownlaodkey = array();
            $wordpressseodownlaodvalue = array();
            $inactivedownload = array();
            foreach($wordpressseodownlaodinfo as $wordpressseodownlaod_info){
                array_push($inactivedownload , 0);
                array_push($wordpressseodownlaodkey,$wordpressseodownlaod_info->_download_date);
                array_push($wordpressseodownlaodvalue,$wordpressseodownlaod_info->_totaldownload);
            }

            $downloadkey = json_encode($wordpressseodownlaodkey);
            $inactive = json_encode($inactivedownload);
            $downloadvalue = json_encode($wordpressseodownlaodvalue);
            $name = "Yoast Seo";
            $start_date = $startdate;
            $end_date = $enddate;

        }else{
            
            $downloadkey = $this->api_get_redis("wocommercedownloadkey");
            $downloadvalue = $this->api_get_redis("wocommercedownloadvalue");
            $name = "WooCommerce";
            $start_date = "";
            $end_date = ""; 
            $countinactive = count(json_decode($downloadkey,true));
     
            $inactivedownload = array();
            for($i= 0; $i < $countinactive;$i++){
               array_push($inactivedownload , 0); 

            }
            $inactive = json_encode($inactivedownload);
            
            
        }    

        return view('home',compact(['downloadkey','downloadvalue','name','start_date','end_date','pluginid','inactive']));
    }



    function api_set_redis($key, $value) {
        $redis = Redis::connection();
        if ($key) {
            $redis->set($key, $value); 
        }
    }
   
    function api_get_redis($key) {
        if (Redis::exists($key)) {
                $value = Redis::get($key);
                return $value;
            }
            else {
                return "";
            }
        }

    function remove_redis($key) {
            if (Redis::exists($key)) {
                Redis::del($key);
            }

        }

   
    public function plugininfo($plugin){
        if($plugin == 'woocommerce'){
            $downloadkey = $this->api_get_redis("wocommercedownloadkey");
            $downloadvalue = $this->api_get_redis("wocommercedownloadvalue");
            $versionkey = $this->api_get_redis("versionwoocommercekey");
            $versionvalue = $this->api_get_redis("versionwoocommercevalue");
            $info = json_decode($this->api_get_redis("woocommerceinfo"),true);
            $pluginname = "WooCommerce";
            $yesterdaydownload = Plugindownload::where('_pluginname_id',1)->orderBy("id", "desc")->take(1)->get()->sum('_totaldownload');
            $lastsevendaydownload = Plugindownload::where('_pluginname_id',1)->orderBy("id", "desc")->take(7)->get()->sum('_totaldownload');
            
            $alltimedownload = Plugindownload::where('_pluginname_id',1)->sum('_totaldownload');
        }
        if($plugin == 'contact-form-7'){
            $downloadkey = $this->api_get_redis("downloadcontactformkey");
            $downloadvalue = $this->api_get_redis("downloadcontactformvalue");
            $versionkey = $this->api_get_redis("versioncontactformkey");
            $versionvalue = $this->api_get_redis("versioncontactformvalue");
            $pluginname = "Contact Form 7";
            $info = json_decode($this->api_get_redis("contactforminfo"),true);
            $yesterdaydownload = Plugindownload::where('_pluginname_id',2)->orderBy("id", "desc")->take(1)->get()->sum('_totaldownload');
            $lastsevendaydownload = Plugindownload::where('_pluginname_id',2)->orderBy("id", "desc")->take(7)->get()->sum('_totaldownload');
            $alltimedownload = Plugindownload::where('_pluginname_id',2)->sum('_totaldownload');
        }
        if($plugin == 'classic-editor'){
            $downloadkey  = $this->api_get_redis("downloadclassiceditorkey");
            $downloadvalue = $this->api_get_redis("downloadclassiceditorvalue");
            $versionkey = $this->api_get_redis("versionclassiceditorkey");
            $versionvalue = $this->api_get_redis("versionclassiceditorvalue");
            $pluginname = "Classic Editor";
            $info = json_decode($this->api_get_redis("classiceditorinfo"),true);
            $yesterdaydownload = Plugindownload::where('_pluginname_id',3)->orderBy("id", "desc")->take(1)->get()->sum('_totaldownload');
            $lastsevendaydownload = Plugindownload::where('_pluginname_id',3)->orderBy("id", "desc")->take(7)->get()->sum('_totaldownload');
            $alltimedownload = Plugindownload::where('_pluginname_id',3)->get()->sum('_totaldownload');
        }
        if($plugin == 'yoast-seo'){
            $downloadkey = $this->api_get_redis("downloadwordpressseokey");
            $downloadvalue = $this->api_get_redis("downloadwordpressseovalue");
            $versionkey = $this->api_get_redis("versionwordpressseokey");
            $versionvalue = $this->api_get_redis("versionwordpressseovalue");
            $pluginname = "Yoast Seo";
            $info = json_decode($this->api_get_redis("yoastseoinfo"),true);
            $yesterdaydownload = Plugindownload::where('_pluginname_id',4)->orderBy("id", "desc")->take(1)->get()->sum('_totaldownload');
            $lastsevendaydownload = Plugindownload::where('_pluginname_id',4)->orderBy("id", "desc")->take(7)->get()->sum('_totaldownload');
            $alltimedownload = Plugindownload::where('_pluginname_id',4)->get()->sum('_totaldownload');
        }
        
        
        return view('plugin-info',compact(['downloadkey','downloadvalue','versionkey','versionvalue','pluginname','yesterdaydownload','lastsevendaydownload','alltimedownload','info']));
    }
   
}
