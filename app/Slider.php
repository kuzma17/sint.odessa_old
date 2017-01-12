<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use KodiComponents\Support\Upload;

class Slider extends Model
{
    use Upload;

    protected $casts = ['image'=>'image'];

    public function getUploadSettings(){
        return [
            'image' => [
                'fit' => [965, 400, function ($constraint) {  // size image slider 965x400px
                    $constraint->upsize();
                    $constraint->aspectRatio();}]
            ]
        ];
    }
}
