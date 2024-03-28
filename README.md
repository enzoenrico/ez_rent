# EZ Rent
Projeto voltado à disciplina de Experiência Criativa @PUCPR
2024, grupo 3


## Testing
> Para testar as "API's" de usuário e item, é necessária a instanciação de um objeto:

### Interação com usuário

``` php 
$user = new User(0, "username", "email", "telephone")
$user->set_pass("passwd")//adição de senha ao usuário

// interagindo com o banco de dados como um usuário
UserMethods::get_user(0); //search with user_id
UserMethods::set_user($user); // para criação no db é necessário o uso de um objeto 'usuário' já instanciado
UserMethods::update_user($user, 0) //atuaiza o usuário de id 0 com informações na instância do usuário inicializado $user
UserMethods::delete_user(0) // deleta o usuário de id 0 

```

### Interação com items

``` php
$i = new Item(0, "item name", 0, true, "item group", "item description") // instanciação de um novo item
ItemMethods::get_all_items(); //retorna um array de objetos 'Item'
ItemMethods::get_item(0); //procura um usuário baseado em um ID parâmetro
ItemMethods::set_item($item); // adiciona um novo item baseado em uma variavél de tipo Item ao DB
ItemMethods::update_item($item, $item_id); //atualiza com informações da instância Item o objeto no banco de dados om id $item_id
ItemMethods::delete_item($item_id); //deleta o objeto com id $item_id no banco de dados

```
