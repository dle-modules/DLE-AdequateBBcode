adequate-bbcode-dle
===================

AdequateBBcode - Адекватный bbcode-редактор для DataLife Engine 9.7

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
* Залить содержимое папки uploads в корень сайта (если требутся - измеить название шаблона на свой).
* Открыть main.tpl и перед </head> прописать:

<link media="screen" href="{THEME}/style/bbcodes.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="{THEME}/js/tooltip.js"></script>

* Всё!
