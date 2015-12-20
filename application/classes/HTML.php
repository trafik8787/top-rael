<?php defined('SYSPATH') OR die('No direct script access.');

class HTML extends Kohana_HTML {

    public static function x($message, $die = false, $title = false, $access = true, $color = '#008B8B')
    {

        ?>
    <table border="0" cellpadding="5" cellspacing="0" style="border:1px solid <?= $color ?>;margin:2px; text-align: left;">
        <tr>
            <td>
                <?

                if (strlen($title) > 0) {
                    echo '<p style="color:' . $color . ';font-size:11px;font-family:Verdana;">[' . $title . ']</p>';
                }

                if (is_array($message) || is_object($message)) {
                    echo '<pre style="color:' . $color . ';font-size:11px;font-family:Verdana;">';
                    print_r($message);
                    echo '</pre>';
                } else {
                    echo '<p style="color:' . $color . ';font-size:11px;font-family:Verdana;">' . var_dump($message) . '</p>';
                }
                echo '</td></tr><tr><td>';
                echo '<div style="font-family:verdana; font-size: 10px; font-weight: normal">';
                $a = debug_backtrace();
                $a = $a[0];
                echo "{$a['file']}: {$a['line']}";
                echo '</div>';
                if ($die === true) {
                    die();
                }
                ?></td>
        </tr></table><?
    }


    /**
     * @param null $link
     * @return string
     * получаем полный урл вместе с HTTP
     */
    public static function HostSite ($link = null)
    {
        $str_link = 'http://' . $_SERVER['HTTP_HOST'];
        if ($link != null) {
            $str_link = 'http://' . $_SERVER['HTTP_HOST'] . $link;
        }

        return $str_link;
    }


    
}
