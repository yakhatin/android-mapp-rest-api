<?php


namespace App\Traits;

trait ApiResponse
{
    protected $cookies = [];

    protected function appendResponseCookie($key, $value, $minutes = 0)
    {
        array_push($this->cookies, cookie($key, $value, $minutes));
    }

    /**
     * @param $result
     * @param $message
     * @param $code
     * @return mixed
     */
    public function sendResponse($result, $message, $code, $count = null)
    {
        $response = response()
            ->json(self::makeResponse($message, $result, $count), $code)
            ->header('Content-Type', 'application/json');

        if (count($this->cookies) > 0) {
            for ($i = 0; $i < count($this->cookies); $i += 1) {
                $response->cookie($this->cookies[$i]);
            }
        }

        $response->send();
    }

    /**
     * @param string $error
     * @param int $code
     * @param array $data
     * @return mixed
     */
    public function sendError($error, $code = 400, $data = [])
    {
        response()
            ->json(self::makeError($error, $data), $code)
            ->header('Content-Type', 'application/json')
            ->send();
    }

    /**
     * @param string $message
     * @param mixed  $data
     *
     * @return array
     */
    public static function makeResponse($message, $data, $count)
    {
        return [
            'success' => true,
            'data'    => $data,
            'totalCount' => gettype($count) === 'integer' ? $count : null,
            'message' => $message,
        ];
    }

    /**
     * @param string $message
     * @param array  $data
     *
     * @return array
     */
    public static function makeError($message, array $data = [])
    {
        $res = [
            'success' => false,
            'message' => $message,
        ];

        if (!empty($data)) {
            $res['data'] = $data;
        }

        return $res;
    }
}