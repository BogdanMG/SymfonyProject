 ### Token
 ```
 eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImF1ZCI6InVzZXJzIiwic3ViamVjdCI6ImFzZ2FydGNvbXBhbnkiLCJuYW1lIjoiQm9nZGFuTUcifQ.3qnyKXKgdMrfzM32fnaukr3l2TBeWEoPYeN-0IiFnU4
 ```


### Api
- Show amount of prices.

`{`
`"total_prices" : true`
`}`

- Show min or max price of the goods.

`{`
   `"price": "min/max"`
`}`

- Sort by date.

`{`
    `"sort_by_date":"forward/reverse"`
`}`

- Sort by name.

`{`
    `"sort_by_name" : "forward/reverse"`
`}`

- Get the goods by the date of the addition
(from, to).
`{`
    `"date_from": value,`
    `"date_to" : value`
`}`

- Get upper or lower bound of the goods.
`{`
 `"upper_bound" : value (`true` or `null`),`
 `"lower_bound" : value (`true` or `null`)`
`}`

