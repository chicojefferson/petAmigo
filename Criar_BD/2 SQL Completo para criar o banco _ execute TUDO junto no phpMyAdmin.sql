-- Criar e usar o banco de dados
CREATE DATABASE IF NOT EXISTS petamigo;
USE petamigo;

-- Tabela de usuários
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    endereco TEXT,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de animais
CREATE TABLE animais (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    especie VARCHAR(50) NOT NULL,
    raca VARCHAR(100),
    idade INT,
    porte VARCHAR(20),
    descricao TEXT,
    imagem VARCHAR(255),
    disponivel BOOLEAN DEFAULT TRUE,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de adoções
CREATE TABLE adocoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    animal_id INT,
    data_adocao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pendente', 'aprovada', 'rejeitada') DEFAULT 'pendente',
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (animal_id) REFERENCES animais(id)
);

-- Tabela de avaliações
CREATE TABLE avaliacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    animal_id INT,
    nota INT,
    comentario TEXT,
    data_avaliacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (animal_id) REFERENCES animais(id)
);

-- Inserir alguns animais de exemplo
INSERT INTO animais (nome, especie, raca, idade, porte, descricao, imagem) VALUES
('Rex', 'Cachorro', 'Golden Retriever', 2, 'Grande', 'Amigável e brincalhão, perfeito para famílias', 'dos.png'),
('Max', 'Cachorro', 'Labrador', 1, 'Grande', 'Inteligente e energético, ótimo companheiro', 'Labrador.png'),
('Luna', 'Cachorro', 'Shih Tzu', 3, 'Pequeno', 'Carinhoso e adaptável, ideal para apartamento', 'Shih Tzu.png'),
('Mimi', 'Gato', 'Maine Coon', 2, 'Grande', 'Gato tranquilo e sociável, de porte grande', 'Maine Coon.png'),
('Bella', 'Gato', 'Persa', 4, 'Médio', 'Calmo e elegante, de pelagem exuberante', 'Persa.png'),
('Charlie', 'Gato', 'Sphynx', 1, 'Médio', 'Carinhoso e único, não tem pelos', 'Sphynx.png');

-- Inserir um usuário admin para teste
INSERT INTO usuarios (nome, email, senha, telefone, endereco) VALUES 
('Administrador', 'admin@petamigo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '(11) 9999-9999', 'Rua dos Animais, 123');