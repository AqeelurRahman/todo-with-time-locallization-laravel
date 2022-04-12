<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserTimeZoneController extends Controller
{

    public function update(Request $request)
    {
        $code = 200;

        try {
            auth()->user()->update(['time_zone' => $request->timezone['timeZone']]);
            $response = ['success' => true, 'message' => 'User Timezone Updated'];
        } catch (\Exception $exception) {
            $response = ['success' => false, 'message' => 'User Timezone Update Failed','errorMessage' => $exception->getMessage(), 'stack' => $exception->getTrace()];
            $code = 500;
        }
        return response()->json($response, $code);
    }
}
