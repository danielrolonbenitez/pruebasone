<?php
App::uses('Component', 'Controller');
class VNSFileComponent extends Component {
	public function savePicture($file_data, $width = null, $height = null, $add_path = null) {
		if(!empty($add_path)) $add_path .= '/';
		$path = preg_replace('/[\\\\\\/]+/', DS, WWW_ROOT . '/files/' . $add_path);
		
		$base_filename = preg_replace('/[^a-zA-Z0-9\.\-\_]/', '_', $file_data['name']);
		$base_filename = strtolower($base_filename);
		
		$index = 0;
		$filename = $base_filename;
		while(file_exists($path . $filename)) {
			$index++;
			$filename = $index . '_' . $base_filename;
		}
		
		if(empty($width) && empty($height)) {
			move_uploaded_file($file_data['tmp_name'], $path . $filename);
		}
		else {
			$orig_picture = imagecreatefromstring(file_get_contents($file_data['tmp_name']));
			$orig_width = imagesx($orig_picture);
			$orig_height = imagesy($orig_picture);
			
			if(empty($height) && !empty($width)) $height = $width * $orig_height / $orig_width;
			elseif(empty($width) && !empty($height)) $width = $height * $orig_width / $orig_height;
			
			$new_picture = imagecreatetruecolor($width, $height);
			imagealphablending($new_picture, false);
			imagesavealpha($new_picture, true);
			$transparent = imagecolorallocatealpha($new_picture, 255, 255, 255, 127);
			imagefilledrectangle($new_picture, 0, 0, $width, $height, $transparent);

			$scale = min($width/$orig_width, $height/$orig_height);
			
			$prop_width  = ceil($scale*$orig_width);
			$prop_height = ceil($scale*$orig_height);
			
			$dif_x = ($width - $prop_width) / 2;
			$dif_y = ($height - $prop_height) / 2;
			
			imagecopyresampled(
				$new_picture, $orig_picture,
				$dif_x, $dif_y, 0, 0,
				$prop_width, $prop_height,
				$orig_width, $orig_height
			);
			
			if(!empty($file_data['cake_cache'])) {
				$key = $file_data['tmp_name'];
				$key .= '?' . sprintf('%d', $width) . 'x' . sprintf('%d', $height);
				$key = md5($key);

				imagepng($new_picture, $path . $filename);
				Cache::write($key, base64_encode(file_get_contents($path . $filename)), 'archivos');
				unlink($path . $filename);
				return $key;
			}
			else imagepng($new_picture, $path . $filename);
			imagedestroy($new_picture);
			imagedestroy($orig_picture);
		}
		
		return $filename;
	}
}