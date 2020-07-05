
![scheme](https://github.com/spielmangames/fafi/blob/master/doc/player_model.jpg)

# Player model contract

- `MVP` basic:

  | property      | type                                    | sql           | req |
  |---------------|:---------------------------------------:|---------------|:---:|
  |               |                                         |               |     |
  | fafi_name     | string(4~32)                            | VARCHAR(32)   |  +  |
  | status        | bool                                    | bit           |  +  |

  - fafi_name = unique
  - fafi_name = lowcase
  - default status = 0


###### personal

- `MVP` origin:

  | property      | type                                    | sql           | req |
  |---------------|:---------------------------------------:|---------------|:---:|
  |               |                                         |               |     |
  | name          | string(32)                              | VARCHAR(32)   |  -  |
  | particle      | string(8)                               | VARCHAR(8)    |  -  |
  | surname       | string(32)                              | VARCHAR(32)   |  +  |
  |               |                                         |               |     |
  | birth_country | [nation](./models.MD/#nation-model)     | foreign       |  +  |
  | birth_place   | string(64)                              | VARCHAR(64)   |  -  |
  | birth_date    | date                                    | DATE          |  -  |

  - name + particle + surname = unique
  - `???` 1st_char(name) + particle + surname = unique


###### skills

- shape:

  | property      | type                                    | sql           | req |
  |---------------|:---------------------------------------:|---------------|:---:|
  |               |                                         |               |     |
  | current_age   | int                                     | dymanic       | n/a |
  | foot          | enum{L;R}                               | enum('L','R') |  -  |
  | height        | int(111~222)                            | tinyint       |  -  |
  | injure_factor | bool                                    | bit           |  -  |

- `MVP` attributes (per position):

  | property      | type                                    | sql           | req |
  |---------------|:---------------------------------------:|---------------|:---:|
  |               |                                         |               |     |
  | position      | [position](./models.MD/#positions)      | foreign       |  +  |
  |               |                                         |               |     |
  | attack_min    | int(0~5)                                | tinyint       |  +  |
  | attack_max    | int(0~5)                                | tinyint       |  +  |
  | defence_min   | int(0~5)                                | tinyint       |  +  |
  | defence_max   | int(0~5)                                | tinyint       |  +  |

  - possible positions:
    - GK
    - CB, LB, RB, WB
    - DM, CM, AM, LM, RM, WM
    - LF, RF, WF, SF, CF
  - player has from 1 to 4 positions assigned
  - every assigned position is unique (aware: WB = LB+RB)
  - GK can't have another positions assigned
  - GK can't have attack attributes
  - attributes:
    - scale:
      - 0 ≤ attack_min ≤ 5
      - 0 ≤ attack_max ≤ 5
      - 0 ≤ defence_min ≤ 5
      - 0 ≤ defence_max ≤ 5
    - single range:
      - attack_min ≤ attack_max
      - defence_min ≤ defence_max
    - cross range:
      - 1 ≤ attack_min + defence_min ≤ 5 (player class > 0)
      - attack_max + defence_max ≤ 5 (player talent is limited by scale)

- perks: ...


###### career

- teams:

  | property      | type                                    | sql           | req |
  |---------------|:---------------------------------------:|---------------|:---:|
  |               |                                         |               |     |
  | nationalities | [NATION](./models.MD/#nation-model)s    | foreign       |  -  |
  | clubs         | [CLUB](./models.MD/#club-model)s        | foreign       |  -  |
