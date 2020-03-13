
## Player model

###### personal

- origin:

  | property      |req| type                                    | sql     |
  |---------------|---|:---------------------------------------:|---------|
  |               |   |                                         |         |
  | name          | - | string                                  | VARCHAR |
  | particle      | - | string                                  | VARCHAR |
  | surname       | + | string                                  | VARCHAR |
  |               |   |                                         |         |
  | birth_country | + | [nation](./models.MD/#nation-model)     | foreign |
  | birth_place   | - | string                                  | VARCHAR |
  | birth_date    | - | date                                    | DATE    |
  | current_age   |   | int                                     | tinyint |

  - name + particle + surname = unique
  - 1st_char(name) + particle + surname = unique ???




  
###### skills

- shape:

  | property      |req| type                                    | sql     |
  |---------------|---|:---------------------------------------:|---------|
  |               |   |                                         |         |
  | height        | - | int                                     | tinyint |
  | foot          | - | enum{L;R}                               | ???     |
  | injure_factor | - | bool                                    | bit     |

- attributes per [position](./models.MD/#position-model):

  | property      |req| type                                    | sql     |
  |---------------|---|:---------------------------------------:|---------|
  |               |   |                                         |         |
  | position      | + | [position](./models.MD/#position-model) | foreign |
  |               |   |                                         |         |
  | attack_min    | + | int                                     | tinyint |
  | attack_max    | + | int                                     | tinyint |
  | defence_min   | + | int                                     | tinyint |
  | defence_max   | + | int                                     | tinyint |

  - every assigned position is unique
  - player with `gk` position can't have another positions assigned
  - player with `gk` position can have 0 attack attribute level only
  - player can have from 1 to 4 positions assigned ???
  - attributes:
    - 0 ≤ attack_min ≤ 5
    - 0 ≤ attack_max ≤ 5
    - 0 ≤ defence_min ≤ 5
    - 0 ≤ defence_max ≤ 5
    - attack_min ≤ attack_max
    - defence_min ≤ defence_max
    - attack_min + defence_min ≤ 0
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

## Position model



