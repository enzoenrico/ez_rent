INSERT INTO Usuario (
        id_usuario,
        nome_usuario,
        email_usuario,
        telefone_usuario,
        senha_usuario
    )
VALUES (
        1,
        'Alice',
        'alice@example.com',
        1234567890,
        'securepass'
    ),
    (
        2,
        'Bob',
        'bob@example.com',
        9876543210,
        'strongpass'
    );
INSERT INTO Item (
        id_item,
        nome_item,
        valor_item,
        disponivel,
        categoria_item,
        fk_Usuario_id_usuario,
        fk_Pedido_id_pedido
    )
VALUES (1, 'Laptop', 1200.00, true, 3, 1, NULL),
    (2, 'Camera', 500.00, true, 2, 2, NULL);

INSERT INTO Aluguel (
        id_aluguel,
        data_hora_inicio,
        data_hora_final,
        fk_Usuario_id_usuario
    )
VALUES (1, '2024-03-15', '2024-03-20', 1),
    (2, '2024-03-18', '2024-03-22', 2);

INSERT INTO Pedido (id_pedido, fk_Aluguel_id_aluguel)
VALUES (1, 1),
    (2, 2);

INSERT INTO Categoria_item (id_categoria, descricao)
VALUES (1, 'Electronics'),
    (2, 'Photography'),
    (3, 'Office Supplies');

INSERT INTO pertence (fk_Categoria_item_id_categoria, fk_Item_id_item)
VALUES (1, 1),
    (2, 2);
