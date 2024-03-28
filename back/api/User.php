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
    public static function get_id()
    {
        include 'connection.php';
        $result = $db->query("SELECT * FROM usuario");
        return $result;
    }

    /**
     * This PHP function retrieves user data from a database based on the username provided and returns
     * either a User object with the data or an Error object if no results are found.
     * 
     * @param user The `getUser` function you provided seems to be fetching user data from a database
     * based on the username provided. It then creates a `User` object if the user is found, or an
     * `Error` object if no results are found.
     * 
     * @return User|Error The `getUser` function is returning either a `User` object if a user with
     * the specified username is found in the database, or an `Error` object with the message 'No
     * results found' if no user is found.
     */
    public function get_user(string $user): User| Error
    {
        include 'connection.php';
        $result = $db->query("SELECT * FROM usuario WHERE nome_usuario = '$user'");
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
    public static function set_user(User $user): bool
    {
        include 'connection.php';
        // echo $user->id;
        $passwd = $user->get_pass();
        try {
            $sql = "INSERT INTO usuario (id_usuario, nome_usuario, email_usuario, telefone_usuario, senha_usuario) VALUES ('$user->telephone', '$user->name', '$user->email', '$user->telephone', '$passwd')";
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
     * The updateUser function updates user information in a database based on the provided parameters.
     * 
     * @param id The `id` parameter in the `updateUser` function represents the unique identifier of
     * the user whose information you want to update in the database. It is used to specify which
     * user's record should be updated with the new information provided in the function call.
     * @param name The `updateUser` function you provided seems to update user information in a
     * database. The parameters passed to the function are as follows:
     * @param email It looks like you were about to provide the email parameter for the `updateUser`
     * function but it got cut off. Could you please provide the email parameter so I can assist you
     * further with the function?
     * @param phone The parameter `` in the `updateUser` function represents the phone number of
     * the user that you want to update in the database. It is used to update the `telefone_usuario`
     * field in the `usuario` table with the new phone number provided.
     * @param pass It seems like you might have missed providing the value for the `pass` parameter in
     * the `updateUser` function. The `pass` parameter typically represents the password for the user.
     * When calling the `updateUser` function, you should pass the user's password as an argument.
     * 
     * @return bool The `updateUser` function returns a boolean value. It returns `true` if the SQL
     * query to update the user information in the database is successful, and `false` if there is an
     * error or the query fails.
     */
    public function update_user(User $user): bool
    {
        include 'connection.php';
        $sql = "UPDATE usuario SET nome_usuario = '$user->name', email_usuario = '$user->email', telefone_usuario = '$user->telephone' WHERE id_usuario = '$user->id'";
        if ($db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
