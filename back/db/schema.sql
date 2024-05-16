CREATE TABLE Usuario (
    id_usuario int PRIMARY KEY AUTO_INCREMENT,
    nome_usuario varchar(100),
    email_usuario varchar(100),
    telefone_usuario varchar(100),
    senha_usuario varchar(100)
);
CREATE TABLE Item (
    id_item int PRIMARY KEY AUTO_INCREMENT,
    nome_item varchar(100),
    valor_item double,
    disponivel boolean,
    fk_Categoria_item int,
    fk_Usuario_id_usuario int,
    fk_Pedido_id_pedido int
);
CREATE TABLE Aluguel (
    id_aluguel int PRIMARY KEY AUTO_INCREMENT,
    data_hora_inicio date,
    data_hora_final date,
    fk_Usuario_id_usuario int
);
CREATE TABLE Pedido (
    id_pedido int PRIMARY KEY AUTO_INCREMENT,
    fk_Aluguel_id_aluguel int
);
CREATE TABLE Categoria_item (
    id_categoria int PRIMARY KEY AUTO_INCREMENT,
    descricao varchar(200)
);
CREATE TABLE pertence (
    fk_Categoria_item_id_categoria int,
    fk_Item_id_item int
);
ALTER TABLE Item
ADD CONSTRAINT FK_Item_1 FOREIGN KEY (fk_Usuario_id_usuario) REFERENCES Usuario (id_usuario) ON DELETE CASCADE;
ALTER TABLE Item
ADD CONSTRAINT FK_Item_2 FOREIGN KEY (fk_Pedido_id_pedido) REFERENCES Pedido (id_pedido) ON DELETE RESTRICT;
ALTER TABLE Item
ADD CONSTRAINT FK_Item_3 FOREIGN KEY (fk_Categoria_item) REFERENCES Categoria_item(id_categoria) ON DELETE CASCADE;
ALTER TABLE Aluguel
ADD CONSTRAINT FK_Aluguel_2 FOREIGN KEY (fk_Usuario_id_usuario) REFERENCES Usuario (id_usuario) ON DELETE CASCADE;
ALTER TABLE Pedido
ADD CONSTRAINT FK_Pedido_2 FOREIGN KEY (fk_Aluguel_id_aluguel) REFERENCES Aluguel (id_aluguel) ON DELETE RESTRICT;
ALTER TABLE pertence
ADD CONSTRAINT FK_pertence_1 FOREIGN KEY (fk_Categoria_item_id_categoria) REFERENCES Categoria_item (id_categoria) ON DELETE RESTRICT;
ALTER TABLE pertence
ADD CONSTRAINT FK_pertence_2 FOREIGN KEY (fk_Item_id_item) REFERENCES Item (id_item) ON DELETE
SET NULL;

ALTER TABLE Item
    ADD COLUMN descricao varchar(200),
    ADD COLUMN imagem varchar(100),
    ADD COLUMN imagemExtensao varchar(10);

ALTER TABLE Aluguel
    ADD COLUMN fk_Locador_id_usuario int,
    ADD CONSTRAINT FK_Aluguel_3 FOREIGN KEY (fk_Locador_id_usuario) REFERENCES Usuario (id_usuario) ON DELETE CASCADE;

INSERT INTO categoria_item(id_categoria, descricao) VALUES (1, 'Tecnologia'), (2, 'Roupa'), (3, 'Utensílio');