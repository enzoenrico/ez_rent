<?php
class Item
{
    public int $id;
    public int $id_user;
    public string $name;
    public float $value;
    public bool $available;
    public string|null $group;
    public string|null $description;
    public string $group_description;
    public string $dataInicio;
    public string $dataFinal;

    public function __construct($name, $value, $available, $group, $description, $id_user)
    {
        $this->name = $name;
        $this->value = $value;
        $this->available = $available;
        $this->group = $group;
        $this->description = $description;
        $this->id_user = $id_user;
        $this->group_description = '';
    }
    public function set_id($id)
    {
        $this->id = $id;
    }
    public function get_id(): int
    {
        return $this->id;
    }

    public function get_data_final() {
        return $this->dataFinal;
    }
}

class ItemMethods
{

    public function get_item(int $id_item)
    {
        include 'C:\xampp\htdocs\ez_rent\back\connection.php';
        $result = $conn->query("SELECT * FROM Item WHERE id_item = $id_item;");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $item = new Item($row['nome_item'], $row['valor_item'], $row['disponivel'], '', $row['descricao'], $row['fk_Usuario_id_usuario']);
                $item->set_id($row['id_item']);
                $item->dataInicio = $row['data_inicio'];
                $item->dataFinal = $row['data_final'];
            }
            return $item;
        } else {
            return null;
        }
    }
    /**
     * This PHP function retrieves all items from a database table named "item".
     * 
     * @return void The function `get_all_items()` is returning the result of the query "SELECT * FROM item"
     * executed on the database. This result typically contains all the items retrieved from the "item"
     * table in the database.
     */
    public function get_all_items()
    {
        include 'C:\xampp\htdocs\ez_rent\back\connection.php';

        if (isset($_SESSION['logado'])) {
            if ($_SESSION['logado'] && isset($_SESSION['user'])) {
                $id_usuario = $_SESSION['user']['id'];
                $result = $conn->query("SELECT Item.*, Categoria_item.descricao AS descricao_cat 
                FROM Item 
                INNER JOIN Categoria_item ON Item.fk_Categoria_item = Categoria_item.id_categoria
                WHERE Item.id_item NOT IN (
                    SELECT fk_id_item 
                    FROM carrinho 
                    WHERE fk_id_usuario = '$id_usuario'
                )
                AND Item.fk_Usuario_id_usuario <> '$id_usuario';
                ");
                $data = array();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $item = new Item($row['nome_item'], $row['valor_item'], $row['disponivel'], $row['descricao_cat'], $row['descricao'], $row['fk_Usuario_id_usuario']);
                        $item->set_id($row['id_item']);
                        $item->dataInicio = $row['data_inicio'];
                        $item->dataFinal = $row['data_final'];
                        $item->group_description = $row['descricao_cat'];
                        $data[] = $item;
                    }
                    return $data;
                } else {
                    return null;
                }
            }
        } else {
            $result = $conn->query("SELECT Item.*, Categoria_item.descricao as descricao_cat FROM Item INNER JOIN Categoria_item ON Item.fk_Categoria_item = Categoria_item.id_categoria;");
            $data = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $item = new Item($row['nome_item'], $row['valor_item'], $row['disponivel'], $row['descricao_cat'], $row['descricao'], $row['fk_Usuario_id_usuario']);
                    $item->set_id($row['id_item']);
                    $item->dataInicio = $row['data_inicio'];
                    $item->dataFinal = $row['data_final'];
                    $item->group_description = $row['descricao_cat'];
                    $data[] = $item;
                }
                return $data;
            } else {
                return null;
            }
        }
    }
    /**
     * Adds an item to the system.
     *
     * @param Item $i The item to be added.
     * @return bool Returns true if the item was successfully added, false otherwise.
     */
    public function add_item(Item $i, $dataFinal): bool
    {
        include 'C:\xampp\htdocs\ez_rent\back\connection.php';
        $dataAtual = new DateTime();
        $dataAtualFormatada = $dataAtual->format('Y-m-d');
        $dataFinalFormatada = $dataFinal->format('Y-m-d');
        try {
            $sql = "INSERT INTO item (nome_item, valor_item, disponivel, fk_Categoria_item, descricao, fk_Usuario_id_usuario, data_inicio, data_final) VALUES ('$i->name', '$i->value', '$i->available', '$i->group', '$i->description', '$i->id_user', '$dataAtualFormatada', '$dataFinalFormatada')";
            $conn->query($sql);
        } catch (\Throwable $th) {
            echo $th;
            return false;
        }
        return true;
    }

    /**
     * Retrieves an item by its ID.
     *
     * @param int $id The ID of the item to retrieve.
     * @return Item The retrieved item.
     */
    public function search_item(String $itemName)
    {
        include 'C:\xampp\htdocs\ez_rent\back\connection.php';
        $result = $conn->query("SELECT Item.*, Categoria_item.descricao as descricao_cat FROM Item INNER JOIN Categoria_item ON Item.fk_Categoria_item = Categoria_item.id_categoria WHERE nome_item LIKE '%$itemName%'");
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $item = new Item($row['nome_item'], $row['valor_item'], $row['disponivel'], $row['fk_Categoria_item'], $row['descricao'], $row['fk_Usuario_id_usuario']);
                $item->set_id($row['id_item']);
                $item->dataInicio = $row['data_inicio'];
                $item->dataFinal = $row['data_final'];
                $item->group_description = $row['descricao_cat'];
                $data[] = $item;
            }
            return $data;
        } else {
            $res = new Error('No results found.');
        }
    }

    public function get_user_item(int $id)
    {
        include 'C:\xampp\htdocs\ez_rent\back\connection.php';
        $result = $conn->query("SELECT Item.*, Categoria_item.descricao as descricao_cat FROM Item INNER JOIN Categoria_item ON Item.fk_Categoria_item = Categoria_item.id_categoria WHERE fk_Usuario_id_usuario = $id");
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $item = new Item($row['nome_item'], $row['valor_item'], $row['disponivel'], $row['fk_Categoria_item'], $row['descricao'], $row['fk_Usuario_id_usuario']);
                $item->set_id($row['id_item']);
                $item->dataInicio = $row['data_inicio'];
                $item->dataFinal = $row['data_final'];
                $item->group_description = $row['descricao_cat'];
                $data[] = $item;
            }
            return $data;
        } else {
            $res = new Error('No results found.');
        }
    }

    /**
     * Updates an item.
     *
     * @param Item $i The item to be updated.
     * @return bool Returns true if the item was successfully updated, false otherwise.
     */
    public function update_item(Item $i, $id, $dataInicio, $dataFinal): bool
    {
        include 'C:\xampp\htdocs\ez_rent\back\connection.php';
        $dataAtualFormatada = $dataInicio->format('Y-m-d');
        $dataFinalFormatada = $dataFinal->format('Y-m-d');

        try {
            $sql = "UPDATE item SET nome_item = '$i->name', valor_item = '$i->value', descricao = '$i->description', data_inicio = '$dataAtualFormatada', data_final = '$dataFinalFormatada' WHERE id_item = '$id'";
            $conn->query($sql);
        } catch (\Throwable $th) {
            echo $th;
            return false;
        }
        return true;
    }
    /**
     * Deletes an item with the specified ID.
     *
     * @param int $id The ID of the item to delete.
     * @return bool Returns true if the item was successfully deleted, false otherwise.
     */
    public static function delete_item(int $id): bool
    {
        include 'C:\xampp\htdocs\ez_rent\back\connection.php';
        $sql = "DELETE FROM item WHERE id_item = $id";
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public static function delete_user_item(int $id): bool
    {
        include 'C:\xampp\htdocs\ez_rent\back\connection.php';
        $sql = "DELETE FROM item WHERE fk_Usuario_id_usuario = $id";
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function get_item_owner(int $id_item)
    {
        include 'C:\xampp\htdocs\ez_rent\back\connection.php';
        $sql = "SELECT id_usuario,nome_usuario FROM Usuario INNER JOIN Item on item.fk_Usuario_id_usuario = Usuario.id_usuario WHERE item.id_item = '$id_item'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $locador = new Locador();
                $locador->set_id($row['id_usuario']);
                $locador->set_nome($row['nome_usuario']);
                return $locador;
            }
        } else {
            return false;
        }
    }

    public function get_aluguel_items(int $id_usuario)
    {
        include 'C:\xampp\htdocs\ez_rent\back\connection.php';
        $result = $conn->query("SELECT Item.*, Categoria_item.descricao as descricao_cat 
        FROM Item 
        INNER JOIN Categoria_item ON Item.fk_Categoria_item = Categoria_item.id_categoria 
        INNER JOIN Aluguel ON Aluguel.fk_Item_id_item = Item.id_item
        WHERE Aluguel.fk_Usuario_id_usuario = $id_usuario;
        ");
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $item = new Item($row['nome_item'], $row['valor_item'], $row['disponivel'], $row['fk_Categoria_item'], $row['descricao'], $row['fk_Usuario_id_usuario']);
                $item->set_id($row['id_item']);
                $item->dataInicio = $row['data_inicio'];
                $item->dataFinal = $row['data_final'];
                $item->group_description = $row['descricao_cat'];
                $data[] = $item;
            }
            return $data;
        } else {
            $res = new Error('No results found.');
        }
    }
}
class Locador
{
    private int $id_locador;
    private string $nome_locador;

    public function get_id(): int
    {
        return $this->id_locador;
    }

    public function set_id(int $id_locador): void
    {
        $this->id_locador = $id_locador;
    }

    public function get_nome(): string
    {
        return $this->nome_locador;
    }

    public function set_nome(string $nome_locador): void
    {
        $this->nome_locador = $nome_locador;
    }
}
