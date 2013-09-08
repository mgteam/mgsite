<?php
class Image {


    public function getAndSaveIamge($url){
        $message=null;
        if(empty($url)){
                $message['error'] = "Invalid location, please provide correct location";
        }else{
                $path_parts = pathinfo($url);
                if(empty($path_parts['extension'])){
                        $message['error'] = "There is no extensions exists";
                }else{
                        $ext  = $path_parts['extension'];
                        $name = 'image_'.uniqid();
                        $image_name = $name.'.'.$ext;
                        $img = 'images/'.$image_name;
                        if(file_put_contents($img, file_get_contents($url))){
                                $message['success'] = "Image successfully uploaded";
                        }else{
                                $message['error'] = "There is some error while uploading image";
                        }
                }
        }
        return $message;
    }
}