USE petamigo;

-- Tabela de doadores
CREATE TABLE IF NOT EXISTS doadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    cpf VARCHAR(14) UNIQUE,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Adicionar coluna doador_id na tabela animais
ALTER TABLE animais ADD COLUMN IF NOT EXISTS doador_id INT;
ALTER TABLE animais ADD FOREIGN KEY IF NOT EXISTS (doador_id) REFERENCES doadores(id);

-- Adicionar mais informações aos animais
ALTER TABLE animais ADD COLUMN IF NOT EXISTS sexo ENUM('M', 'F');
ALTER TABLE animais ADD COLUMN IF NOT EXISTS vacinado BOOLEAN DEFAULT FALSE;
ALTER TABLE animais ADD COLUMN IF NOT EXISTS castrado BOOLEAN DEFAULT FALSE;
ALTER TABLE animais ADD COLUMN IF NOT EXISTS observacoes TEXT;