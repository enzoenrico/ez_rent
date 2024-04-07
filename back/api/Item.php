<?php
class Item
{
    public int $id;
    public int $id_user;
    public string $name;
    public float $value;
    public bool $available;
    public string $group;
    public string $description;

    public function __construct($id, $name, $value, $available, $group, $description, $id_user)
    {
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
        $this->available = $available;
        $this->group = $group;
        $this->description = $description;
        $this->id_user = $id_user;
    }
}

class ItemMethods
{
    /**
     * This PHP function retrieves all items from a database table named "item".
     * 
     * @return void The function `get_all_items()` is returning the result of the query "SELECT * FROM item"
     * executed on the database. This result typically contains all the items retrieved from the "item"
     * table in the database.
     */
    public function get_all_items(): array
    {
        include 'connection.php';
        $result = $db->query("SELECT * FROM item");
        return $result;
    }
    /**
     * Adds an item to the system.
     *
     * @param Item $i The item to be added.
     * @return bool Returns true if the item was successfully added, false otherwise.
     */
    public function add_item(Item $i): bool
    {
        // Add item to database
        include 'C:\xampp\htdocs\ez_rent\back\connection.php';
        try {
            $sql = "INSERT INTO item (id_item, nome_item, valor_item, disponivel, descricao, fk_Usuario_id_usuario) VALUES ('$i->id', '$i->name', '$i->value', '$i->available', '$i->description', '$i->id_user')";
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
    // public function get_item(int $id): Item{
    //     include 'C:\xampp\htdocs\ez_rent\back\connection.php';
    //     $result = $conn->query("SELECT * FROM item WHERE id_item = $id");
    //     $data = array();
    //     if ($result->num_rows > 0) {
    //         while ($row = $result->fetch_assoc()) {
    //             $data[] = $row;
    //         }
    //         $res = new Item($data['id_item'], $data['nome_item'], $data['valor_item'], $data['disponivel'], $data['categoria'], $data['descricao']);
    //     } else {
    //         $res = new Error('No results found.');
    //     }
    //     return $res;
    // }
    public function get_user_item(int $id)
    {
        include 'C:\xampp\htdocs\ez_rent\back\connection.php';
        $result = $conn->query("SELECT * FROM item WHERE fk_Usuario_id_usuario = $id");
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $item = new Item($row['id_item'], $row['nome_item'], $row['valor_item'], $row['disponivel'], $row['categoria'], $row['descricao'], $row['fk_Usuario_id_usuario']);
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
    public function update_item(Item $i): bool
    {
        include 'connection.php';
        try {
            $sql = "UPDATE item SET nome_item = $i->name, valor_item = $i->value, disponivel = $i->available, categoria = $i->group, descricao = $i->description WHERE id_item = $i->id";
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
    public function delete_item(int $id): bool
    {
        include 'connection.php';
        $sql = "DELETE FROM item WHERE id_item = $id";
        if ($db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
