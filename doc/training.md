
# Тренування


### Тренувальний збір
* тренер може провести тренувальний збір своєї команди
* гравці з потенціалом (коли талант перевищує клас) мають можливість набрати кращої форми на заняттях:
  * гравець може відвідати ідеологічне заняття тільки 1 раз за збір
  * гравець може відвідувати практичні заняття
* гравці продовжують тренування зі свого поточного стану:
  * поточний стан гравців визначається результатами та давністтю попереднього тренування
* капітанська пов'язка надає куражу
* тренуючись, гравець ризикує отримати пошкодження:
  * останнього воротника не тренуй, бо в разі пошкодження замінити його буде ніким
  * закінчуй збори, якщо травмованих забагато: доведеться формувати склад з тих, хто лишився
* [IN_PROGRESS] результати тренування тримаються `S::training/training_games_remain` зустрічей


### Ідеологічне заняття
* на заняття може прийти і декілька гравців одночасно: тоді результат заняття застосується до кожного з цих гравців
* кидай 2 кубика D6 задля визначення рівня успішності заняття:
    * якщо випало `6` та `6`, тоді гравець зловив кураж
    * [IN_PROGRESS] якщо випало `1` та `1`, тоді гравця дискваліфіковано на `S::training/disqualification_games_remain`
* кураж надає гравцю максимальної форми (відповідно його таланту) для всіх позицій на `S::training/courage_games_remain` зустрічей


### Практичне заняття
* на заняття може прийти і декілька гравців одночасно: тоді результат заняття застосується до кожного з цих гравців
* кидай 1 кубик D6 задля визначення рівня успішності заняття:
	* якщо випало `1`, тоді це вкрай погане тренування: гравця травмовано, тому допомогти команді в наступних `S::training/injury_games_remain` зустрічах він не зможе
	* якщо випало `2`..`3`, закінчити тренування для цього гравця: йому не вдалось набрати додаткової форми, проте попередній рівень лишається (клас + вже набраний потенціал)
	* якщо випало `4`..`6`, тоді результат куди більш вдалий: гравець набирає бажане 1 очко потенціалу та можливість тренуватись далі
	* деякі гравці потребують особливої уваги, адже вони крихкі: отримують пошкодження не тільки при `1`, а й при `6` (перетренування)
* якщо в гравця ще лишився потенціал, можеш тренувати його ще


### Посилене тренування
* доступне по умові `S::training/forced_training_available`
* отримуєте гравців на куражі (з повністтю розвиненим потенціалом і без травм)
