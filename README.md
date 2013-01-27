adequate-bbcode-dle & uppod для DLE 9.7
===================

AdequateBBcode + Uppod - Адекватный bbcode-редактор для DataLife Engine 9.7 с интеграцией Uppod плеера

### Ссылки
[Автор модификации](http://pafnuty.name/ "ПафНутиЙ")
[Видео-демонстрация](http://youtu.be/n0dpP2oy0v0 "Видео-демонстрация добавления/редактирования медиа")

[Официальная страница модуля] (http://pafnuty.name/modules/135-adequate-bbcode.html "Официальная страница модуля")

[Официальная страница Uppod] (http://uppod.ru/ "Официальная страница плеера Uppod")


Для чего это?
-------------------
* Для удобной кастомизации внешнего вида bbcode-редактора, идущего в комплекте с DLE.
* Для оптимизации работы движка (уменьшается количество http-запросов, т.к. редактор использует только одну картинку).
* Для самоуспокоения (надоел же этот стандартный, ущрбный внешний вид).
* Для вывода видео и аудио в красивом плеере Uppod.

Особенности реализации работы с плеером (отличия от других интеграций)
-------------------
* Не портит существующий функционал (отдельная кнопка для вставки медиа через uppod).
* Удобная кастомизация плеера (скины аудио и видео лежат в папке шаблона).
* Можно задавать размер плеера, название композиции, картинку-заглушку.
* Автоматическое определение музыки и применение соответствующего скина.

Внешний вид
-------------------
Добавление новостей

![Добавление новостей](https://raw.github.com/pafnuty/adequate-bbcode-dle/tree/with_uppod/addnews.png)


добавление комментариев

![Добавление комментариев](https://raw.github.com/pafnuty/adequate-bbcode-dle/tree/with_uppod/addcomment.png)



Установка
-------------------
* Сделать резервную копию файлов `engine/modules/bbcode.php`, `engine/ajax/bbcode.php`, `engine/classes/parce.class.php`, `language/Russian/website.lng`, `bbcodes/color.html`. 
* Залить содержимое папки uploads в корень сайта (если требутся - изменить название шаблона на свой). 
* Открыть main.tpl и перед `</head>` прописать:

```
<link media="screen" href="{THEME}/style/bbcodes.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="{THEME}/js/tooltip.js"></script>
```
* Открыть файл `engine/classes/parce.class.php`, найти:

```
$source = preg_replace( "#\[media=([^\]]+)\]#ies", "\$this->build_media('\\1')", $source );
```
Ниже вставить:
```
/*** Подключение uppod плеера by ПафНутиЙ ***/
$source = preg_replace( "#\[uppod=([^\]]+)\]#ies", "\$this->build_uppod('\\1')", $source );
/*** Подключение uppod плеера by ПафНутиЙ ***/
```

Далее найти:
```
$txt = preg_replace( "#<!--dle_media_begin:(.+?)-->(.+?)<!--dle_media_end-->#is", '[media=\\1]', $txt );
```
Ниже вставить:
```
/*** Подключение uppod плеера by ПафНутиЙ ***/
$txt = preg_replace( "#<!--dle_uppod_begin:(.+?)-->(.+?)<!--dle_uppod_end-->#is", '[uppod=\\1]', $txt );
/*** Подключение uppod плеера by ПафНутиЙ ***/
```

Далее найти:
```
function build_url($url = array()) {
```
*ВЫШЕ* вставить:
```
	/*** Подключение uppod плеера by ПафНутиЙ ***/
	function build_uppod($url) {
		global $config;
		if (!count($this->video_config)) {
			include (ENGINE_DIR . '/data/videoconfig.php');
			$this->video_config = $video_config;
		}

		$get_size = explode( ",", trim( $url ) );
		$sizes = array();

		if (count($get_size) == 2)  {
			$url = $get_size[1];
			$sizes = explode('x', trim( $get_size[0]));
			$width = intval($sizes[0]) > 0 ? intval($sizes[0]) : $this->video_config['width'];
			$height = intval($sizes[1]) > 0 ? intval($sizes[1]) : $this->video_config['height'];

			if (substr($sizes[0], - 1, 1 ) == '%') $width = $width."%";
			if (substr($sizes[1], - 1, 1 ) == '%') $height = $height."%";

		} else {
			$width = $this->video_config['width'];
			$height = $this->video_config['height'];
		}
	
		if($url == '') return;

		$option = explode('|', trim($url));

		$url = $this->clear_url($option[0]);

		$type = explode(".", $url);
		$type = strtolower(end($type));

		$decode_url = $url;

		if($option[1] != '') {			
			$option[1] = htmlspecialchars(strip_tags( stripslashes($option[1])), ENT_QUOTES, $config['charset']);
			$decode_url = $url.'|'.$option[1];	
		} 
		if ($option[2] != '') {			
			$option[2] = htmlspecialchars(strip_tags( stripslashes($option[2])), ENT_QUOTES, $config['charset']);
			$decode_url = $url.'|'.$option[1].'|'.$option[2];	
		} 

		$uppod_size = '';
		if ( count($sizes) == 2 ) {
			$decode_url = $width.'x'.$height.','.$decode_url;
			$uppod_size = 'style="width:'.$width.'px; height:'.$height.'px;"';
		}
		
		$preview = '';		
		if ($this->video_config['preview']) $preview = '&amp;poster={THEME}/uppod/preview.png';
		if ($this->video_config['startframe']) $preview = '';
		if($option[2] != '') $preview = '&amp;poster='.$option[2];

		$uppod_name = 'Noname';
		if($option[1] != '') $uppod_name = $option[1];

		$id_player = md5( microtime() );

		$player_type = '<param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" />';
		$style_type = 'style_video';

		if($type == 'ogg' or $type == 'mp3' or $type == 'aac') {
			$player_type = '';
			$style_type = 'style_audio';
			$preview = '';
		}
		
		return '<!--dle_uppod_begin:'.$decode_url.'-->
				<object class="uppod_'.$style_type.'" id="uppod_video_'.$id_player.'" type="application/x-shockwave-flash" data="{THEME}/uppod/uppod.swf" '.$uppod_size.'>
					<param name="bgcolor" value="#000000" />
					'.$player_type.'
					<param name="movie" value="{THEME}/uppod/uppod.swf" />
					<param name="flashvars" value="comment='.$uppod_name.'&amp;st={THEME}/uppod/'.$style_type.'.txt&amp;file='.$url.$preview.'" />
				</object>
				<!--dle_uppod_end-->';
	
	}
	/*** Подключение uppod плеера by ПафНутиЙ ***/
```

* Открыть файл `language/Russian/website.lng`, найти:
```
'wysiwyg_language'	=>  "ru",
```
Ниже вставить:
```
// Подключение uppod плеера by ПафНутиЙ
'name_uppod'		=> "Введите название видео (оно будет отображаться в плеере, если это предусмотренно скином)",
'bb_t_uppod'		=> "Вставка видео или аудио через Uppod плеер",
```

* Открыть любой css-файл (в дефолтном шаблоне это `style/styles.css`), в конец файла вставить:
```
/*Задаём размеры плееру Uppod, если они не заданы в теге
Эти размеры нужно менять под собственный дизайн или скин плеера*/
.uppod_style_video {
  width: 500px;
  height: 375px;
}
.uppod_style_audio {
	width: 500px;
	height: 60px;
}
```
* Всё!

Кастомизация 
-------------------
- В файле bbcodes.css лежат все стили, относящиеся к оформлению кнопок редактора.
- Файл bbcodes.less - для оытных пользователей (его можно удалить без проблем).
- Так же добавлена новая, симпотичная палитра для выбора цвета текста (`bbcodes/color.html`).

Кастомизация плеера
-------------------
- Всё, что относится к плееру лежит в  папке `templates/YOUR_TEMPLATE/uppod` (YOUR_TEMPLATE - заменить на имя своего шаблона)
- Для изменения скина _видео_ достаточно заменить содержимое файла `uppodstyle_video.txt`
- Для изменения скина _аудио_ достаточно заменить содержимое файла `uppodstyle_audio.txt`
- В зависимости от типа плеера ему присваивается класс _uppod_style_video_ или _uppod_style_audio_ так что можно спокойно оформлять плеер через CSS.
- Если не задана картинка-заглушка, то выведется деолтная `uppod/preview.png` (PSD этой картинки так же есть в архиве)

Параноикам
-------------------
* Изменения в php-файлах https://github.com/pafnuty/adequate-bbcode-dle/commit/a5307a567cbff1152b4fc98a1fb2ab88a30bb6ec
