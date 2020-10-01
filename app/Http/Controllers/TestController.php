<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Alert;

class TestController extends Controller
{
    /**
     * 展示文件上传表单页面
     */
     public function test()
     {
         // Alert::warning('Warning Title', 'Warning Message');
        // Alert::question('Question Title', 'Question Message');
        // Alert::toast('Toast Message', 'Toast Type');
        toast('Your Post as been submited!','success');
        // toast('Success Toast','info')->autoClose(2500)->position('top');
        return view('test');
     }
 
      /**
      * 文件上传
      */
     public function uploadFile(Request $request)
     {
         $file = $request->file('img');
         // dd($file);
         // 此时 $this->upload如果成功就返回文件名不成功返回false
         $fileName = $this->upload($file);
         if ($fileName){
             return $fileName;
         }
         return '上传失败';
     }
 
     /**
      * 验证文件是否合法
      */
      public function upload($file, $disk='public') {
         //  dd($file);
         // 1.是否上传成功
         if (! $file->isValid()) {
            return false;
         }
 
         // 2.是否符合文件类型 getClientOriginalExtension 获得文件后缀名
         $fileExtension = $file->getClientOriginalExtension();
         if(! in_array($fileExtension, ['wav', 'mp3', 'm4a'])) {
             return false;
         }
 
         // 3.判断大小是否符合 2M
         $tmpFile = $file->getRealPath();
         if (filesize($tmpFile) >= 2048000) {
             return false;
         }
 
         // 4.是否是通过http请求表单提交的文件
         if (! is_uploaded_file($tmpFile)) {
             return false;
         }
 
         // 5.每天一个文件夹,分开存储, 生成一个随机文件名
         $fileName = date('Y_m_d').'/'.md5(time()) .mt_rand(0,9999).'.'. $fileExtension;
         if (Storage::disk($disk)->put($fileName, file_get_contents($tmpFile)) ){
             return Storage::url($fileName);
         }
     }
}
