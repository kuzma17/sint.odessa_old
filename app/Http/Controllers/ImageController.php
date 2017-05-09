<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Method to upload and save images
     * @param Request $request
     * @return string
     */
    public function storeAdmin(Request $request)
    {
        //Your upload logic

        //$_FILES['upload']['tmp_name']
        $url_image = $_FILES['upload']['tmp_name'];
        $path_to_image = '/storage/uploads/';

        echo '<script> alert('.$path_to_image.'); </script>';

        $result = ['url' => $url_image, 'value' => $path_to_image];

        if ($request->CKEditorFuncNum && $request->CKEditor && $request->langCode) {
            //that handler to upload image CKEditor from Dialog
            $funcNum = $request->CKEditorFuncNum;
            $CKEditor = $request->CKEditor;
            $langCode = $request->langCode;
            $token = $request->ckCsrfToken;
            return view('admin.upload_file', compact('result', 'funcNum', 'CKEditor', 'langCode', 'token'));
        }

        return $result;
    }
}
