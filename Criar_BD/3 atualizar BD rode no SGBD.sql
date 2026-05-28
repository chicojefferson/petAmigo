USE petamigo;

-- Adicionar colunas para o formulário de adoção
ALTER TABLE adocoes 
ADD COLUMN IF NOT EXISTS motivacao TEXT,
ADD COLUMN IF NOT EXISTS experiencia VARCHAR(50),
ADD COLUMN IF NOT EXISTS data_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP;