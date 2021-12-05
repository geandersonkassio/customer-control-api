# Customer Control API

Customer control system and their respective license plates.

## Application construction

The application was built with:

- PHP 8
- Laravel v8
- MYSQL

Database structure

    Table Customer:
      - id
      - name
      - phone
      - cpf
      - license_plate

## Starting the application

Docker and docker-compose must be installed

    * git clone
    * cd to repo
    * docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs
    * ./vendor/bin/sail up -d
    * ./vendor/bin/sail artisan migrate
    
## How to use

    BASEURL : http://localhost/api

| Method | Endpoint                       | Description                                                                                                     |
|--------|--------------------------------|-----------------------------------------------------------------------------------------------------------------|
| POST   | /cliente                       | New customer registration.                                                                                      |
| PUT    | /cliente/{id}                  | Editing an existing customer.                                                                                   |
| DELETE | /cliente/{id}                  | Removal of an existing customer.                                                                                |
| GET    | /cliente/{id}                  | Querying a customer's data.                                                                                     |
| GET    | /consulta/final-placa/{numero} | Consultation of all customers registered in the base, where the last number of the license plate is the same as the one informed.|

> example usage with CURL


### New customer registration. 

```shell
	> curl -H "Content-Type: application/json" \
	  --request POST \
	  --data '{"name":"usuario","phone":"11112222", "cpf":"12345678900","license_plate":"XRT5678"}' \
	  http://localhost/api/cliente
```
### Editing an existing customer.
```shell
	> curl -H "Content-Type: application/json" \
	  --request PUT \
	  --data '{"name":"usuario","phone":"33334444", "cpf":"12345678900","license_plate":"XRT5678"}' \
	  http://localhost/api/cliente/{id}
```
### Querying a customer's data.
```shell
	> curl -H "Content-Type: application/json" \
	  --request GET \
	  http://localhost/api/cliente/{id}
```

### Removal of an existing customer.
```shell
	> curl -H "Content-Type: application/json" \
	  --request DELETE \
	  http://localhost/api/cliente/{id}
```

### Consultation of all customers registered in the base, where the last number of the license plate is the same as the one informed.
```shell
	> curl -H "Content-Type: application/json" \
	  --request GET \
	  http://localhost/api//consulta/final-placa/{numero}
```

