<?php 
namespace routes;
use Database;

class nft {	
    private $path = [];

    function __construct($path) {
        include __DIR__ .'/../../database/Database.php';

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
        
        if(count($this->path)>2){
            $collection = preg_replace('/[^a-zA-Z0-9]/', '',$this->path[0]);
            $domain = preg_replace('/[^a-zA-Z0-9]/', '',$this->path[1]);
            $unit = preg_replace('/[^a-zA-Z0-9]/', '',$this->path[2]);

            $result = $db->Select(["link", "title", "description","image"],"links_nft",["collection",$collection,"domain",$domain,"unit",$unit]);
        }
        if (count($result) > 0) {
            foreach ($result as $row) {
                echo "<!DOCTYPE HTML>
    <html lang=\"en-US\">
        <head>
            <meta charset=\"UTF-8\">
            <meta http-equiv=\"refresh\" content=\"1; url=".$row["link"]."\">
            <script type=\"text/javascript\">
                window.location.href = \"".$row["link"]."\"
            </script>
            <title>".$row["title"]."</title>
            <meta property=\"og:title\" content=\"".$row["title"]."\" />
            <meta property=\"og:description\" content=\"".$row["description"]."\"/>
            <meta property=\"og:image\" content=\"".$row["image"]."\" />
            <meta charset=\"utf-8\" />
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" />
        </head>
        <body>
            If you are not redirected automatically, Click this <a href='".$row["link"]."'> to go </a>.
        </body>
    </html>";
            }
        }
        else{
            echo "<!DOCTYPE HTML>
    <html lang=\"en-US\">
        <head>
            <meta charset=\"UTF-8\">
            <title>NFT not found - Markanime Studios NFTs</title>
            <meta property=\"og:title\" content=\"Link not found - Markanime Studios NFTs\" />
            <meta property=\"og:description\" content=\"Link not found\"/>
            <meta property=\"og:type\" content=\"website\"/>
            <meta property=\"og:image\" content=\"https://www.markanime.net/assets/logobig.jpg\" />
            <meta charset=\"utf-8\" />
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" />
        </head>
        <body>
         <h1>NFT not found</h1>
         
         <p>these are all NFTs by Markanime:</p>
         <ul>
        ";
            $result = $db->Select(["title", "domain","collection","unit"],"links_nft");
            
            if (count($result) > 0) {
                foreach ($result as $row) {
                    echo "<li> <a href=\"https://markani.me/nft/".$row["collection"]."/".$row["domain"]."/".$row["unit"]."\">".$row["title"]." - #".$row["unit"]."</a></li>";
                }
            }
            
    echo "</ul>
    </body>";
        }
    }
}
?>