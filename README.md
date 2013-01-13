adequate-bbcode-dle
===================

AdequateBBcode - Адекватный bbcode-редактор для DataLife Engine 9.7

### Автор
[ПафНутиЙ](http://pafnuty.name/ "Сайт автора")

[Официальная страница модуля] (http://pafnuty.name/modules/135-adequate-bbcode.html "Официальная страница модуля")


Для чего это?
-------------------
* Для удобной кастомизации внешнего вида bbcode-редактора, идущего в комплекте с DLE.
* Для оптимизации работы движка (уменьшается количество http-запросов, т.к. редактор использует только одну картинку).
* Для самоуспокоения (надоел же этот стандартный, ущрбный внешний вид).

Внешний вид
-------------------
Добавление новостей

![Добавление новостей](https://raw.github.com/pafnuty/adequate-bbcode-dle/master/addnews.png)


добавление комментариев

![Добавление комментариев](https://raw.github.com/pafnuty/adequate-bbcode-dle/master/addcomment.png)



Установка
-------------------
* Сделать резервныую копию файлов `engine/modules/bbcode.php` и `engine/ajax/bbcode.php` 
* Залить содержимое папки uploads в корень сайта (если требутся - изменить название шаблона на свой). 
* Открыть main.tpl и перед `</head>` прописать:

```
<link media="screen" href="{THEME}/style/bbcodes.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="{THEME}/js/tooltip.js"></script>
```
* Всё!

Кастомизация 
-------------------
- В файле bbcodes.css лежат все стили, относящиеся к оформлению кнопок редактора.
<<<<<<< HEAD
- Файл bootstrap.less - для оытных пользователей (его можно удалить без проблем).
- Так же добавлена новая, симпотичная палитра для выбора цвета текста.
=======
- Файл bbcodes.less - для оытных пользователей (его можно удалить без проблем).
>>>>>>> Обновил файл

Параноикам
-------------------
* Изменения в php-файлах https://github.com/pafnuty/adequate-bbcode-dle/commit/a5307a567cbff1152b4fc98a1fb2ab88a30bb6ec
