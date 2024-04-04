<?php
class User
{
    public int $id;
    public string $name;
    public string $email;
    public string $telephone;
    private string|null $passwd;

    public function __construct($id, $name, $email, $telephone)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->telephone = $telephone;
        // $this->passwd = $passwd;
    }
    public function set_pass($passwd)
    {
        $this->passwd = $passwd;
    }
    public function get_pass(): string
    {
        return $this->passwd;
    }
}

class UserMethods
{
    /**
     * This PHP function retrieves all records from the "usuario" table in a database.
     * 
     * @return void The `getAll` function is returning the result of a query that selects all columns from
     * the `usuario` table in the database.
     */
    public static function get_all()
    {
        include 'connection.php';
        $result = $db->query("SELECT * FROM usuario");
        return $result;
    }

    /**
     * Retrieves a user by their ID.
     *
     * @param int $id The ID of the user to retrieve.
     * @return User|Error The user object if found, or an error object if not found.
     */
    public function get_user(int $id): User| Error
    {
        include 'connection.php';
        $result = $conn->query("SELECT * FROM usuario WHERE id_usuario = '$id'");
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $res = new User($data['id_usuario'], $data['nome_usuario'], $data['email_usuario'], $data['telefone_usuario']);
            $res->set_pass($data['senha_usuario']);
        } else {
            $res = new Error('No results found.');
        }
        return $res;
    }
    /**
     * The function setUser takes a User object, extracts its information, and inserts it into a
     * database table named usuario.
     * 
     * @param User user It looks like you are trying to create a function `setUser` that inserts user
     * data into a database table. The function takes a `User` object as a parameter and then
     * constructs an SQL query to insert the user's information into the `usuario` table.
     * 
     * @return bool The `setUser` function is returning a boolean value. If the SQL query to insert a
     * new user into the database is successful, it returns `true`. Otherwise, it returns `false`.
     */
    public static function set_user(User $user01): bool
    {
        include 'C:\xampp\htdocs\ez_rent\back\connection.php';

        $passwd = $user01->get_pass();
        try {
            $sql = "INSERT INTO usuario (id_usuario, nome_usuario, email_usuario, telefone_usuario, senha_usuario) VALUES ('$user01->telephone', '$user01->name', '$user01->email', '$user01->telephone', '$passwd')";
            $conn->query($sql);
            echo "DEUUU POHA";
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * This PHP function deletes a user from a database based on their ID.
     * 
     * @param id The `id` parameter in the `deleteUser` function represents the unique identifier of
     * the user that you want to delete from the database. This function takes the `id` as input,
     * constructs a SQL query to delete the user with that specific `id` from the `usuario` table in
     * the
     * 
     * @return bool The function `deleteUser` is returning a boolean value. If the deletion query is
     * successful, it returns `true`, otherwise it returns `false`.
     */
    public function delete_user($id): bool
    {
        include 'connection.php';
        $sql = "DELETE FROM usuario WHERE id_usuario = '$id'";
        if ($db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * This PHP function updates user information in a database based on the provided User object and
     * search ID.
     * 
     * @param User user Based on the provided code snippet, it seems like you are trying to update a
     * user's information in a database. The `update_user` function takes two parameters:
     * @param int search_id The `search_id` parameter in the `update_user` function is used to specify
     * the unique identifier of the user in the database that you want to update. This identifier is
     * typically the primary key of the user table, such as the user's ID.
     * 
     * @return bool The `update_user` function is returning a boolean value. It returns `true` if the
     * SQL query to update the user information in the database is successful, and `false` if there is
     * an error during the update process.
     */
    public function update_user(User $user, int $search_id): bool
    {
        include 'connection.php';
        $sql = "UPDATE usuario SET nome_usuario = '$user->name', email_usuario = '$user->email', telefone_usuario = '$user->telephone' WHERE id_usuario = '$search_id'";
        if ($db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
