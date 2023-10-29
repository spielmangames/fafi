
## FAFI-002

Support PATCH operations solidly.
    - need to set only 1 particular Entity field to null while others stay untouched (nullable among them)
`CURRENT_WORKAROUND` AbstractResource::update operation is skipping null values under the hood.


## FAFI-003

When Client requests to Domain Service save the Domain Entity model, then Client expects the updated Domain Entity model in response from Domain Service.
Client can be e.g. a Storefront Service or an ImEx Service.
Domain Service can be e.g. Player Service, with a Player as an Entity.

Player model is composite and can contain the Attributes (or even must contain?).

Should Player model contain the Attributes in response?
Should Domain Entity model contain the SubEntity models in response?
If both options are needed, which one is preferable as a default?



## FAFI-004
Get the rid of Delete operations
    - using ON DELETE CASCADE in DB (eg: ```table "clubs" > CONSTRAINT `city_id` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE```)
`CURRENT_WORKAROUND` AbstractResource::delete operation is temporarily forbidden.


## FAFI-005
Using indexes in DB



## FAFI-006
Implement DI



## FAFI-007
Consider implementing Enums


