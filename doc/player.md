
# Гравець


### Позиції
* гравці можуть мати декілька позицій
  * к-ть доступних гравцю позицій обмежено налаштуваннями [`player/positions_qty_min`](./settings.ini) та [`player/positions_qty_max`](./settings.ini)
  * польові гравці не можуть стоять на воротах
  * воротник не може грати в полі
* вміння гравця на певній позиції представлено тактичними атрибутами
  * гравець може мати різні значення атрибутів для кожної зі своїх позицій


### Тактичні атрибути
* тактичні атрибути розподіляються на очки атаки (діапазон червоного кольору) та очки захисту (діапазон синього кольору):
  ```
  attack_min ~ attack_max
  defence_min ~ defence_max
  ```
* к-ть тактичних очок гравця обмежено налаштуванням [`player/attribute_value_max`](./settings.ini); для легендарного гравця обмежено налаштуванням [`player/attribute_value_max_legend`](./settings.ini):
  ```
  limit = SETTINGS::player/attribute_value_max

  if (player->isLegend()) {
    limit = SETTINGS::player/attribute_value_max_legend
  }
  ```
* визначене обмеження накладається на значення кожного окремого атрибута:
  ```
  0 ≤ attack_min ≤ limit
  0 ≤ attack_max ≤ limit
  attack_min ≤ attack_max

  0 ≤ defence_min ≤ limit
  0 ≤ defence_max ≤ limit
  defence_min ≤ defence_max
  ```
* також обмежено і розподілення тактичних атрибутів гравця на очки атаки/захисту, що формує поняття класу гравця та його таланту:
  ```
  class = attack_min + defence_min
  talent = attack_max + defence_max

  1 ≤ class ≤ limit
  class ≤ talent ≤ limit
  ```


### Інші властивості
* _крихкість_ -- такі гравці мають вищі шанси травмуватись
* _легендарність_ -- такі гравці можуть мати більше тактичних очок; гравця може бути визнано легендою тільки по закінченню кар'єри

