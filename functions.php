<!-- RECADRAGE IMAGE JPG -->
<?php 
	function recadrage( $source, $destination, $new_width, $new_height){
		$old_image = imagecreatefromjpeg($source); 
		list( $old_width , $old_height ) = getimagesize($source);
		if( ( $old_width / $old_height ) < ( $new_width / $new_height ) ){
			$height = $new_height / $new_width * $old_width;
			$width = $old_width;
			$y = ( $old_height - $height)  / 2;
			$x = 0;
		}
		else{
			$width = $new_width / $new_height * $old_height;
			$height = $old_height;
			$x = ( $old_width - $width)  / 2;
			$y = 0;
		}
		$new_image = imagecreatetruecolor($new_width, $new_height);
		imagecopyresampled($new_image, $old_image, 0, 0, $x, $y, $new_width, $new_height, $width, $height);
		imagejpeg($new_image, $destination, 100 );
	}
	// RECADRAGE IMAGE PNG
	function recadragepng( $source, $destination, $new_width, $new_height){
		$old_image = imagecreatefrompng($source); 
		list( $old_width , $old_height ) = getimagesize($source);
		if( ( $old_width / $old_height ) < ( $new_width / $new_height ) ){
			$height = $new_height / $new_width * $old_width;
			$width = $old_width;
			$y = ( $old_height - $height)  / 2;
			$x = 0;
		}
		else{
			$width = $new_width / $new_height * $old_height;
			$height = $old_height;
			$x = ( $old_width - $width)  / 2;
			$y = 0;
		}
		$new_image = imagecreatetruecolor($new_width, $new_height);
		$color = imagecolorallocatealpha($new_image, 0, 0, 0, 127); //fill transparent back
		imagefill($new_image, 0, 0, $color);
		imagesavealpha($new_image, true);
		imagecopyresampled($new_image, $old_image, 0, 0, $x, $y, $new_width, $new_height, $width, $height);
		imagepng($new_image, $destination, 9 );
	}	 
	//FONCTION afficher petites et grande image
	function afficher_petites_images( $presentation,  $nom_presentation ){
		$html = "<p class='image_pres_chalet petites'>";
		for ($i=1; $i < 10 ; $i++) { 
			if( file_exists("img/$presentation-$i.jpg") ){
				$html .= "<img src='img/$presentation-$i.jpg' alt='$nom_presentation'>";	
			}
		}
		$html .= "</p>"; 
		return $html;
	}
	function afficher_grande_image( $presentation,  $nom_presentation ){
		if( file_exists("img/$presentation-1.jpg") ){
			$html = "<p class='image_pres_chalet grande'>";
			$html .= "<img src='img/$presentation-1.jpg' alt='$nom_presentation'>";	
			$html .= "</p>"; 
		}
		return $html;
	}

		function afficher_petites_images2( $presentation,  $nom_presentation ){
		$html = "<p class='image_pres_chalet petites2'>";
		for ($i=1; $i < 10 ; $i++) { 
			if( file_exists("img/$presentation-$i.jpg") ){
				$html .= "<img src='img/$presentation-$i.jpg' alt='$nom_presentation'>";	
			}
		}
		$html .= "</p>"; 
		return $html;
	}
	function afficher_grande_image2( $presentation,  $nom_presentation ){
		if( file_exists("img/$presentation-1.jpg") ){
			$html = "<p class='image_pres_chalet grande2'>";
			$html .= "<img src='img/$presentation-1.jpg' alt='$nom_presentation'>";	
			$html .= "</p>"; 
		}
		return $html;
	}


?>