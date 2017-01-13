<?php
/**
 * Created by @ONYXTM.
 * User: @MENCH
 * Date: 08/01/2017
 * Time: 01:19 PM
 */

define('API_KEY','TOOKEN');
$update = json_decode(file_get_contents('php://input'));
$chat_id = $update->message->chat->id;
$text = $update->message->text;
$admin = "ADMIN ID";

$stepp = file_get_contents("mem/$chat_id/step.txt");
$step = explode("\n",$stepp);

$name = $update->message->chat->first_name;

//callback_query
$data = $update->callback_query->data;
$msg_id = $update->callback_query->message->message_id;
$ch_id = $update->callback_query->message->chat->id;
$nameca = $update->callback_query->message->chat->first_name;

function onyx($method,$datas=[])
{
    $url = "https://api.telegram.org/bot" . API_KEY . "/" . $method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, ($datas));
    $res = curl_exec($ch);
    if (curl_error($ch)) {
        var_dump(curl_error($ch));
    } else {
        return json_decode($res);
    }
}

function contains($needle, $haystack)
{
    return strpos($haystack, $needle) !== false;
}

//https://chart.googleapis.com/chart?cht=qr&chl=&chs=180x180&choe=UTF-8&chld=L|2

mkdir("mem/$chat_id");
$lang = file_get_contents("mem/$chat_id/lang.txt");
$user = file_get_contents('Member.txt');
$members = explode("\n", $user);
if (!in_array($chat_id, $members)) {
    $add_user = file_get_contents('Member.txt');
    $add_user .= $chat_id . "\n";
    file_put_contents('Member.txt', $add_user);
}

$inch = file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=-1001078401111"."&user_id=".$chat_id);
$inch2 = file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=@ch_jockdoni"."&user_id=".$chat_id);

if (strpos($inch , '"status":"left"') !== false  && strpos($inch2 , '"status":"left"') !== false ) {
    bridge("sendMessage",[
        'chat_id'=>$chat_id,
        'text'=>"برای استفاده از ربات اول در کانال ما عضو شوید.
https://t.me/joinchat/AAAAAEBHGFeui52gAzfbcg
و
@ch_jockdoni
--------------
Use A Start Bot By Join To Below Id
https://t.me/joinchat/AAAAAEBHGFeui52gAzfbcg
And 
@ch_jockdoni"

    ]);
}else {
    if ($lang == "" || $lang == "en") {
//        language English
        if (preg_match('/^\/(100)/', $text)) {
            $a100 = str_replace("/100", "", $text);
            $c100 = str_replace(" ", "%20", $a100);
            $b100 = "https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=$c100%2F&choe=UTF-8";
            onyx("sendPhoto", [
                'chat_id' => $chat_id,
                'photo' => $b100,
                'caption' => "@QRCOBOT Create Qr"
            ]);
        } elseif (preg_match('/^\/(200)/', $text)) {
            $a200 = str_replace("/200", "", $text);
            $c200 = str_replace(" ", "%20", $a200);
            $b200 = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$c200%2F&choe=UTF-8";
            onyx("sendPhoto", [
                'chat_id' => $chat_id,
                'photo' => $b200,
                'caption' => "@QRCOBOT Create Qr Code"
            ]);
        } elseif (preg_match('/^\/(300)/', $text)) {
            $a300 = str_replace("/300", "", $text);
            $c300 = str_replace(" ", "%20", $a300);
            $b300 = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$c300%2F&choe=UTF-8";
            onyx("sendPhoto", [
                'chat_id' => $chat_id,
                'photo' => $b300,
                'caption' => "@QRCOBOT Create Qr Code"
            ]);
        } elseif (preg_match('/^\/(400)/', $text)) {
            $a400 = str_replace("/400", "", $text);
            $c400 = str_replace(" ", "%20", $a400);
            $b400 = "https://chart.googleapis.com/chart?chs=400x400&cht=qr&chl=$c400%2F&choe=UTF-8";
            onyx("sendPhoto", [
                'chat_id' => $chat_id,
                'photo' => $b400,
                'caption' => "@QRCOBOT Create Qr Code"
            ]);
        } elseif (preg_match('/^\/(500)/', $text)) {
            $a500 = str_replace("/500", "", $text);
            $c500 = str_replace(" ", "%20", $a500);
            $b500 = "https://chart.googleapis.com/chart?chs=500x500&cht=qr&chl=$c500%2F&choe=UTF-8";
            onyx("sendPhoto", [
                'chat_id' => $chat_id,
                'photo' => $b500,
                'caption' => "@QRCOBOT Create Qr Code"
            ]);
        } elseif ($text == "/start" || $text == "/reset") {
            onyx("sendMessage", [
                'chat_id' => $chat_id,
                'text' => "Hello $name
        Please Type TEXT Next Commands
        /100 [TEXT]
        /200 [TEXT]
        /300 [TEXT]
        /400 [TEXT]
        /500 [TEXT]
        
        e.g 
        /300 Test Text
        or
        /500 Test Text
        
        other Size 
        Send Number And Reply Message And Send Text
        e.g
        Send Number '1000'
        Reply Message '1000' And Send Text Qr Code
        
        Max Size '540'
        
        tip❗️:Enter a new line problem and not get QRCODE
        
                تغییر زبان به فارسی /lang_fa",
                'reply_markup' => json_encode([
                    'inline_keyboard' => [
                        [['text' => 'Switch Inline Create QR', 'switch_inline_query' => 'Your Message']],
                        [['text' => 'Creators🤔', 'callback_data' => 'creators']],
                        [['text' => 'Switch Inline Current Chat', 'switch_inline_query_current_chat' => 'Text']]
                    ]
                ])
            ]);

        } elseif ($data == "creators") {
            onyx("editmessagetext", [
                'chat_id' => $ch_id,
                'message_id' => $msg_id,
                'text' => "Created By : @Mench
        @MenchPMbot 
        @ch_jockdoni",
                'reply_markup' => json_encode(['inline_keyboard' => [
                    [['text' => 'Switch Inline Create QR', 'switch_inline_query' => 'Your Message']],
                    [['text' => 'Menu', 'callback_data' => 'menu']],
                    [['text' => 'Switch Inline Current Chat', 'switch_inline_query_current_chat' => 'Text']]
                ]])
            ]);
        } elseif ($data == "menu") {
            onyx("editmessagetext", [
                'chat_id' => $ch_id,
                'message_id' => $msg_id,
                'text' => "Hello $nameca
        Please Type TEXT Next Commands
        /100 [TEXT]
        /200 [TEXT]
        /300 [TEXT]
        /400 [TEXT]
        /500 [TEXT]
        
        e.g 
        /300 Test Text
        or
        /500 Test Text
        
        other Size 
        Send Number And Reply Message And Send Text
        e.g
        Send Number '540'
        Reply Message '540' And Send Text Qr Code
        
        Max Size '540'
        
        tip❗️:Enter a new line problem and not get QRCODE
        
        تغییر زبان به فارسی /lang_fa",
                'reply_markup' => json_encode(['inline_keyboard' => [
                    [['text' => 'Switch Inline Create QR', 'switch_inline_query' => 'Your Message']],
                    [['text' => 'Creators🤔', 'callback_data' => 'creators']],
                    [['text' => 'Switch Inline Current Chat', 'switch_inline_query_current_chat' => 'Text']]
                ]])
            ]);
        } elseif ($text == "/lang_fa") {
            file_put_contents("mem/$chat_id/lang.txt", "fa");
            onyx("sendMessage", [
                'chat_id' => $ch_id,
                'text' => "زبان ربات به فارسی تبدیل شد. "
            ]);
        } elseif ($text == "/lang_en") {
            onyx("sendMessage", [
                'chat_id' => $ch_id,
                'text' => "Language Chaenge To English"
            ]);
        }elseif (is_numeric($text) == true) {
            onyx("sendMessage", [
                'chat_id' => $ch_id,
                'text' => "Reply Message And Send Text in Qr Code"
            ]);
        } elseif (isset($update->message->reply_to_message)) {
            $reptext = $update->message->reply_to_message->text;
            $cc = str_replace(" ", "%20", $text);
            $bb = "https://chart.googleapis.com/chart?chs=" . $reptext . "x" . $reptext . "&cht=qr&chl=$cc%2F&choe=UTF-8";
            onyx("sendPhoto", [
                'chat_id' => $chat_id,
                'photo' => $bb,
                'caption' => "@QRCOBOT Create Qr Code"
            ]);
        } elseif (preg_match('/^\/([Ss]endtoall)/', $text) && $chat_id == $admin) {
            $strh = str_replace("/sendtoall", "", $text);
            $ttxtt = file_get_contents('Member.txt');
            $membersidd = explode("\n", $ttxtt);
            for ($y = 0; $y < count($membersidd); $y++) {
                onyx("sendMessage", [
                    'chat_id' => $membersidd[$y],
                    "text" => $strh,
                    "parse_mode" => "HTML"
                ]);
            }
            $memcout = count($membersidd) - 1;
            onyx("sendMessage", [
                'chat_id' => $admin,
                "text" => "Messaeged Send To $memcout Members:-[)",
                "parse_mode" => "HTML"
            ]);
        } elseif (preg_match('/^\/([Ff]ortoall)/', $text) && $chat_id == $admin) {
            $ttxttt = file_get_contents('Member.txt');
            $membersidd2 = explode("\n", $ttxttt);

            for ($y = 0; $y < count($membersidd2); $y++) {
                onyx("forwardmessage", [
                    'chat_id' => $membersidd2[$y],
                    'from_chat_id' => $chat_id,
                    'message_id' => $update->message->reply_to_message->message_id
                ]);
            }

            $memcout = count($membersidd) - 1;
            onyx("sendMessage", [
                'chat_id' => $admin,
                "text" => "Forward Message To $memcout Member",
                "parse_mode" => "HTML"
            ]);
        } elseif ($text == "/state" && $chat_id == $admin) {
            $user = file_get_contents('Member.txt');
            $member_id = explode("\n", $user);
            $member_count = count($member_id) - 1;
            onyx('sendMessage', [
                'chat_id' => $chat_id,
                'text' => "Count All Member : 
        $member_count",
                'parse_mode' => 'HTML'
            ]);
        } elseif ($text == "/photo") {
            $fi = json_decode(file_get_contents("https://api.telegram.org/bot" . API_KEY . "/getUserProfilePhotos?user_id=$chat_id"));
            $gf = json_decode(file_get_contents("https://api.telegram.org/bot" . API_KEY . "/getFile?file_id=" . $fi->result->photos->file_id));
            $file = json_decode(file_get_contents("https://api.telegram.org/file/bot" . API_KEY . "/" . $gf->result->file_path));
            onyx("sendPhoto", [
                'chat_id' => $chat_id,
                'photo' => $gf->result->file_id
            ]);
        }elseif(isset($update->photo)){

        } else {
            $x = $text;

            if (contains("NAME", $x)) {
                $x = str_replace("NAME", $name, $x);
            }
            if (contains("CHID", $x)) {
                $x = str_replace("CHID", $chat_id, $x);
            }

            onyx("sendMessage", [
                'chat_id' => $chat_id,
                'text' => $x . "
      Not Found :-[)"
            ]);
        }

        $user = file_get_contents('Member.txt');
        $members = explode("\n", $user);
        if (!in_array($chat_id, $members)) {
            $add_user = file_get_contents('Member.txt');
            $add_user .= $chat_id . "\n";
            file_put_contents('Member.txt', $add_user);
        }


    } elseif ($lang == "fa") {
        // Language Persian
        if (preg_match('/^\/(100)/', $text)) {
            $a100 = str_replace("/100", "", $text);
            $c100 = str_replace(" ", "%20", $a100);
            $b100 = "https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=$c100%2F&choe=UTF-8";
            onyx("sendPhoto", [
                'chat_id' => $chat_id,
                'photo' => $b100,
                'caption' => "@QRCOBOT ساخت بارکد"
            ]);
        } elseif (preg_match('/^\/(200)/', $text)) {
            $a200 = str_replace("/200", "", $text);
            $c200 = str_replace(" ", "%20", $a200);
            $b200 = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$c200%2F&choe=UTF-8";
            onyx("sendPhoto", [
                'chat_id' => $chat_id,
                'photo' => $b200,
                'caption' => "@QRCOBOT ساخت بارکد"
            ]);
        } elseif (preg_match('/^\/(300)/', $text)) {
            $a300 = str_replace("/300", "", $text);
            $c300 = str_replace(" ", "%20", $a300);
            $b300 = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$c300%2F&choe=UTF-8";
            onyx("sendPhoto", [
                'chat_id' => $chat_id,
                'photo' => $b300,
                'caption' => "@QRCOBOT ساخت بارکد"
            ]);
        } elseif (preg_match('/^\/(400)/', $text)) {
            $a400 = str_replace("/400", "", $text);
            $c400 = str_replace(" ", "%20", $a400);
            $b400 = "https://chart.googleapis.com/chart?chs=400x400&cht=qr&chl=$c400%2F&choe=UTF-8";
            onyx("sendPhoto", [
                'chat_id' => $chat_id,
                'photo' => $b400,
                'caption' => "@QRCOBOT ساخت بارکد"
            ]);
        } elseif (preg_match('/^\/(500)/', $text)) {
            $a500 = str_replace("/500", "", $text);
            $c500 = str_replace(" ", "%20", $a500);
            $b500 = "https://chart.googleapis.com/chart?chs=500x500&cht=qr&chl=$c500%2F&choe=UTF-8";
            onyx("sendPhoto", [
                'chat_id' => $chat_id,
                'photo' => $b500,
                'caption' => "@QRCOBOT ساخت بارکد"
            ]);
        } elseif ($text == "/start" || $text == "/reset") {
            onyx("sendMessage", [
                'chat_id' => $chat_id,
                'text' => "سلام $name
            متن خود را پس از دستورات زیر وارد کنید
        /100 [متن]
        /200 [متن]
        /300 [متن]
        /400 [متن]
        /500 [متن]
        
        برای مثال 
        /300 سلام
        یا
        /500 سلام
        
       اندازه های دیگر 
        ابتدا سایز عکس را ارسال کنید و سپس ریپلای کنید و متن بارکد را وارد کنید
        
        مثلا :
        ارسال کنید عدد '540'
        سپس پیام خود را ریپلای کنید و متن بار کد را ارسال کنید
        
        حداکثر اندازه '540'
        
        نکته❗️:اینتر مشکلی در ساخت عکس ایجاد میکند
        
              Chenge To English Language /lang_en",
                'reply_markup' => json_encode([
                    'inline_keyboard' => [
                        [['text' => 'حالت اینلاین برای ساخت بارکد', 'switch_inline_query' => 'متن شما']],
                        [['text' => 'سازندگان', 'callback_data' => 'creators2']],
                        [['text' => 'حالت اینلاین در همین چت', 'switch_inline_query_current_chat' => 'متن']]
                    ]
                ])
            ]);

        } elseif ($data == "creators2") {
            onyx("editmessagetext", [
                'chat_id' => $ch_id,
                'message_id' => $msg_id,
                'text' => "ساخته شده توسط : @Mench
        @MenchPMbot 
        @ch_jockdoni",
                'reply_markup' => json_encode(['inline_keyboard' => [
                    [['text' => 'حالت اینلاین برای ساخت بارکد', 'switch_inline_query' => 'Your Message']],
                    [['text' => 'منو', 'callback_data' => 'menu2']],
                    [['text' => 'حالت اینلاین در همین چت', 'switch_inline_query_current_chat' => 'Text']]
                ]])
            ]);
        } elseif ($data == "menu2") {
            onyx("editmessagetext", [
                'chat_id' => $ch_id,
                'message_id' => $msg_id,
                'text' => "سلام $name
            متن خود را پس از دستورات زیر وارد کنید
        /100 [متن]
        /200 [متن]
        /300 [متن]
        /400 [متن]
        /500 [متن]
        
        برای مثال 
        /300 سلام
        یا
        /500 سلام
        
       اندازه های دیگر 
        ابتدا سایز عکس را ارسال کنید و سپس ریپلای کنید و متن بارکد را وارد کنید
        
        مثلا :
        ارسال کنید عدد '540'
        سپس پیام خود را ریپلای کنید و متن بار کد را ارسال کنید
        
        حداکثر اندازه '540'
        
        نکته❗️:اینتر مشکلی در ساخت عکس ایجاد میکند
        
              Chenge To English Language /lang_en",
                'reply_markup' => json_encode(['inline_keyboard' => [
                    [['text' => 'حالت اینلاین برای ساخت بارکد', 'switch_inline_query' => 'متن شما']],
                    [['text' => 'سازندگان', 'callback_data' => 'creators2']],
                    [['text' => 'حالت اینلاین در همین چت', 'switch_inline_query_current_chat' => 'متن']]
                ]])
            ]);
        } elseif ($text == "/lang_en") {
            file_put_contents("mem/$chat_id/lang.txt", "en");
            onyx("sendMessage", [
                'chat_id' => $ch_id,
                'text' => "Language To Chenge English"
            ]);
        } elseif ($text == "/lang_fa") {
            onyx("sendMessage", [
                'chat_id' => $ch_id,
                'text' => "زبان به فارسی تبدیل شد. "
            ]);
        } elseif (is_numeric($text) == true) {
            onyx("sendMessage", [
                'chat_id' => $ch_id,
                'text' => "پیام خود را ریپلای کنید و متن بارکد را بفرستید"
            ]);
        } elseif (isset($update->message->reply_to_message)) {
            $reptext = $update->message->reply_to_message->text;
            $cc = str_replace(" ", "%20", $text);
            $bb = "https://chart.googleapis.com/chart?chs=" . $reptext . "x" . $reptext . "&cht=qr&chl=$cc%2F&choe=UTF-8";
            onyx("sendPhoto", [
                'chat_id' => $chat_id,
                'photo' => $bb,
                'caption' => "@QRCOBOT ساخت بارکد"
            ]);
        } elseif (preg_match('/^\/([Ss]endtoall)/', $text) && $chat_id == $admin) {
            $strh = str_replace("/sendtoall", "", $text);
            $ttxtt = file_get_contents('Member.txt');
            $membersidd = explode("\n", $ttxtt);
            for ($y = 0; $y < count($membersidd); $y++) {
                onyx("sendMessage", [
                    'chat_id' => $membersidd[$y],
                    "text" => $strh,
                    "parse_mode" => "HTML"
                ]);
            }
            $memcout = count($membersidd) - 1;
            onyx("sendMessage", [
                'chat_id' => $admin,
                "text" => "پیام شما به  $memcout عضو ارسال شد",
                "parse_mode" => "HTML"
            ]);
        } elseif (preg_match('/^\/([Ff]ortoall)/', $text) && $chat_id == $admin) {
            $ttxtt = file_get_contents('Member.txt');
            $membersidd = explode("\n", $ttxtt);

            for ($y = 0; $y < count($membersidd); $y++) {
                onyx("forwardmessage", [
                    'chat_id' => $membersidd[$y],
                    'from_chat_id' => $chat_id,
                    'message_id' => $update->message->reply_to_message->message_id
                ]);
            }

            $memcout = count($membersidd) - 1;
            onyx("sendMessage", [
                'chat_id' => $admin,
                "text" => "فوروارد شد پیام شما به $memcout عضو ",
                "parse_mode" => "HTML"
            ]);
        } elseif ($text == "/state" && $chat_id == $admin) {
            $user = file_get_contents('Member.txt');
            $member_id = explode("\n", $user);
            $member_count = count($member_id) - 1;
            onyx('sendMessage', [
                'chat_id' => $chat_id,
                'text' => "تعداد همه اعضا : 
        $member_count",
                'parse_mode' => 'HTML'
            ]);
        } elseif ($text == "/photo") {
            $fi = json_decode(file_get_contents("https://api.telegram.org/bot" . API_KEY . "/getUserProfilePhotos?user_id=$chat_id"));
            $gf = json_decode(file_get_contents("https://api.telegram.org/bot" . API_KEY . "/getFile?file_id=" . $fi->result->photos->file_id));
            $file = json_decode(file_get_contents("https://api.telegram.org/file/bot" . API_KEY . "/" . $gf->result->file_path));
            onyx("sendPhoto", [
                'chat_id' => $chat_id,
                'photo' => $gf->result->file_id
            ]);
        } else {
            $x = $text;

            if (contains("NAME", $x)) {
                $x = str_replace("NAME", $name, $x);
            }
            if (contains("CHID", $x)) {
                $x = str_replace("CHID", $chat_id, $x);
            }

            onyx("sendMessage", [
                'chat_id' => $chat_id,
                'text' => $x . "
     متن یافت نشد"
            ]);
        }
    }
    // Inline Query

    $qt = $update->inline_query->query;
    $qi = $update->inline_query->id;


    $a = str_replace(" ", "%20", $qt);
    $i100 = "https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=$a%2F&choe=UTF-8";
    $i200 = "https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=$a%2F&choe=UTF-8";
    $i300 = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$a%2F&choe=UTF-8";
    $i400 = "https://chart.googleapis.com/chart?chs=400x400&cht=qr&chl=$a%2F&choe=UTF-8";
    $i500 = "https://chart.googleapis.com/chart?chs=500x500&cht=qr&chl=$a%2F&choe=UTF-8";

    onyx('answerInlineQuery', [
        'inline_query_id' => $qi,
        'switch_pm_text' => "Start Robot",
        'results' => json_encode([[
            'type' => 'photo',
            'id' => base64_encode(rand(5, 555)),
            'title' => 'Qr Code 100 * 100',
            'photo_url' => $i100,
            'thumb_url' => $i100,
            'description' => "@QRCOBOT",
            'caption' => "@QRCOBOT Create Qr Code",
            'reply_markup' => [
                'inline_keyboard' => [
                    [
                        ['text' => "Create Qr Code", 'url' => 'http://t.me/qrcobot']
                    ],
                    [['text' => 'Switch Inline Current Chat', 'switch_inline_query_current_chat' => 'Text']]
                ]
            ]

        ], [
            'type' => 'photo',
            'id' => base64_encode(rand(5, 555)),
            'title' => 'Qr Code 200 * 200',
            'photo_url' => $i200,
            'thumb_url' => $i200,
            'description' => "@QRCOBOT",
            'caption' => "@QRCOBOT Create Qr Code",
            'reply_markup' => [
                'inline_keyboard' => [
                    [
                        ['text' => "Create Qr Code", 'url' => 'http://t.me/qrcobot']
                    ],
                    [['text' => 'Switch Inline Current Chat', 'switch_inline_query_current_chat' => 'Text']]
                ]
            ]

        ], [
            'type' => 'photo',
            'id' => base64_encode(rand(5, 555)),
            'title' => 'Qr Code 300 * 300',
            'photo_url' => $i300,
            'thumb_url' => $i300,
            'description' => "@QRCOBOT",
            'caption' => "@QRCOBOT Create Qr Code",
            'reply_markup' => [
                'inline_keyboard' => [
                    [
                        ['text' => "Create Qr Code", 'url' => 'http://t.me/qrcobot']
                    ],
                    [['text' => 'Switch Inline Current Chat', 'switch_inline_query_current_chat' => 'Text']]
                ]
            ]

        ], [
            'type' => 'photo',
            'id' => base64_encode(rand(5, 555)),
            'title' => 'Qr Code 400 * 400',
            'photo_url' => $i400,
            'thumb_url' => $i400,
            'description' => "@QRCOBOT",
            'caption' => "@QRCOBOT Create Qr Code",
            'reply_markup' => [
                'inline_keyboard' => [
                    [
                        ['text' => "Create Qr Code", 'url' => 'http://t.me/qrcobot']
                    ],
                    [['text' => 'Switch Inline Current Chat', 'switch_inline_query_current_chat' => 'Text']]
                ]
            ]

        ], [
            'type' => 'photo',
            'id' => base64_encode(rand(5, 555)),
            'title' => 'Qr Code 500 * 500',
            'photo_url' => $i500,
            'thumb_url' => $i500,
            'description' => "@QRCOBOT",
            'caption' => "@QRCOBOT Create Qr Code",
            'reply_markup' => [
                'inline_keyboard' => [
                    [
                        ['text' => "Create Qr Code", 'url' => 'http://t.me/qrcobot']
                    ],
                    [['text' => 'Switch Inline Current Chat', 'switch_inline_query_current_chat' => 'Text']]
                ]
            ]

        ]])
    ]);
}
