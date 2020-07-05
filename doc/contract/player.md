
![scheme](https://github.com/spielmangames/fafi/blob/master/doc/player_model.jpg)

# Player model contract

- basic:

  | property      | type                                    | sql           | req |
  |---------------|:---------------------------------------:|---------------|:---:|
  |               |                                         |               |     |
  | fafi_name     | unique string(1~32)                     | VARCHAR(32)   |  +  |
  | status        | bool=0                                  | bit           |  +  |

  - fafi_name = lowcase


###### personal

- origin:

  | property      | type                                    | sql           | req |
  |---------------|:---------------------------------------:|---------------|:---:|
  |               |                                         |               |     |
  | name          | string(0~32)                            | VARCHAR(32)   |  -  |
  | particle      | string(0~8)                             | VARCHAR(8)    |  -  |
  | surname       | string(1~32)                            | VARCHAR(32)   |  +  |
  |               |                                         |               |     |
  | birth_country | [nation](./models.MD/#nation-model)     | foreign       |  -  |
  | birth_city    | string(0~64)                            | VARCHAR(64)   |  -  |
  | birth_date    | date                                    | DATE          |  -  |
  |               |                                         |               |     |
  | current_age   | dynamic int                             |               |     |

  - name + particle + surname = unique


###### skills

- shape:

  | property      | type                                    | sql           | req |
  |---------------|:---------------------------------------:|---------------|:---:|
  |               |                                         |               |     |
  | foot          | {L;R}                                   | enum('L','R') |  -  |
  | height        | int(111~222)                            | tinyint       |  -  |
  | injure_factor | bool=0                                  | bit           |  -  |

- attributes (per position):

  | property      | type                                    | sql           | req |
  |---------------|:---------------------------------------:|---------------|:---:|
  |               |                                         |               |     |
  | position      | [position](./models.MD/#positions)      | foreign       |  +  |
  |               |                                         |               |     |
  | attack_min    | int(0~5)                                | tinyint       |  +  |
  | attack_max    | int(0~5)                                | tinyint       |  +  |
  | defence_min   | int(0~5)                                | tinyint       |  +  |
  | defence_max   | int(0~5)                                | tinyint       |  +  |
  |               |                                         |               |     |
  | class         | int(1~5)                                | dynamic       | n/a |
  | talent        | int(class~5)                            | dynamic       | n/a |

  - possible positions:
    - GK
    - CB, LB, RB, WB
    - DM, CM, AM, LM, RM, WM
    - LF, RF, WF, SF, CF
  - player has from 1 to 4 positions assigned
  - every assigned position is unique (aware: WB = LB+RB)
  - GK can't have another positions assigned
  - GK can't have attack attributes
  - dynamic:
    - class = max(attack_min + defence_min)
    - talent = max(attack_max + defence_max)
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
      - 1 ≤ attack_min + defence_min ≤ 5
      - attack_min + defence_min ≤ attack_max + defence_max ≤ 5
      - 1 ≤ class ≤ 5
      - class ≤ talent ≤ 5

- perks: ...


###### career

- teams:

  | property      | type                                    | sql           | req |
  |---------------|:---------------------------------------:|---------------|:---:|
  |               |                                         |               |     |
  | nationalities | [NATION](./models.MD/#nation-model)s    | foreign       |  -  |
  | clubs         | [CLUB](./models.MD/#club-model)s        | foreign       |  -  |

