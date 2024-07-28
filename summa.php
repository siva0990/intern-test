curl -X GET http://localhost:8080/list_recipes.php

curl -X GET "http://localhost:8080/get_recipe.php?id={id}"

curl -X POST http://localhost:8080/create_recipe.php -H "Content-Type: application/json" -d '{"name": "Spaghetti Bolognese", "prep_time": 45, "difficulty": 3, "vegetarian": false}'

curl -X POST http://localhost:8080/create_recipe.php -H "Content-Type: application/json" -d '{"name": "Parrotta", "prep_time": 45, "difficulty": 3, "vegetarian": true}'

curl -X PUT "http://localhost:8080/update_recipe.php?id={id}" -H "Content-Type: application/json" -d '{"name": "Updated Spaghetti Bolognese", "prep_time": 50, "difficulty": 2, "vegetarian": true}'

