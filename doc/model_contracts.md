
## Player model

- `MVP` base:

  | property      |req| type                                    | sql      |
  |---------------|---|:---------------------------------------:|----------|
  |               |   |                                         |          |
  | fafi_name     | - | string                                  | VARCHAR  |
  | status        | - | bool                                    | bit      |

  - fafi_name = unique
  - default status = 0

###### personal

- `MVP` origin:

  | property      |req| type                                    | sql      |
  |---------------|---|:---------------------------------------:|----------|
  |               |   |                                         |          |
  | name          | - | string                                  | VARCHAR  |
  | particle      | - | string                                  | VARCHAR  |
  | surname       | + | string                                  | VARCHAR  |
  |               |   |                                         |          |
  | birth_country | + | [nation](./models.MD/#nation-model)     | foreign  |
  | birth_place   | - | string                                  | VARCHAR  |
  | birth_date    | - | date                                    | DATE     |

  - name + particle + surname = unique
  - `???` 1st_char(name) + particle + surname = unique




  
###### skills

- shape:

  | property      |req| type                                    | sql      |
  |---------------|---|:---------------------------------------:|----------|
  |               |   |                                         |          |
  | height        | - | int                                     | tinyint  |
  | foot          | - | enum{L;R}                               | enum(..) |
  | current_age   |   | int                                     | dymanic  |
  | injure_factor | - | bool                                    | bit      |

- `MVP` attributes (per position):

  | property      |req| type                                    | sql      |
  |---------------|---|:---------------------------------------:|----------|
  |               |   |                                         |          |
  | position      | + | [position](./models.MD/#positions)      | foreign  |
  |               |   |                                         |          |
  | attack_min    | + | int                                     | tinyint  |
  | attack_max    | + | int                                     | tinyint  |
  | defence_min   | + | int                                     | tinyint  |
  | defence_max   | + | int                                     | tinyint  |

  - every assigned position is unique
  - possible positions:
    - gk
    - cb
    - lb
    - rb
    - wb ???
    - dm
    - cm
    - am
    - lm
    - rm
    - wm ???
    - lf
    - rf
    - wf ???
    - ss
    - cf

  - player with `gk` position can't have another positions assigned
  - player with `gk` position can have 0 attack attribute level only
  - player can have from 1 to 4 positions assigned ???
  - attributes:
    - attack_min ≤ attack_max
    - defence_min ≤ defence_max
    - 0 ≤ attack_min ≤ 5
    - 0 ≤ attack_max ≤ 5
    - 0 ≤ defence_min ≤ 5
    - 0 ≤ defence_max ≤ 5
    - attack_min + defence_min ≤ 5
    - attack_max + defence_max ≤ 5

- perks: ...

###### career

- teams

  | property      |req| type                                    |
  |---------------|---|:---------------------------------------:|
  |               |   |                                         |
  | nationalities | - | [NATION](./models.MD/#nation-model)s    |
  | clubs         | + | [CLUB](./models.MD/#club-model)s        |




## Club model

## Nation model

## Positions

    