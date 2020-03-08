
## Fixtures Scheduler

###### input arguments

- `T` is a collection of `t`eams.

      T = [team]s = {t1,t2, ...tn}

        n : {4;8;16}

- `S` is a collection of competition settings:
`r` shows if replays are required;
`d` shows the top limit of how many `G`ames each `t`eam can play home (or away) in a row.

      S = {r,d}

        r : BOOL : {F;T}
        d : {1;2}




###### output expectations

- Fixtures `F` contains all the `G`ames, structured in a scheduled timetable:
`G`ames are grouped into `M`atchdays, which are grouped into `L`aps;
`G`ame consists of `h`ome `t`eam & `a`way `t`eam.

      F = [Lap]s :
      
          = [Matchday]s :
          
              = [Game]s :
              
                  {h = ti,a = tj}

                     1 ≤ i ≤ n
                     1 ≤ j ≤ n
                     i ≠ j

- Fixtures Scheduler provides new Matchdays schema & new Games schema in each `F`.

      schema(M,L) : UNIQUE({Fi,Fj, ...})
      schema(G,M) : UNIQUE({Fi,Fj, ...})

- If `r`eplays are enabled, the 2nd `L` is added to `F` with the same `M`atchdays schema with the same `G`ame pairs,
but home & away `t`eams are inverted inside each `G`ame pair.

      Mi->Gx->ta = Mj->Gx->th
      Mi->Gx->th = Mj->Gx->ta

        1 ≤ i ≤ Q(M,L)
        j = Q(M,L) + i



###### control validations

`Q` shows how many objects are there per context.

    Q = f(object,?[context]s)

Context parameter is not required. If context is not specified, it means that global context is used.

Several sequentially specified contexts form a chain of detailing queries. Be aware of absurd contexts chains.

- `Q(L)` is the quantity of all `L`aps.

      Q(L) = f(r) : {1;2}

- `Q(M,L)` is the quantity of `M`atchdays per `L`ap.

      Q(M,L) = n - 1

- `Q(M)` is the quantity of all `M`atchdays.
`Q(M,t)` is the quantity of `M`atchdays per `t`eam.
`Q(G,t)` is the quantity of `G`ames per `t`eam.

      Q(M) = Q(M,t) = Q(G,t) = Q(M,L) * Q(L)

- `Q(t,G)` is the quantity of `t`eams taking part in a `G`ame.

      Q(t,G) : CONST = 2

- `Q(G,M)` is the quantity of `G`ames per `M`atchday.

      Q(G,M) = n / Q(t,G)

- `Q(G)` is the quantity of all `G`ames.

      Q(G) = Q(G,M) * Q(M)

- Dataset matrix:

    |           |   |    |    |    |   |    |    |    |
    |-----------|---|----|----|----|---|----|----|----|
    | Q(t) = n  |   |  4 |  8 | 16 |   |  4 |  8 | 16 |
    | r         |   |  F |  F |  F |   |  T |  T |  T |
    | Q(L)      |   |  1 |  1 |  1 |   |  2 |  2 |  2 |
    |           |   |    |    |    |   |    |    |    |
    | Q(M,L)    |   |  3 |  7 | 15 |   |  3 |  7 | 15 |
    |           |   |    |    |    |   |    |    |    |
    | Q(M)      |   |  3 |  7 | 15 |   |  6 | 14 | 30 |
    | Q(M,t)    |   |  3 |  7 | 15 |   |  6 | 14 | 30 |
    | Q(G,t)    |   |  3 |  7 | 15 |   |  6 | 14 | 30 |
    |           |   |    |    |    |   |    |    |    |
    | Q(t,G)    |   |  2 |  2 |  2 |   |  2 |  2 |  2 |
    |           |   |    |    |    |   |    |    |    |
    | Q(G,M)    |   |  2 |  4 |  8 |   |  2 |  4 |  8 |
    | Q(G)      |   |  6 | 28 | 120|   | 12 | 56 | 240|




