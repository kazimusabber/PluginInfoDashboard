<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
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
        $this->api_set_redis("wocommercedownloadkey",$wocommercedownload_key);
        $wocommerdownload_value = json_encode(array_values($downloadwoocommerce->json()));
        $this->api_set_redis("wocommercedownloadvalue",$wocommerdownload_value);


        $versionwoocommerce = Http::get('http://api.wordpress.org/stats/plugin/1.0/woocommerce');
        $lastupdateversionwoocommerce = $versionwoocommerce->json();
        foreach($lastupdateversionwoocommerce as $key => $value){
            $checkversionwoocommerce = Pluginversion::where('_pluginversion',$key)->where('_pluginname_id',1)->first();
           
            if(empty($checkversionwoocommerce)){
                Pluginversion::insert(array('_pluginname_id'=>1,"_pluginversion"=>$key,"_pluginversionuseratio"=>$value));
            }
        }

        $versionwoocommerce_key = json_encode(array_keys($versionwoocommerce->json()));
        $this->api_set_redis("versionwoocommercekey",$versionwoocommerce_key);
        $versionwoocommerce_value = json_encode(array_values($versionwoocommerce->json()));
        $this->api_set_redis("versionwoocommercevalue",$versionwoocommerce_value );



        $downloadcontactform = Http::get('http://api.wordpress.org/stats/plugin/1.0/downloads.php?slug=contact-form-7');
        $lasttwodownloadcontactform = $downloadcontactform->json();
        foreach($lasttwodownloadcontactform as $key => $value){
           $checkcontactform = Plugindownload::where('_download_date',$key)->where('_pluginname_id',2)->first();
           
           if(empty($checkcontactform)){
                Plugindownload::insert(array('_pluginname_id'=>2,"_download_date"=>$key,"_totaldownload"=>$value));
           }
        }
        $downloadcontactform_key = json_encode(array_keys($downloadcontactform->json()));
        $this->api_set_redis("downloadcontactformkey",$downloadcontactform_key);
        $downloadcontactform_value = json_encode(array_values($downloadcontactform->json()));
        $this->api_set_redis("downloadcontactformvalue",$downloadcontactform_value);
        

        $versioncontactform = Http::get('http://api.wordpress.org/stats/plugin/1.0/contact-form-7');

        $lastupdateversioncontactform = $versioncontactform->json();
        foreach($lastupdateversioncontactform as $key => $value){
            $checkversioncontactform = Pluginversion::where('_pluginversion',$key)->where('_pluginname_id',2)->first();
           
            if(empty($checkversioncontactform)){
                Pluginversion::insert(array('_pluginname_id'=>2,"_pluginversion"=>$key,"_pluginversionuseratio"=>$value));
           }
        }
        $versioncontactform_key = json_encode(array_keys($versioncontactform->json()));
        $this->api_set_redis("versioncontactformkey",$versioncontactform_key);
         $versioncontactform_value = json_encode(array_values($versioncontactform->json()));
        $this->api_set_redis("versioncontactformvalue",$versionwoocommerce_value );


        $downloadclassiceditor = Http::get('http://api.wordpress.org/stats/plugin/1.0/downloads.php?slug=classic-editor');

        $lasttwodownloadclassiceditor = $downloadclassiceditor->json();
        foreach($lasttwodownloadclassiceditor as $key => $value){
            $checkclassiceditor = Plugindownload::where('_download_date',$key)->where('_pluginname_id',3)->first();
           
            if(empty($checkclassiceditor)){
                Plugindownload::insert(array('_pluginname_id'=>3,"_download_date"=>$key,"_totaldownload"=>$value));
            }
        }
        $downloadclassiceditor_key = json_encode(array_keys($downloadclassiceditor->json()));
        $this->api_set_redis("downloadclassiceditorkey",$downloadclassiceditor_key);
        $downloadclassiceditor_value = json_encode(array_values($downloadcontactform->json()));
        $this->api_set_redis("downloadclassiceditorvalue",$downloadclassiceditor_value);



        $versionclassiceditor = Http::get('http://api.wordpress.org/stats/plugin/1.0/classic-editor');
        $lastupdatevversionclassiceditor = $versionclassiceditor->json();
        foreach($lastupdatevversionclassiceditor as $key => $value){
            $checkversionclassiceditor = Pluginversion::where('_pluginversion',$key)->where('_pluginname_id',3)->first();
           
            if(empty($checkversionclassiceditor)){
                Pluginversion::insert(array('_pluginname_id'=>3,"_pluginversion"=>$key,"_pluginversionuseratio"=>$value));
           }
        }
        $versionclassiceditor_key = json_encode(array_keys($versionclassiceditor->json()));
        $this->api_set_redis("versionclassiceditorkey",$versionclassiceditor_key);
        $versionclassiceditor_value = json_encode(array_values($versionclassiceditor->json()));
        $this->api_set_redis("versionclassiceditorvalue",$versionclassiceditor_value );




        $downloadwordpressseo = Http::get('http://api.wordpress.org/stats/plugin/1.0/downloads.php?slug=wordpress-seo');
        $lasttwodownloadwordpressseo = $downloadwordpressseo ->json();
        foreach($lasttwodownloadwordpressseo as $key => $value){
            $checkwordpressseo = Plugindownload::where('_download_date',$key)->where('_pluginname_id',4)->first();
           
            if(empty($checkwordpressseo)){
                Plugindownload::insert(array('_pluginname_id'=>4,"_download_date"=>$key,"_totaldownload"=>$value));
            }
        }
        $downloadwordpressseo_key = json_encode(array_keys($downloadwordpressseo->json()));
        $this->api_set_redis("downloadwordpressseokey",$downloadwordpressseo_key);
        $downloadwordpressseo_value = json_encode(array_values($downloadwordpressseo->json()));
        $this->api_set_redis("downloadwordpressseovalue",$downloadwordpressseo_value);



        $versionwordpressseo = Http::get('http://api.wordpress.org/stats/plugin/1.0/wordpress-seo');
        $lastupdatevversionwordpressseo = $versionwordpressseo->json();
        foreach($lastupdatevversionwordpressseo as $key => $value){
            $checkversionwordpressseo = Pluginversion::where('_pluginversion',$key)->where('_pluginname_id',4)->first();
           
            if(empty($checkversionwordpressseo)){
                Pluginversion::insert(array('_pluginname_id'=>4,"_pluginversion"=>$key,"_pluginversionuseratio"=>$value));
           }
        }
        $versionwordpressseo_key = json_encode(array_keys($versionwordpressseo->json()));
        $this->api_set_redis("versionwordpressseokey",$versionwordpressseo_key);
        $versionwordpressseo_value = json_encode(array_values($versionwordpressseo->json()));
        $this->api_set_redis("versionwordpressseovalue",$versionwordpressseo_value);




        $woocommerceinfo = Http::get('https://api.wordpress.org/plugins/info/1.0/woocommerce.json');
        $this->api_set_redis("woocommerceinfo",$woocommerceinfo);  

        $contactforminfo = Http::get('https://api.wordpress.org/plugins/info/1.0/contact-form-7.json');
        $this->api_set_redis("contactforminfo",$contactforminfo);

        $classiceditorinfo = Http::get('https://api.wordpress.org/plugins/info/1.0/classic-editor.json');
        $this->api_set_redis("classiceditorinfo",$classiceditorinfo);

        $yoastseoinfo = Http::get('https://api.wordpress.org/plugins/info/1.0/wordpress-seo.json');
        $this->api_set_redis("yoastseoinfo",$yoastseoinfo);

    }


    function api_set_redis($key, $value) {
        $redis = Redis::connection();
        if ($key) {
            $redis->set($key, $value); 
        }
    }
}
