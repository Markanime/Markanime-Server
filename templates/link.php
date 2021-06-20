<?php  
namespace templates;

class link {
    private $rows;

    function __construct($rows) {
        $this->rows = $rows;
    }

    public function Print(){
        foreach ($this->rows as $row) {
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
}
?>