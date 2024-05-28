<?php
class Aluguel
{
    private int $id_aluguel;
    public int $id_locador;
    public int $id_locatario;
    public int $id_item;

    public function __construct(int $id_item, int $id_locador, int $id_locatario)
    {
        $this->id_locador = $id_locador;
        $this->id_locatario = $id_locatario;
        $this->id_item = $id_item;
    }

    public function get_id(): int
    {
        return $this->id_aluguel;
    }

    public function se_id(int $id_aluguel)
    {
        $this->id_aluguel = $id_aluguel;
    }
}

class AluguelMethods
{
    public function add_Carrinho(int $id_item, int $id_usuario)
    {
        include 'C:\xampp\htdocs\ez_rent\back\connection.php';
        try {
            $sql = "INSERT INTO carrinho (fk_id_item, fk_id_usuario) VALUES ('$id_item', '$id_usuario')";
            $conn->query($sql);
        } catch (\Throwable $th) {
            echo $th;
            return false;
        }
        return true;
    }

    public function get_Carrinho(int $id_usuario)
    {
        include 'C:\xampp\htdocs\ez_rent\back\connection.php';
        $result = $conn->query("SELECT DISTINCT Item.*, Categoria_item.descricao as descricao_cat FROM Item 
        INNER JOIN carrinho on fk_id_usuario = item.fk_Usuario_id_usuario AND fk_id_item = item.id_item 
        INNER JOIN Categoria_item ON Item.fk_Categoria_item = Categoria_item.id_categoria 
        WHERE carrinho.fk_id_usuario = '$id_usuario';");
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $item = new Item($row['nome_item'], $row['valor_item'], $row['disponivel'], $row['descricao_cat'], $row['descricao'], $row['fk_Usuario_id_usuario']);
                $item->set_id($row['id_item']);
                $item->group_description = $row['descricao_cat'];
                $data[] = $item;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function delete_Carrinho(int|null $id_item, int $id_usuario)
    {

        include 'C:\xampp\htdocs\ez_rent\back\connection.php';
        if ($id_item == null) {
            $sql = "DELETE FROM carrinho WHERE fk_id_usuario = '$id_usuario'";
            if ($conn->query($sql) === TRUE) {
                return true;
            } else {
                return false;
            }
        } else {
            $sql = "DELETE FROM carrinho WHERE fk_id_item = '$id_item' AND fk_id_usuario = '$id_usuario'";
            if ($conn->query($sql) === TRUE) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function checkCarrinho(int $id_usuario)
    {
        include 'C:\xampp\htdocs\ez_rent\back\connection.php';

        $result = $conn->query("SELECT * FROM carrinho WHERE fk_id_usuario = '$id_usuario'");
        if ($result) {
            if ($result->num_rows > 0) {
                $this->delete_Carrinho(null, $id_usuario);
            }
        }
    }
}
