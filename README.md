### Comando para iniciar a aplicação

#### run build
```
docker-compose up -d --build
```

#### install dependencies
```
docker exec -it join_category_of_products bash
composer install
```

#### Fora do container  execute os comandos abaixo para a utilização da tipagem "LF" utilize preferencialmente ("Gitbash")
```
git config core.autocrlf false
```

#### set a mode development
```
composer development-enable
```

### Collection de rotas no postman na raiz da aplicação
````
 Join_Registers.postman_collection.json
````

#### documentacao da api nesse [link](https://documenter.getpostman.com/view/7013209/TzCJfUnR)

