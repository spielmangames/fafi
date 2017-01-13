На горі свиснув рак - тебе запросили до клубу на посаду головного тренера :soccer:.

######Виклич гравців до складу
* дивись реєстр гравців [отуто](https://docs.google.com/spreadsheets/d/1jW637_G4hjuMGt9b3f44bjh0yl02jgMfh7wDB9-8AYo/edit#gid=0)
* неможливо запросити вже зайнятих гравців (дивись колонки AF:AJ)
* на гру дозволено буде возити не більш ніж 13 гравців (7 в основі, 6 на банці) `squad`
* візьми хоча б 1 на раму
* можна запросити до складу 1 класичного гравця
* не вийде переманити вихованця клубу, якщо той грає за рідний клуб

######Підготуй та налаштуй команду
* дай кожному гравцю номер
* признач капітана
* роздрукуй картки гравців та командну картку

######Проведи передматчевий збір
* на збори бери не більш ніж 13 гравців
* гравці приїздять у найгіршому стані `attack_level_base` та `defence_level_base`
* гравці з потенціалом мають можливість набрати трохи форми, але ризикують отримати пошкодження під час тренування
* капітан завжди має найкращу форму
* якщо маєш бажання, потренуй гравця
* тренуй кожного гравця окремо
* останнього воротника не тренуй, бо в разі пошкодження замінити його буде ніким
* закінчуй збори, якщо травмованих забагато: доведеться формувати склад з того, що є

######Тренуй гравця######
* кидай 1 кубик задля визначення рівня успішності тренування
    * якщо випало **1**, то це вкрай погане тренування: гравця травмовано
    * якщо випало **2**..**3**, закінчити тренування для цього гравця: не вдалось набрати додаткової форми, проте попередній рівень лишається
    * якщо випало **4**..**6**, тоді результат куди більш вдалий: гравець набирає бажане 1 очко потенціалу та можливість тренуватись далі
    * деякі гравці потребують особливої уваги, адже вони отримують пошкодження не тільки при **1**, а й при **6** (перетренування)
* якщо в гравця ще лишився потенціал, можеш тренувати його ще

######Підготуй стартовий склад до гри
* склади план на гру
    * план на гру має містити:
		* рівень моралі з урахуванням використаних карток
		* схема гравців (соответствие игроков позициям на поле)
		* малюнок атак з урахуванням використаних карток
		* используемые карточки с условиями их применения
*  тренери одночасно вскриваються, коли вони підготували свои плини на гру.

* схема.
	* стартові очки атаки/захисту команди = сума всіх очків атаки/захисту її гравців
	  у діючій схемі
	* якщо тренер меняет роли игроков в схеме, то его командные очки должны быть пересчитаны.
	* карти діють лише 1 матч. потім гравці забувают настанови тренера.

* малюнок атак.
	* тренер розподіляє небезпечні моменти team_attack_level по атакам
	* тренер може запланувати будь-яку кількість атак, але не більш, ніж рівень захисту суперника team_defence_level

* захист.
	* дія зазисту планується виходячи з побаченого плану атак суперника. тренер распределяет свои
	  очки обороны по атакам соперника.



######Мораль
* базовый рівень моралі на матч визначається результатом 1 попередньої гри (-1 після поразки, 0 після нічиєї, +1 після перемоги)
