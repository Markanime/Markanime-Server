<?php 
namespace routes;
use Database;

class home {	
    private $path="";

    function __construct($path="") {
        include __DIR__ .'/../../database/Database.php';

        if($path!=""){
            $this->path = $path;
        }
    }

    public function Print(){
        $db = new Database\Controller();

        $result = $db->Select(["link", "title", "description","type","image"],"links",["domain",$this->path]);

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
            <meta property=\"og:type\" content=\"".$row["type"]."\"/>
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
            <title>Link not found - Markanime Studios Link Shortener</title>
            <meta property=\"og:title\" content=\"Link not found - Markanime Studios Link Shortener\" />
            <meta property=\"og:description\" content=\"Link not found\"/>
            <meta property=\"og:type\" content=\"website\"/>
            <meta property=\"og:image\" content=\"https://www.markanime.net/assets/logobig.jpg\" />
            <meta charset=\"utf-8\" />
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" />
        </head>
        <body>
         <h1>http://markani.me/".$this->path." not found</h1>
         
         <p>these are the available links:</p>
         <ul>
        ";
            $result = $db->Select(["title", "domain"],"links");
            if (count($result) > 0) {
                foreach ($result as $row) {
                    echo "<li>".$row["title"]." - <a href=\"http://markani.me/".$row["domain"]."\">markani.me/".$row["domain"]."</a></li>";
                }
            }
            
    echo "</ul>
    </body>";
        }
    }
}
?>