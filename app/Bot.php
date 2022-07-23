<?php namespace app;

class Bot
{

    private $API_KEY;

    public function __construct($key)
    {
        $this->API_KEY = $key;
    }

    public function Request($method, $datas = [])
    {
        $url = "https://api.telegram.org/bot" . $this->API_KEY . "/" . $method;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
        $res = curl_exec($ch);
        if (curl_error($ch)) {
            var_dump(curl_error($ch));
        } else {
            // $this->SendMessage($this->admin,"$res");
            return json_decode($res);
        }
    }

    public function DATA()
    {
        $data = json_decode(file_get_contents('php://input'));
        return $data;
    }

    public function SendMessage($chat_id, $text)
    {
        $this->Request('sendmessage', [
            'chat_id' => $chat_id,
            'text' => $text,
            'parse_mode' => 'MarkDown',
        ]);
    }

    public function save($filename, $data)
    {
        $file = fopen($filename, 'w');
        fwrite($file, $data);
        fclose($file);
    }

    public function sendAction($chat_id, $action)
    {
        $this->Request('sendChataction', [
            'chat_id' => $chat_id,
            'action' => $action]);
    }

    public function save_json($data, $addr)
    {

        $file = fopen($addr, 'w');
        fwrite($file, $data);
        fclose($file);
    }
    public function Forward($berekoja, $azchejaei, $kodompayam)
    {
        $this->Request('ForwardMessage', [
            'chat_id' => $berekoja,
            'from_chat_id' => $azchejaei,
            'message_id' => $kodompayam,
        ]);
    }

    public function information($chat_id, $from_id)
    {
        return $this->Request('getChatMember', ['chat_id' => "$chat_id", 'user_id' => $from_id]);

    }

}
