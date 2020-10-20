<?php


namespace App\Traits;

use Illuminate\Http\Request;
use Auth;

trait UploadTrait
{
    /**
     * Upload user profile picture to the server everytime overriding the old profile picture
     * @param Request $request
     * @return string
     */
    public $supported_extensions = ['png', 'jpg', 'jpeg'];

    public function uploadImage(Request $request, $input_name = 'image', $user = null)
    {
        $authenticatedUser = Auth::user();
        if ($user) {
            $authenticatedUser = $user;
        }
        $ds = DIRECTORY_SEPARATOR;

        if ($request->has($input_name)) {
            $image = $request->file($input_name);

            $name = $authenticatedUser->id.'_profilePicture_'. rand() . strtotime($authenticatedUser->created_at) . '.' . $image->getClientOriginalExtension();

            $folder = $ds . 'uploads' . $ds . 'img' . $ds .$authenticatedUser->id  . '_' . $authenticatedUser->created_at->timestamp . DIRECTORY_SEPARATOR . 'profile_picture' . DIRECTORY_SEPARATOR;

            $filePath = $folder . $name;
            
            //dd(request()->{$input_name}->getSize() / (1024 * 1024));
            if (request()->{$input_name}->getSize() / (1024 * 1024) >= 2) {
                $this->compress(request()->{$input_name}, public_path($filePath));
                return $filePath; 
            }

            request()->{$input_name}->move(public_path($folder), $name);
        }
        return $filePath;
    }

    /**
     * Upload user profile picture to the server everytime overriding the old profile picture
     * @param Request $request
     * @return string
     */
    
    public function compress($source, $path) {
      $info = getimagesize($source);

      if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);

      elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);

      elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);

      $try = imagejpeg($image, $path, 60);
    }
    
    public function uploadImageToFolder(Request $request, $path)
    {
        $authenticatedUser = Auth::user();
        $ds = DIRECTORY_SEPARATOR;

        if ($request->has('image')) {
            $image = $request->file('image');
            $imageName = md5(rand(1, 999)) . '.' . $image->getClientOriginalExtension();

            $filePath = $path . $imageName;
            
            if ($image->getSize() / (1024 * 1024) >= 2) {
                if (!file_exists(public_path($path))) {
                    mkdir(public_path($path));
                }
                $this->compress($image, public_path($filePath));
                return $filePath; 
            }

            request()->image->move(public_path($path), $imageName);
        }
        return $filePath;
    }

    /**
     * Upload the file to the logged in user path
     * @param Request $request
     * @param bool $flag to return the full file path or not
     * @return array
     */
    public function uploadFile(Request $request, $flag = false): array
    {
        $user = Auth::user();
        $ds = DIRECTORY_SEPARATOR;

        $path = public_path() . $ds . 'uploads' . $ds . 'files' . $ds . $user->id . '_' . $user->created_at->timestamp . $ds;

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');
        if (!in_array($file->getClientOriginalExtension(), $this->supported_extensions)) {
            return array(false, 'Not Supported Extension');
        }

        $name = uniqid() . '_' . trim($file->getClientOriginalName());


        $file->move($path, $name);

        $filePath = $ds . 'uploads' . $ds . 'files' . $ds . $user->id . '_' . $user->created_at->timestamp . $ds . $name;
        

        if ($flag) {
            return array($filePath, $name);
        }

        return array($file, $name);
    }

    /**
     * Delete file sent in the request body name
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteFile(Request $request)
    {
        $user = Auth::user();
        $ds = DIRECTORY_SEPARATOR;

        $photos_path = $folder = public_path() . $ds . 'uploads' . $ds . 'files' . $ds . $user->id . '_' . $user->created_at->timestamp . $ds;

        $filename = $request->name;

        if (empty(basename($filename))) {
            return response()->json(['message' => 'Sorry file does not exist'], 400);
        }

        $file_path = $photos_path . '/' . $filename;

        if (file_exists($file_path)) {
            unlink($file_path);
        }

        return response()->json(['message' => 'File successfully delete'], 200);
    }

}
