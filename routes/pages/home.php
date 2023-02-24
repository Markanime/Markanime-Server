<?php 
namespace routes;
use Database;
use templates;

class home {	
    private $path="";
    private $category="";

    function __construct($path="") {
        include __DIR__ .'/../../database/Database.php';
        include __DIR__ .'/../../templates/multiverse/page.php';
        include __DIR__ .'/../../templates/link.php';
        if($path!=""){
            $this->path = $path;
            $this->category = $path;
        }
    }

    public function SetCategory($category){
        $this->category = $category;
    }

    public function Print(){       
        $db = new Database\Controller();
        $filter=["hidden",0];

        if($this->path!="" && $this->path != "home")
        {
            $result = $db->Select(["link", "title", "description","type","image"],"links",["domain",$this->path]);

            if (count($result) > 0) {
                $link = new templates\link($result);
                $link->Print();
                return;
            }
            $filter= array_merge($filter,["category",$this->category]);
        }
        else if($this->category!="")
        {
            $filter= array_merge($filter,["category",$this->category]);
        }

        $result = $db->Select(["link", "title","description","image"],"links",$filter);
        if (count($result) <= 0) {
            $result = $db->Select(["link", "title","description","image"],"links",["hidden",0]);
        }
        $page = new templates\page("Markanime Studios -  Links");
        $page->SetHeaders("<meta property=\"og:title\" content=\"Markanime Studios - links\" />
        <meta property=\"og:description\" content=\"Link not found\"/>
        <meta property=\"og:type\" content=\"website\"/>
        <meta property=\"og:image\" content=\"https://www.markanime.net/assets/logobig.jpg\" />
        <meta charset=\"utf-8\" />
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" />");
        $page->SetLinkMode();
        
        $page->Print($result,"link","image","title","description","description");
    }
}
?>