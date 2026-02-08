CREATE DATABASE raio_escolar_mapas;
USE raio_escolar_mapas;

CREATE TABLE escolas (
 id INT AUTO_INCREMENT PRIMARY KEY,
 nome VARCHAR(150),
 latitude DECIMAL(10,8),
 longitude DECIMAL(10,8)
);

CREATE TABLE usuarios (
 id INT AUTO_INCREMENT PRIMARY KEY,
 usuario VARCHAR(50),
 senha VARCHAR(50),
 perfil ENUM('admin','operador')
);

CREATE TABLE historico_consultas (
 id INT AUTO_INCREMENT PRIMARY KEY,
 aluno_nome VARCHAR(150),
 latitude DECIMAL(10,8),
 longitude DECIMAL(10,8),
 escola_oficial VARCHAR(150),
 distancia DECIMAL(6,2),
 usuario VARCHAR(50),
 data_consulta DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO usuarios (usuario, senha, perfil) VALUES
('admin','123','admin'),
('operador','123','operador');

INSERT INTO usuarios (usuario, senha, perfil) VALUES ('FERNANDO FICANHA','FERNANDO','operador');

select * from escolas;

drop table escolas;


INSERT INTO escolas
(nome, latitude, longitude, atende_pre, atende_fundamental, atende_medio)
VALUES
('E.M Rio da Estiva', -26.337979043429716, -50.00979567666218, 1, 1, 1),
('E.M Bom Jesus', -26.328189497077762, -49.91230638213114, 1, 1, 1),
('E.M Renascer', -26.337125832902345, -49.911929264766115, 1, 1, 1),
('E.M Centro Educativo', -26.335798328380317, -49.90576236739267, 1, 1, 1),
('E.E.B Virgílio Várzea', -26.341378070371213, -49.9050207733936, 1, 1, 1);


ALTER TABLE historico_consultas
ADD etapa_ensino ENUM('Pré','Fundamental','Médio') NOT NULL AFTER aluno_nome;

ALTER TABLE escolas
ADD atende_pre TINYINT(1) DEFAULT 0,
ADD atende_fundamental TINYINT(1) DEFAULT 0,
ADD atende_medio TINYINT(1) DEFAULT 0;


