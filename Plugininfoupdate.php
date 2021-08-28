<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
use App\Plugindownload;
use App\Pluginversion;

class Plugininfoupdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pluginfo:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $downloadwoocommerce = Http::get('http://api.wordpress.org/stats/plugin/1.0/downloads.php?slug=woocommerce');
        $lasttwodownloadwoocommerce = $downloadwoocommerce->json();
        foreach($lasttwodownloadwoocommerce as $key => $value){
            $checkvalue = Plugindownload::where('_download_date',$key)->where('_pluginname_id',1)->first();
            if(empty($checkvalue)){
                Plugindownload::insert(array('_pluginname_id'=>1,"_download_date"=>$key,"_totaldownload"=>$value));
           }
        }
        $wocommercedownload_key = json_encode(array_keys($downloadwoocommerce->json()));
        Cache::put("wocommercedownloadkey",$wocommercedownload_key);
        $wocommerdownload_value = json_encode(array_values($downloadwoocommerce->json()));
        Cache::put("wocommercedownloadvalue",$wocommerdownload_value);


        $versionwoocommerce = Http::get('http://api.wordpress.org/stats/plugin/1.0/woocommerce');
        $lastupdateversionwoocommerce = $versionwoocommerce->json();
        foreach($lastupdateversionwoocommerce as $key => $value){
            $checkversionwoocommerce = Pluginversion::where('_pluginversion',$key)->where('_pluginname_id',1)->first();
           
            if(empty($checkversionwoocommerce)){
                Pluginversion::insert(array('_pluginname_id'=>1,"_pluginversion"=>$key,"_pluginversionuseratio"=>$value));
            }
        }

        $versionwoocommerce_key = json_encode(array_keys($versionwoocommerce->json()));
        Cache::put("versionwoocommercekey",$versionwoocommerce_key);
        $versionwoocommerce_value = json_encode(array_values($versionwoocommerce->json()));
        Cache::put("versionwoocommercevalue",$versionwoocommerce_value );



        $downloadcontactform = Http::get('http://api.wordpress.org/stats/plugin/1.0/downloads.php?slug=contact-form-7');
        $lasttwodownloadcontactform = $downloadcontactform->json();
        foreach($lasttwodownloadcontactform as $key => $value){
           $checkcontactform = Plugindownload::where('_download_date',$key)->where('_pluginname_id',2)->first();
           
           if(empty($checkcontactform)){
                Plugindownload::insert(array('_pluginname_id'=>2,"_download_date"=>$key,"_totaldownload"=>$value));
           }
        }
        $downloadcontactform_key = json_encode(array_keys($downloadcontactform->json()));
        Cache::put("downloadcontactformkey",$downloadcontactform_key);
        $downloadcontactform_value = json_encode(array_values($downloadcontactform->json()));
        Cache::put("downloadcontactformvalue",$downloadcontactform_value);
        

        $versioncontactform = Http::get('http://api.wordpress.org/stats/plugin/1.0/contact-form-7');

        $lastupdateversioncontactform = $versioncontactform->json();
        foreach($lastupdateversioncontactform as $key => $value){
            $checkversioncontactform = Pluginversion::where('_pluginversion',$key)->where('_pluginname_id',2)->first();
           
            if(empty($checkversioncontactform)){
                Pluginversion::insert(array('_pluginname_id'=>2,"_pluginversion"=>$key,"_pluginversionuseratio"=>$value));
           }
        }
        $versioncontactform_key = json_encode(array_keys($versioncontactform->json()));
        Cache::put("versioncontactformkey",$versioncontactform_key);
         $versioncontactform_value = json_encode(array_values($versioncontactform->json()));
        Cache::put("versioncontactformvalue",$versionwoocommerce_value );


        $downloadclassiceditor = Http::get('http://api.wordpress.org/stats/plugin/1.0/downloads.php?slug=classic-editor');

        $lasttwodownloadclassiceditor = $downloadclassiceditor->json();
        foreach($lasttwodownloadclassiceditor as $key => $value){
            $checkclassiceditor = Plugindownload::where('_download_date',$key)->where('_pluginname_id',3)->first();
           
            if(empty($checkclassiceditor)){
                Plugindownload::insert(array('_pluginname_id'=>3,"_download_date"=>$key,"_totaldownload"=>$value));
            }
        }
        $downloadclassiceditor_key = json_encode(array_keys($downloadclassiceditor->json()));
        Cache::put("downloadclassiceditorkey",$downloadclassiceditor_key);
        $downloadclassiceditor_value = json_encode(array_values($downloadcontactform->json()));
        Cache::put("downloadclassiceditorvalue",$downloadclassiceditor_value);



        $versionclassiceditor = Http::get('http://api.wordpress.org/stats/plugin/1.0/classic-editor');
        $lastupdatevversionclassiceditor = $versionclassiceditor->json();
        foreach($lastupdatevversionclassiceditor as $key => $value){
            $checkversionclassiceditor = Pluginversion::where('_pluginversion',$key)->where('_pluginname_id',3)->first();
           
            if(empty($checkversionclassiceditor)){
                Pluginversion::insert(array('_pluginname_id'=>3,"_pluginversion"=>$key,"_pluginversionuseratio"=>$value));
           }
        }
        $versionclassiceditor_key = json_encode(array_keys($versionclassiceditor->json()));
        Cache::put("versionclassiceditorkey",$versionclassiceditor_key);
        $versionclassiceditor_value = json_encode(array_values($versionclassiceditor->json()));
        Cache::put("versionclassiceditorvalue",$versionclassiceditor_value );




        $downloadwordpressseo = Http::get('http://api.wordpress.org/stats/plugin/1.0/downloads.php?slug=wordpress-seo');
        $lasttwodownloadwordpressseo = $downloadwordpressseo ->json();
        foreach($lasttwodownloadwordpressseo as $key => $value){
            $checkwordpressseo = Plugindownload::where('_download_date',$key)->where('_pluginname_id',4)->first();
           
            if(empty($checkwordpressseo)){
                Plugindownload::insert(array('_pluginname_id'=>4,"_download_date"=>$key,"_totaldownload"=>$value));
            }
        }
        $downloadwordpressseo_key = json_encode(array_keys($downloadwordpressseo->json()));
        Cache::put("downloadwordpressseokey",$downloadwordpressseo_key);
        $downloadwordpressseo_value = json_encode(array_values($downloadwordpressseo->json()));
        Cache::put("downloadwordpressseovalue",$downloadwordpressseo_value);



        $versionwordpressseo = Http::get('http://api.wordpress.org/stats/plugin/1.0/wordpress-seo');
        $lastupdatevversionwordpressseo = $versionwordpressseo->json();
        foreach($lastupdatevversionwordpressseo as $key => $value){
            $checkversionwordpressseo = Pluginversion::where('_pluginversion',$key)->where('_pluginname_id',4)->first();
           
            if(empty($checkversionwordpressseo)){
                Pluginversion::insert(array('_pluginname_id'=>4,"_pluginversion"=>$key,"_pluginversionuseratio"=>$value));
           }
        }
        $versionwordpressseo_key = json_encode(array_keys($versionwordpressseo->json()));
        Cache::put("versionwordpressseokey",$versionwordpressseo_key);
        $versionwordpressseo_value = json_encode(array_values($versionwordpressseo->json()));
        Cache::put("versionwordpressseovalue",$versionwordpressseo_value);




        $woocommerceinfo = Http::post('https://api.wordpress.org/plugins/info/1.0/woocommerce.json');
        
        Cache::forget('woocommerce_info');
        Cache::put("woocommerce_info",$woocommerceinfo->json());  

        $contactforminfo = Http::post('https://api.wordpress.org/plugins/info/1.0/contact-form-7.json');
        Cache::forget('contactform_info');
        Cache::put("contactform_info",$contactforminfo->json());

        $classiceditorinfo = Http::post('https://api.wordpress.org/plugins/info/1.0/classic-editor.json');
        Cache::forget('classiceditor_info');
        Cache::put("classiceditor_info",$classiceditorinfo->json());

        $yoastseoinfo = Http::post('https://api.wordpress.org/plugins/info/1.0/wordpress-seo.json');
        Cache::forget('yoastseo_info');
        Cache::put("yoastseo_info",$yoastseoinfo->json());

    }


    function api_set_redis($key, $value) {
        $redis = Redis::connection();
        if ($key) {
            $redis->set($key, $value); 
        }
    }
}
