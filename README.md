> На горі свиснув рак - тебе запросили до клубу на посаду головного тренера.

###### Виклич гравців до складу
* дивись реєстр гравців [отуто](https://docs.google.com/spreadsheets/d/1jW637_G4hjuMGt9b3f44bjh0yl02jgMfh7wDB9-8AYo/edit#gid=0)
* неможливо запросити вже зайнятих гравців (дивись колонки AF:AJ)
* на гру дозволено буде возити не більш ніж 13 гравців (7 в основі, 6 на банці)
* візьми хоча б 1 на раму
* можна запросити до складу 1 класичного гравця
* не вийде переманити вихованця клубу, якщо той грає за рідний клуб

###### Підготуй та налаштуй команду
* дай кожному гравцю номер
* признач капітана
* роздрукуй картки гравців та командну картку

###### Проведи передматчевий збір
* на збори бери не більш ніж 13 гравців
* гравці приїздять у найгіршому стані (тільки замальовані тактичні очки - базові)
* гравці з потенціалом мають можливість набрати трохи форми (порожні тактичні очки - потенціал), але ризикують отримати пошкодження під час тренування
* капітан завжди має найкращу форму
* якщо маєш бажання, потренуй гравця
* тренуй кожного гравця окремо
* останнього воротника не тренуй, бо в разі пошкодження замінити його буде ніким
* закінчуй збори, якщо травмованих забагато: доведеться формувати склад з того, що є

###### Тренуй гравця
* кидай 1 кубик задля визначення рівня успішності тренування:
	* якщо випало :one:, то це вкрай погане тренування: гравця травмовано, тому допомогти команді в наступній зустрічі він буде не в змозі
	* якщо випало :two:..:three:, закінчити тренування для цього гравця: йому не вдалось набрати додаткової форми, проте попередній рівень лишається (базові очки + вже набраний потенціал)
	* якщо випало :four:..:six:, тоді результат куди більш вдалий: гравець набирає бажане 1 очко потенціалу та можливість тренуватись далі
	* деякі гравці потребують особливої уваги, адже вони отримують пошкодження не тільки при :one:, а й при :six: (перетренування)
* якщо в гравця ще лишився потенціал, можеш тренувати його ще

###### Підготуй команду до гри
* склади план на гру:
	* схема (табличка гравців по позиціям, номерам, іменам)
		* стартові очки атаки/захисту команди = сума всіх очків атаки/захисту її гравців у діючій схемі
		* якщо тренер змінює роль гравця в схемі, тоді командні очки мають бути перераховані
	* малюнок атак з урахуванням використаних карток:
		* `attackPotential` кількість потенційних небезпечних моментів = сума всіх очків атаки її гравців у діючій схемі
		* тренер розподіляє всі потенційні небезпечні моменти по атакам
			* `attackPotential = [3][2][1][3]`
		* тренер може запланувати будь-яку кількість атак, але не більш, ніж рівень максимальної надійності захисту суперника
	* надійність оборони = сума всіх очків захисту її гравців у діючій схемі
		* тренер розподіляє свої очки захисту по атакам суперника
		* кожна дія захисту будується виходячи з побаченої атаки суперника безпосередньо під час гри
	* рівень моралі з урахуванням використаних карток
		* базовый рівень моралі на матч визначається результатом 1 попередньої гри (-1 після поразки, 0 після нічиєї, +1 після перемоги)
	* використані картки з умовами їх застосування
* тренер може не демонструвати свій план на гру, проте зобов'язаний давати відповіді на наступні питання:
	* кількість очок оборони
	* кількість атак
* картки діють лише 1 матч, потім гравці забувают настанови тренера

###### Гра
* основний час гри складається з запланованих атак обох команд та розіграшу перків гравців обох команд
* команди атакують по черзі, кожна згідно плану свого тренера
* атака:
	* тренер команди, що в атаці, кидає кубики, де кількість кубиків = вага відповідної атаки його команди згідно плану
	* тренер команди, що в захисті, кидає кубики (часть залишивхихся у нього очків захисту)
	* якщо найкращий небезпечний момент зі створених атакою > найліпша позиція захисту, тоді гол
	* якщо найкращий небезпечний момент зі створених атакою = найліпша позиція захисту, тоді штрафний
	* кожен другий штрафний перетворюється не пеналь
* пєналькі:
	* тренер команди, що в атаці, кидає 1 кубик
	* тренер команди, що в захисті, кидає 1 кубик
	* якщо удар > бросок воротника, тоді гол
* післематчеві пенальки пробивають до першого незабитого
