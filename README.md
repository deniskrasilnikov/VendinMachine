Vending Machine: coding task for PHP interview
----------------------------------------------

Implement a PHP script with a Vending Machine simulation.
Having a list of products and their prices:

* Product A, price 0.95
* Product B, price 1.26
* Product C, price 2.33

customer chooses product and pays for it with coins from this nominal list: 1 2 5 10 20 50. 
The machine gives a customer chosen product, and a change using the least possible amount of coins.
For example, having (50 50 20) coins from a customer for "A" product, it should return (20 5) change, not (10 10 5) or (5 5 5 5 5).

The script must accept a CLI input of a format `A 50 50 20` and return a change in a similar `10 10 5` format. 