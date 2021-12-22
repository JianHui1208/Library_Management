<?php

namespace App\Http\Controllers;

use App\Helpers\ApiRes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class BaseApiController extends Controller
{
   /**
     * @param int $status 状态码
     * @param mixed $data 需要传输的资料
     * @param string $message 信息，非null 拿其相对的message，是null 拿status的default message
     * @param string $locale 返回的语言
     * @return array
     */
   public function resFormat(int $status, string $message = null, $data = [], string $locale = null , int $xhr_code = 200)
   {
      //对应旧的
      return ApiRes::resFormat($xhr_code , $status , $message , $data , $locale);
   }
}