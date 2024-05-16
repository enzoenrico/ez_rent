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
    public function add_Aluguel(int $id_locatario, int $id_item){
        include 'C:\xampp\htdocs\ez_rent\back\connection.php';

        $id_locador = $conn->query("SELECT fk_Usuario_id_usuario FROM Item WHERE id_item = $id_item");

        try {
            $result = $conn->query("INSERT INTO Aluguel (fk_Usuario_id_usuario, fk_Locador_id_usuario, fk_Item_id_item) VALUES $id_locatario, $id_locador, $id_item");
        }catch (\Throwable $th) {
            echo $th;
            return false;
        }
        return $result;
    }

}
