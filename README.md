#### run build
```
docker-compose up -d --build
```

#### install dependencies
```
docker exec -it api_marketplace bash
composer install
```

#### Fora do container  execute os comandos abaixo para a utilização da tipagem "LF" utilize preferencialmente ("Gitbash")
```
git config core.autocrlf false
```
#### Gerar o arquivo .env baseado no exemplo:

```console
$ cp .env.example .env   para producao!
```

#### set a mode development
```
composer development-enable
```
