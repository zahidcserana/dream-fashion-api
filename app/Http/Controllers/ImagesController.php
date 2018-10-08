<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;
use Image;
use Keygen;

class ImagesController extends Controller
{
    public function add(Request $request)
    {
        $status = false;
        if (isset($_FILES["file"])) {
            $file = $request->file;
            $name = $file->getClientOriginalName();
            $temp = explode('.', $name);
            $extention = array_pop($temp);
            // upload original Image
            $fileOriginal = Keygen::numeric(8)->generate();
            $fileOriginal = $fileOriginal . "." . $extention;
            $destinationPath = public_path() . '/image/products';
            $originalFilePath = $file->move($destinationPath, $fileOriginal);
            // upload Large Image
            $fileLarge = Keygen::numeric(8)->generate();
            $fileLarge = $fileLarge . "." . $extention;
            $this->resize(200, $destinationPath . '/' . 'thumb_' . $fileLarge, $originalFilePath);
            $input = array(
                'product_id' => $request->product_id,
                'original' => $fileOriginal,
                'large' => 'thumb_' . $fileLarge,
            );
            DB::table('images')->insert($input);
            $status = true;
        }
        if ($status) {
            return json_encode(['success' => true, 'message' => 'Picture successfully uploaded!']);
        } else {
            return json_encode(['success' => false, 'message' => 'Sorry! Something wrong!']);
        }
    }

    private function resize($newWidth, $targetFile, $originalFile)
    {
        $info = getimagesize($originalFile);
        $mime = $info['mime'];
        switch ($mime) {
            case 'image/jpeg':
                $image_create_func = 'imagecreatefromjpeg';
                $image_save_func = 'imagejpeg';
                $new_image_ext = 'jpg';
                break;

            case 'image/png':
                $image_create_func = 'imagecreatefrompng';
                $image_save_func = 'imagepng';
                $new_image_ext = 'png';
                break;

            case 'image/gif':
                $image_create_func = 'imagecreatefromgif';
                $image_save_func = 'imagegif';
                $new_image_ext = 'gif';
                break;

            default:
                return false;
        }

        $img = $image_create_func($originalFile);
        list($width, $height) = getimagesize($originalFile);

        $newHeight = ($height / $width) * $newWidth;
        $tmp = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        if (file_exists($targetFile)) {
            unlink($targetFile);
        }
        $image_save_func($tmp, "$targetFile");
        return true;
    }

    public function imageFeature(Request $request){

        $product_id = $request->query('product_id');
        $image_id = $request->query('image_id');
        $data = array('image_id' => $image_id);
        $product = DB::table('products')->where('id', $product_id)->update($data);
        echo json_encode(array('success'=>true,'msg'=>'Successfully Updated'));
    }
}
