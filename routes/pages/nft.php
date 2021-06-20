<?php 
namespace routes;
use Database;
use templates;

class nft {	
    private $path = [];

    function __construct($path) {
        include __DIR__ .'/../../database/Database.php';
        include __DIR__ .'/../../templates/multiverse/page.php';
        include __DIR__ .'/../../templates/link.php';

        if($path!=""){
            $this->path = explode("/",$this->Sanitinize($path));
        }
    }

    private function Sanitinize($url){
        if(trim($url)!=""){
            $objects = explode("/",$url);
            $url = "";
            foreach($objects as $object){
                $object = trim(preg_replace("/[^A-Za-z0-9? ]/","",$object));
                if($object!=""){
                    $url = $url.$object."/";
                }
            }
            $url = substr($url, 0, strlen($url)-1);
        }
        return $url;
    }

    public function Print(){
        $result = Array();
        $db = new Database\Controller();
        $collection = "";
        $domain = "";
        $unit = "";

        if(count($this->path)>0){
            $collection = preg_replace('/[^a-zA-Z0-9]/', '',$this->path[0]);
        }
        if(count($this->path)>1){
            $domain = preg_replace('/[^a-zA-Z0-9]/', '',$this->path[1]);
        }
        if(count($this->path)>2){
            $unit = preg_replace('/[^a-zA-Z0-9]/', '',$this->path[2]);
            $result = $db->Select(["link", "title", "description","image"],"links_nft",["collection",$collection,"domain",$domain,"unit",$unit]);
        }
        if (count($result) > 0) {
            $link = new templates\link($result);
            $link->Print();
        }
        else{
            $pageTitle = "Markanime Studios NFTs";
            if($domain!=""){
                $result = $db->Select(["link", "title", "description","image"],"links_nft",["collection",$collection,"domain",$domain]);
            }
            if (count($result) > 0) {
                $pageTitle = "Markanime Studios ".$domain." NFT copies";
            }
            else{
                if($collection!=""){
                    $result = $db->Select(["link", "title", "description","image"],"links_nft",["collection",$collection]);
                }
                if (count($result) > 0) {
                    $pageTitle = "Markanime Studios ".$collection." NFT collection";
                }
                else{
                    $result = $db->Select(["link", "title", "description","image"],"links_nft");
                }
            }

            $page = new templates\page($pageTitle);
            $page->SetHeaders("<meta property=\"og:title\" content=\"$pageTitle\" />
            <meta property=\"og:description\" content=\"Link not found\"/>
            <meta property=\"og:type\" content=\"website\"/>
            <meta property=\"og:image\" content=\"https://www.markanime.net/assets/logobig.jpg\" />
            <meta charset=\"utf-8\" />
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" />");
            $page->SetLinkMode();
            
            $page->Print($result,"link","image","title","description","description");
        }
    }
}
?>