<?PHP
/*
=====================================================
 DataLife Engine - by SoftNews Media Group 
-----------------------------------------------------
 http://dle-news.ru/
-----------------------------------------------------
 Copyright (c) 2004,2012 SoftNews Media Group
=====================================================
 Данный код защищен авторскими правами
=====================================================
 Файл: bbcode.php
-----------------------------------------------------
 Назначение: Панель BB кодов
=====================================================
*/
if(!defined('DATALIFEENGINE'))
{
  die("Hacking attempt!");
}

  $i = 0;
  $output = "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\"><tr>";

    $smilies = explode(",", $config['smilies']);
    $count_smilies = count($smilies);

    foreach($smilies as $smile)
    {
        $i++; $smile = trim($smile);

        $output .= "<td style=\"padding:2px;\" align=\"center\"><a href=\"#\" onClick=\"dle_smiley(':$smile:'); return false;\"><img style=\"border: none;\" alt=\"$smile\" src=\"".$config['http_home_url']."engine/data/emoticons/$smile.gif\" /></a></td>";

    if ($i%4 == 0 AND $i < $count_smilies) $output .= "</tr><tr>";

    }

  $output .= "</tr></table>";

if ($addtype == "addnews") {

   $addform = "document.ajaxnews".$id; 
   $startform = "dleeditnews".$id;
   $p_name = urlencode($row['autor']);

   if ($is_logged AND $user_group[$member_id['user_group']]['allow_image_upload'])
   {
      $image_upload = "<div class=\"bbcode b-upload\" onclick=\"dle_image_upload( '{$p_name}', '{$add_id}' ); return false;\">upload</div>";

   } else $image_upload = "";

$code = <<<HTML
<div class="bbcode-editor">
  <div class="bbcode b-b" title="$lang[bb_t_b]" onclick="simpletag('b')">b</div>
  <div class="bbcode b-i" title="$lang[bb_t_i]" onclick="simpletag('i')">i</div>
  <div class="bbcode b-u" title="$lang[bb_t_u]" onclick="simpletag('u')">u</div>
  <div class="bbcode b-s" title="$lang[bb_t_s]" onclick="simpletag('s')">s</div>
  <div class="bbcode b-separator">|</div>
  <div class="bbcode b-img" title="$lang[bb_b_img]" onclick="tag_image()">img</div>
  {$image_upload}
  <div class="bbcode b-separator">|</div>
  <div class="bbcode b-emo" title="$lang[bb_t_emo]" onclick="ins_emo(this);">emo</div>
  <div class="bbcode b-separator">|</div>
  <div class="bbcode b-url" title="$lang[bb_t_url]" onclick="tag_url()">url</div>
  <div class="bbcode b-leech" title="$lang[bb_t_leech]" onclick="tag_leech()">leech</div>
  <div class="bbcode b-email" title="$lang[bb_t_m]" onclick="tag_email()">email</div>
  <div class="bbcode b-separator">|</div>
  <div class="bbcode b-video" title="$lang[bb_t_video]" onclick="tag_video()">video</div>
  <div class="bbcode b-audio" title="$lang[bb_t_audio]" onclick="tag_audio()">audio</div>
  <div class="bbcode b-separator">|</div>
  <div class="bbcode b-hide" title="$lang[bb_t_hide]" onclick="simpletag('hide')">hide</div>
  <div class="bbcode b-quote" title="$lang[bb_t_quote]" onclick="simpletag('quote')">quote</div>
  <div class="bbcode b-code" title="$lang[bb_t_code]"  onclick="simpletag('code')">code</div>
  <div class="bbcode b-separator">|</div>
  <div class="bbcode b-pagebreak" title="$lang[bb_t_br]" onclick="pagebreak()">pagebreak</div>
  <div class="bbcode b-pagelink" title="$lang[bb_t_p]" onclick="pagelink()">pagelink</div>
  <div class="clr"></div>
  <div class="b-font">
    <select name="bbfont" onchange="insert_font(this.options[this.selectedIndex].value, 'font')">
      <option value='0'>{$lang['bb_t_font']}</option>
      <option value='Arial'>Arial</option>
      <option value='Arial Black'>Arial Black</option>
      <option value='Century Gothic'>Century Gothic</option>
      <option value='Courier New'>Courier New</option>
      <option value='Georgia'>Georgia</option>
      <option value='Impact'>Impact</option>
      <option value='System'>System</option>
      <option value='Tahoma'>Tahoma</option>
      <option value='Times New Roman'>Times New Roman</option>
      <option value='Verdana'>Verdana</option>
    </select>
  </div>
  <div class="b-size">
    <select name="bbsize" onchange="insert_font(this.options[this.selectedIndex].value, 'size')">
      <option value='0'>{$lang['bb_t_size']}</option>
      <option value='1'>1</option>
      <option value='2'>2</option>
      <option value='3'>3</option>
      <option value='4'>4</option>
      <option value='5'>5</option>
      <option value='6'>6</option>
      <option value='7'>7</option>
    </select>
  </div>
  <div class="bbcode b-separator">|</div>
  <div class="bbcode b-left" title="$lang[bb_t_l]" onclick="simpletag('left')">left</div>
  <div class="bbcode b-center" title="$lang[bb_t_c]" onclick="simpletag('center')">center</div>
  <div class="bbcode b-right" title="$lang[bb_t_r]" onclick="simpletag('right')">right</div>
  <div class="bbcode b-separator">|</div>
  <div class="bbcode b-color" title="$lang[bb_t_color]" onclick="ins_color(this);">color</div>
  <div class="bbcode b-spoiler" title="$lang[bb_t_spoiler]" onclick="simpletag('spoiler')"></div>
  <div class="bbcode b-separator">|</div>
  <div class="bbcode b-flash" title="$lang[bb_t_flash]" onclick="tag_flash()">flash</div>
  <div class="bbcode b-youtube" title="$lang[bb_t_youtube]" onclick="tag_youtube()">youtube</div>
  <div class="bbcode b-uppod" title="$lang[bb_t_uppod]" onclick="tag_uppod()">uppod</div>
  <div class="bbcode b-typograf" title="$lang[bb_t_t]" onclick="tag_typograf(); return false;">typograf</div>
  <div class="bbcode b-separator">|</div>
  <div class="bbcode b-list" title="$lang[bb_t_list1]" onclick="tag_list('list')">list</div>
  <div id="b_ol" class="bbcode b-ol" title="$lang[bb_t_list2]" onclick="tag_list('ol')">ol</div>
</div>
  <div id="dle_emos" style="display: none;" title="{$lang['bb_t_emo']}"><div style="width:100%;height:100%;overflow: auto;">{$output}</div></div>
HTML;

}
else {

   $addform = "document.getElementById( 'dlemasscomments' )"; 
   $startform = "dleeditcomments".$id;

   if ($user_group[$member_id['user_group']]['allow_url'])
   {
      $url_link = "<div class=\"bbcode b-url\" title=\"$lang[bb_t_url]\"  onclick=\"tag_url()\">url</div><div class=\"bbcode b-leech\" title=\"$lang[bb_t_leech]\" onclick=\"tag_leech()\">leech</div>";
   } 
   else {$url_link = "";}

   if ($user_group[$member_id['user_group']]['allow_image'])
   {
      $image_link = "<div class=\"bbcode b-img\" title=\"$lang[bb_b_img]\" onclick=\"tag_image()\">img</div>";
   } 
   else $image_link = "";

$code = <<<HTML

  <div class="bbcode-editor">
    <div class="bbcode b-b" title="$lang[bb_t_b]" onclick="simpletag('b')">b</div>
    <div class="bbcode b-i" title="$lang[bb_t_i]" onclick="simpletag('i')">i</div>
    <div class="bbcode b-u" title="$lang[bb_t_u]" onclick="simpletag('u')">u</div>
    <div class="bbcode b-s" title="$lang[bb_t_s]" onclick="simpletag('s')">s</div>
    <div class="bbcode b-separator">|</div>
    <div class="bbcode b-left" title="$lang[bb_t_l]" onclick="simpletag('left')">left</div>
    <div class="bbcode b-center" title="$lang[bb_t_c]" onclick="simpletag('center')">center</div>
    <div class="bbcode b-right" title="$lang[bb_t_r]" onclick="simpletag('right')">right</div>
    <div class="bbcode b-separator">|</div>
    <div class="bbcode b-emo" title="$lang[bb_t_emo]" onclick="ins_emo(this);">emo</div>
    {$url_link}
    {$image_link}
    <div class="bbcode b-color" title="$lang[bb_t_color]" onclick="ins_color(this);">color</div>      
    <div class="bbcode b-separator">|</div>
    <div class="bbcode b-hide" title="$lang[bb_t_hide]" onclick="simpletag('hide')">hide</div>
    <div class="bbcode b-quote" title="$lang[bb_t_quote]" onclick="simpletag('quote')">quote</div>

    <div class="bbcode b-translit" title="$lang[bb_t_translit]" onclick="translit()">translit</div>
    <div class="bbcode b-spoiler" title="$lang[bb_t_spoiler]" onclick="simpletag('spoiler')"></div>
  </div>
  <div id="dle_emos" style="display: none;" title="{$lang['bb_t_emo']}"><div style="width:100%;height:100%;overflow: auto;">{$output}</div></div>

HTML;
}


$script_code = @file_get_contents(ENGINE_DIR."/classes/js/bbcodes.js");
$script_code .= <<<HTML
/*Вставка медиа через uppod*/
function tag_uppod() {
    var a = get_sel(eval("fombj." + selField));
    a || (a = "http://");
    DLEprompt(text_enter_url, a, dle_prompt, function (a) {
    DLEprompt(text_enter_name_uppod, "Noname", dle_prompt, function (b) {
      doInsert("[uppod=" + a +"|" + b + "]", "", !1);
      ie_range_cache = null
    })  
    })
}
</script>
HTML;

$code = str_replace ("{THEME}", $config['http_home_url'] . 'templates/' . $config['skin'], $code);

$image_align = array ();
$image_align[$config['image_align']] = "selected";

$bb_code = <<<HTML
<script>
var text_enter_name_uppod = "$lang[name_uppod]";
var text_enter_url        = "$lang[bb_url]";
var text_enter_size       = "$lang[bb_flash]";
var text_enter_flash      = "$lang[bb_flash_url]";
var text_enter_page       = "$lang[bb_page]";
var text_enter_url_name   = "$lang[bb_url_name]";
var text_enter_page_name  = "$lang[bb_page_name]";
var text_enter_image      = "$lang[bb_image]";
var text_enter_email      = "$lang[bb_email]";
var text_code             = "$lang[bb_code]";
var text_quote            = "$lang[bb_quote]";
var text_upload           = "$lang[bb_t_up]";
var error_no_url          = "$lang[bb_no_url]";
var error_no_title        = "$lang[bb_no_title]";
var error_no_email        = "$lang[bb_no_email]";
var prompt_start          = "$lang[bb_prompt_start]";
var img_title             = "$lang[bb_img_title]";
var email_title           = "$lang[bb_email_title]";
var text_pages            = "$lang[bb_bb_page]";
var image_align           = "{$config['image_align']}";
var bb_t_emo              = "{$lang['bb_t_emo']}";
var bb_t_col              = "{$lang['bb_t_col']}";
var text_enter_list       = "{$lang['bb_list_item']}";
var text_alt_image        = "{$lang['bb_alt_image']}";
var img_align             = "{$lang['images_align']}";
var img_align_sel         = "<select name='dleimagealign' id='dleimagealign' class='ui-widget-content ui-corner-all'><option value='' {$image_align[0]}>{$lang['images_none']}</option><option value='left' {$image_align['left']}>{$lang['images_left']}</option><option value='right' {$image_align['right']}>{$lang['images_right']}</option><option value='center' {$image_align['center']}>{$lang['images_center']}</option></select>";

var selField              = "{$startform}";
var fombj                 = {$addform};

{$script_code}
{$code}
HTML;

?>