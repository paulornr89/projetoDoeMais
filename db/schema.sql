create table usuarios (
	id serial primary key,
	email varchar(100) unique not null,
	senha varchar(255) not null,
	tipo VARCHAR(20) NOT NULL CHECK (tipo IN ('D', 'I')),--D é doador e I é instituicao
    criado_em TIMESTAMP not null default current_timestamp
)

create table doadores (
	id_usuario INTEGER PRIMARY KEY,
	cpf_cnpj varchar(14) not null unique,
	nome varchar(50) not null,
	telefone varchar(11) not null,
	cep varchar(8) not null,
	endereco varchar(255) not null,
	cidade varchar(30) not null,
	uf varchar(2) not null,
	tipo char(2) not null check(tipo in ('PF', 'PJ')),
	CONSTRAINT fk_doador_usuario FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE
);

create table instituicoes (
	id_usuario INTEGER PRIMARY KEY,
	cnpj varchar(14) not null,
	razao varchar(100) not null,
	nome_fantasia varchar(100) not null,
	telefone varchar(11) not null,
	cep varchar(8) not null,
	endereco varchar(255) not null,
	cidade varchar(30) not null,
	uf varchar(2) not null,
	CONSTRAINT fk_instituicao_usuario FOREIGN KEY (id_usuario)
        REFERENCES usuarios(id) ON DELETE CASCADE
);

create table doacoes (
	id serial primary key,
	id_doador integer not null,
	id_instituicao integer not null,
	status char(1) not null check(status in ('P', 'C')),--P é pendente e C é concluída
	criado_em timestamp not null default current_timestamp,
	encerrado_em timestamp,
	
	FOREIGN KEY (id_doador) REFERENCES doadores(id_usuario),
    FOREIGN KEY (id_instituicao) REFERENCES instituicoes(id_usuario)
);

create table itens (
	id serial primary key,
	descricao varchar(30) not null,
	tipo varchar(2) not null check(tipo in ('AP', 'AN', 'VE', 'PL', 'PH')),/*Alimento Perecivel, Alimento nao perecivel, Vestuario, Produto de Limpeza, Produto de Higiene*/
	unidade varchar(6) not null
);

create table doacoes_itens (
	id_item integer not null references itens(id),
	id_doacao integer not null references doacoes(id),
	quantidade integer not null,
	
	primary key (id_item, id_doacao)
);

create table avaliacoes_doador (
	id serial primary key,
	id_doador integer not null,
	id_instituicao integer not null,
	estado_produtos char(1) not null check(estado_produtos in ('A', 'B', 'C', 'D')),
	pontualidade char(1) not null check(pontualidade in ('A', 'B', 'C', 'D')),
	observacoes varchar(255),
	criado_em timestamp not null default current_timestamp,
	
	FOREIGN KEY (id_doador) REFERENCES doadores(id_usuario),
    FOREIGN KEY (id_instituicao) REFERENCES instituicoes(id_usuario)
);

create table avaliacoes_instituicao (
	id serial primary key,
	id_doador integer not null,
	id_instituicao integer not null,
	atendimento char(1) not null check(atendimento in ('A', 'B', 'C', 'D')),
	confiabilidade char(1) not null check(confiabilidade in ('A', 'B', 'C', 'D')),
	coleta_recebimento char(1) not null check(coleta_recebimento in ('A', 'B', 'C', 'D')),
	observacoes varchar(255),
	criado_em timestamp not null default current_timestamp,
	
	FOREIGN KEY (id_doador) REFERENCES doadores(id_usuario),
    FOREIGN KEY (id_instituicao) REFERENCES instituicoes(id_usuario)
);