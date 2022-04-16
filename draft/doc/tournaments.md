
# Tournaments


## Settings


## Tournament modes

#### Single Match
* format:
    * T<sub>Q</sub> = CONST = 2
    * `_return_leg` = FALSE
    * C<sub>Q</sub> = 0~2
* training:
    * `_training_games_remain` = 1
    * `_courage_games_remain` = 1
    * `_injury_games_remain` = 1
    * `_forced_training_available` = TRUE
* schema:
    [TODO]


#### Series Match
* format:
    * T<sub>Q</sub> = 2+
    * `_return_leg` = FALSE
    * T<sub>Q</sub>(C) = 0~T<sub>Q</sub>
    * C<sub>Q</sub> = 0~T<sub>Q</sub>
* training:
    * (?) hold the training before the 1st match (once the Team enters the Tournament)
    * `_training_games_remain` = 4
    * `_courage_games_remain` = 4
    * `_injury_games_remain` = 4
    * `_forced_training_available` = TRUE
* schema:
    [TODO]

