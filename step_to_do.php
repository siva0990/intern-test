// docker intialize

docker-compose up -d

// testing_api commands 

// list recipes
curl -X GET http://localhost:8080/list_recipes.php

// get_recipe with id
curl -X GET "http://localhost:8080/get_recipe.php?id={id}"

// create_recipe
curl -X POST http://localhost:8080/create_recipe.php -H "Content-Type: application/json" -d '{"name": "Pongal", "prep_time": 45, "difficulty": 3, "vegetarian": true}'

// update_recipe
curl -X PUT "http://localhost:8080/update_recipe.php?id={id}" -H "Content-Type: application/json" -d '{"name": "Pongal", "prep_time": 45, "difficulty": 3, "vegetarian": true}'

// delete_recipe
curl -X DELETE "http://localhost:8080/delete_recipe.php?id={id}"

// rate_recipe
curl -X POST "http://localhost:8080/rate_recipe.php?id={id}" -H "Content-Type: application/json" -d '{"rating": 4}'

// invalid 

curl -X POST http://localhost:8080/create_recipe.php -H "Content-Type: application/json" -d '{"name": "Spaghetti Bolognese"}'

curl -X GET "http://localhost:8080/get_recipe.php?id=abc"

curl -X POST http://localhost:8080/create_recipe.php -H "Content-Type: application/json" -d '{"name": "Test Recipe", "prep_time": 30, "difficulty": 1, "vegetarian": "not_a_boolean"}'

curl -X GET "http://localhost:8080/search_recipes.php?query=Spaghetti"

curl -X POST "http://localhost:8080/rate_recipe.php?id={id}" -H "Content-Type: application/json" -d '{"rating": 6}'