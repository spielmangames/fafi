
> FAFI-001


## Tactical boundary imbalance


###### Teams selected

- **B**laugrana_2011 plays at home:

| pos   | #  | name         | att      | def      |
|------:|---:|:------------:|:--------:|:--------:|
|   gk  |  1 | v.valedos    |      0   |      3   |
|   rb  |  2 | d.alvi       |      2   |      3   |
|   cb  |  5 | c.puqi       |      0   |      5   |
|   cm  |  6 | chaves       |      4   |      1   |
|   cf  |  7 | d.guaje      |   4..5   |      0   |
|   am  |  8 | a.iniesa     |      4   |      1   |
|   rf  | 10 | l.essi       |      5   |      0   |
|**sum**|    |              |**19..20**|   **13** |


- **T**yneside_2020 plays away:

| pos   | #  | name         | att      | def      |
|------:|---:|:------------:|:--------:|:--------:|
|   gk  |  1 | m.bravka     |      0   |   1..3   |
|   cb  |  5 | f.share      |      0   |   1..3   |
|   cf  |  7 | a.carrott    |   1..4   |      0   |
|   cf  | 12 | d.gwynny     |   1..3   |      0   |
|   rb  | 22 | d.yerluk     |   0..1   |   1..2   |
|   lb  | 28 | d.ross       |   1..2   |   1..2   |
|   cm  | 34 | j.callbee    |   0..1   |   1..2   |
|**sum**|    |              | **3..11**| **5..12**|




###### Conditions

**B** had run an excellent training before the game, while **T** had run the worst one:
    
    att(B) = 20, def(B) = 13
    att(T) = 3, def(T) = 5




###### Problem

Since **B** attack has a critical tactical advantage over **T** defence, it seems like **B** can score a lot,
however there are tricky cases when **B** can't use this advantage at full.

Let's explore the relation between the quantity of **B** attacks & **T** defence level:

    att_qty(B) = count(schema(att(B))
    F = f(att_qty(B) ~ def(T))

What to do when `def(T) = 0` turns into 0?

1.  Option A: **B** coach can use not more attacks in schema than **T** defence level:

        att_qty(B) ≤ def(T)
        Q(goals(B)) ≤ 5

    - In such case `count(goals(B))` is increasing, while `def(T)` is increasing & vice versa.
    The less defence points **T** has, the quicker **B** will finish them up, so **B** can score less in the end.

    - Also, this approach requires **T** coach to make a disclosure on his defence level,
    but this can be fixed by requiring every team to guarantee the minimum attacks qty for the opposite team.

2.  Option B: If **B** still has attacks reserved, all this advantage immediately turns into 1 penalty shot.

        att_qty(B) > 0
        B->penalty

3.  Option C: 






    f(att(B) ~ def(T)) = ?

From the other hand, 

    att(T) ~ def(B)


