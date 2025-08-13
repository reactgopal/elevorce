<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function success($success, $msg, $data = [], $code = 200)
    {
        if ($success) {
            return response()->json([
                'success' => $success,
                'message' => $msg,
                'data' => $data,
            ], $code);
        } else {
            return response()->json([
                'success' => $success,
                'message' => $msg,
            ], $code);
        }
    }

    public function error($msg = NULL, $code = 404)
    {
        return response()->json([
            'success' => false,
            'message' => $msg,
        ], $code);
    }

    public function getGoogleAccessToken()
    {

        $keyFilePath = public_path('json/elevorce.json');
        $client = new \Google\Client();
        $client->setAuthConfig($keyFilePath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        $client->refreshTokenWithAssertion();
        $token = $client->getAccessToken();
        return $token['access_token'];
    }

    public function sendPushNotification($device_token, $device_type, $title,   $msg, $type)
    {
        $data['title'] = $title;
        $data['message'] = $msg;
        $data['type'] = $type;

        // dd($data);

        if ($device_token != null) {

            // Get the access token using the non-static method
            $SERVER_API_KEY = $this->getGoogleAccessToken();
            // dd($SERVER_API_KEY);
            $headers = [
                'Authorization: Bearer ' . $SERVER_API_KEY,
                'Content-Type: application/json',
            ];
            // dd($data, $SERVER_API_KEY, $device_token);
            if ($device_type == 'android') {
                $dataString = [
                    "message" => [
                        "token" => $device_token,
                        "android" => [
                            "data" => $data,
                            "priority" => "high"
                        ]
                    ]
                ];
            } else if ($device_type == "iOS") {
                $dataString = [
                    "message" => [
                        "token" => $device_token,
                        "apns" => [
                            "headers" => [
                                "apns-priority" => "5",
                            ],
                            "payload" => [
                                "aps" => [
                                    // "title" => $data['title'],
                                    // "body" => $data['body'],
                                    "alert" => [
                                        "title" => $data['title'],
                                        "message" => $data['message'],
                                        "type" => $data['type']
                                    ],
                                    "content-available" => 1,
                                    "mutable-content" => 1,
                                    // "category" => "customNotificationView",
                                    // "sound" => $data['sound'],
                                ],
                                "data" => $data,
                            ]
                        ]
                    ]
                ];
            } else {
                $dataString = [
                    "message" => [
                        "token" => $device_token,
                        "data" => $data,
                    ]
                ];
            }
            // dd($device_token, $device_type, $title, $msg, $type,service_id, $user_id, $other_ids, $reference_id, $this->getGoogleAccessToken());

            $dataString = json_encode($dataString);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/elevorce/send');
            // curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/v1/projects/essential-vendor/messages:send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
            $response = curl_exec($ch);
            // dd($response);
            return true;
        }
    }

    public function sendPushTopicNotification($topic, $data = [])
    {
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';

        $headers = [
            'Authorization: key=' . env('SERVER_KEY'),
            'Content-Type: application/json'
        ];

        $notification = [
            "to" => '/topics' . "/" . $topic,
            "data" => [
                "title" => $data['title'],
                "body" => $data['body'],
            ],
            "android" => [
                "priority" => "high",
            ]
            // "notification" => [
            //     "title" => $data['title'],
            //     "body" => $data['body'],
            // ]
        ];
        // dd($notification);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($notification));
        $result = curl_exec($ch);
        curl_close($ch);
        return true;
    }

}
