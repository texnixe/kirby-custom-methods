<?php

file::$methods['preview'] = function($file, $size='800', $page=0) {

		$key  = 'preview_'. md5($file->root());
		$thumb = kirby()->roots()->thumbs() .DS. $key;

		if (f::exists($thumb))
		{

			if ( (f::modified($thumb) > $file->modified())) {
				return new Asset(kirby()->urls()->thumbs() .'/'. $key);
			}
			f::remove($thumb);

	  }

	  $image = new Imagick($file->root().'['.$page.']'); // which page? First by default
		$image->setImageBackgroundColor('white');
		$image->setImageAlphaChannel(imagick::ALPHACHANNEL_REMOVE);
		$image->mergeImageLayers(imagick::LAYERMETHOD_FLATTEN);
		$image->setImageFormat('jpg');
		$image->setImageCompression(Imagick::COMPRESSION_JPEG);
	  $image->setImageCompressionQuality(80);
		$image->thumbnailImage($size, 0);
		$image->writeImage($thumb);

		return new Asset(kirby()->urls()->thumbs() .'/'. $key);

    };
