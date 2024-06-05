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
        $result = $conn->query("SELECT DISTINCT Item.*, Categoria_item.descricao AS descricao_cat 
        FROM Item 
        INNER JOIN carrinho ON carrinho.fk_id_item = Item.id_item 
        INNER JOIN Categoria_item ON Item.fk_Categoria_item = Categoria_item.id_categoria 
        WHERE carrinho.fk_id_usuario = '$id_usuario';");
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $item = new Item($row['nome_item'], $row['valor_item'], $row['disponivel'], $row['descricao_cat'], $row['descricao'], $row['fk_Usuario_id_usuario'], $row['data_inicio'], $row['data_final']);
                $item->set_id($row['id_item']);
                $item->group_description = $row['descricao_cat'];
                $item->dataInicio = $row['data_inicio'];
                $item->dataFinal = $row['data_final'];
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

    public function enviar_solicitacao(int $id_item, int $id_usuario, int $id_locador)
    {
        include 'C:\xampp\htdocs\ez_rent\back\connection.php';
        $sql = "INSERT INTO Aluguel(fk_Usuario_id_usuario, fk_Item_id_item, fk_Locador_id_usuario) 
        VALUES ($id_usuario, $id_item, $id_locador)";
        if ($conn->query($sql) === true) {
            $sql2 = "UPDATE Item SET disponivel = false WHERE id_item = $id_item";
            $sql3 = "DELETE FROM carrinho WHERE fk_id_usuario = $id_usuario AND fk_id_item = $id_item";
            if ($conn->query($sql2) && $conn->query($sql3)) {
                return true;
            };
        } else {
            return false;
        }
    }

    public function cancelar_aluguel(int $id_item, int $id_usuario)
    {
        include 'C:\xampp\htdocs\ez_rent\back\connection.php';
        $sql = "SELECT id_aluguel FROM aluguel WHERE fk_Usuario_id_usuario = '$id_usuario' AND fk_Item_id_item = '$id_item'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id_aluguel'];
                $sql2 = "DELETE FROM Aluguel WHERE id_aluguel = $id";
                if ($conn->query($sql2) === true) {
                    $sql3 = "UPDATE Item SET disponivel = 1 WHERE id_item = $id_item";
                    if ($conn->query($sql3) === true) {
                        return true;
                    }
                } else {
                    return false;
                }
            }
        }
    }
}
