<?php 
namespace routes;

class image {	

    private $image="";

    function __construct($image="") {
        if($image!=""){
            $this->image = str_replace("_"," ",$image);
        }
    }

    public function Print(){
        $image =  $this->image;
				$file_out = "img/$image"; // The image to return

				if (file_exists($file_out)) {

					//Set the content-type header as appropriate
					$image_info = getimagesize($file_out);
					switch ($image_info[2]) {
						case IMAGETYPE_JPEG:
							header("Content-Type: image/jpeg");
							break;
						case IMAGETYPE_GIF:
							header("Content-Type: image/gif");
							break;
						case IMAGETYPE_PNG:
							header("Content-Type: image/png");
							break;
					   default:
							header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
							break;
					}

					// Set the content-length header
					header('Content-Length: ' . filesize($file_out));

					// Write the image bytes to the client
					readfile($file_out);

				}
				else { // Image file not found

					header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
					echo "Image not found";
				}
    }
}
?>