<?php

namespace App\Http\BaseClasses;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;


class AppBaseController extends Controller
{
   public function sendResponse($result, $message)
   {
       return Response::json(ResponseUtil::makeResponse($message, $result));
   }

   public function sendError($error, $code = 404)
   {
       return Response::json(ResponseUtil::makeError($error), $code);
   }

    public function setLog($sMessage, $iType = \App\Models\SystemLog::Info) {
        try {
            $values = request()->route()->getAction();

            $controller = $values["controller"];
            $method = request()->route()->getActionMethod();

            $userEmail = "";
            $created_by_company_id = 0;
            if (Auth::check()) {
                $userEmail = auth()->user()->email;
            }
            \App\Models\SystemLog::create([
                'controller' => $method."->".$controller,
                'message' => $sMessage,
                'type' => $iType,
                'userEmail' => $userEmail
            ]);
        } catch (\Exception $e) {
            $sMessage = $e->getMessage();
        }
    }
}
