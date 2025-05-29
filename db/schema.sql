create table doadores (
	id serial primary key,
	cpf_cnpj varchar(14) not null unique,
	nome varchar(50) not null,
	email varchar(40) not null,
	telefone varchar(11) not null,
	cep varchar(8) not null,
	endereco varchar(255) not null,
	cidade varchar(30) not null,
	uf varchar(2) not null,
	senha varchar(20) not null,
	tipo char(2) not null check(tipo in ('PF', 'PJ'))
);

create table instituicoes (
	cnpj varchar(14) not null primary key,
	razao varchar(50) not null,
	email varchar(40) not null,
	telefone varchar(11) not null,
	cep varchar(8) not null,
	endereco varchar(255) not null,
	cidade varchar(30) not null,
	uf varchar(2) not null,
	senha varchar(20) not null
);

create table doacoes (
	id serial primary key,
	id_doador integer not null,
	id_instituicao varchar(14) not null,
	status char(1) not null check(status in ('A', 'O')),
	criado_em timestamp not null default current_timestamp,
	encerrado_em timestamp not null,
	
	foreign key(id_doador) references doadores (id),
	foreign key(id_instituicao) references instituicoes(cnpj)
);

create table itens (
	id serial primary key,
	descricao varchar(30) not null,
	tipo char(1) not null check(tipo in ('P', 'N')),/*Perecivel e nao perecivel*/
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
	id_instituicao varchar(14) not null,
	estado_produtos char(1) not null check(estado_produtos in ('A', 'B', 'C', 'D')),
	pontualidade char(1) not null check(pontualidade in ('A', 'B', 'C', 'D')),
	observacoes varchar(255),
	criado_em timestamp not null default current_timestamp,
	
	foreign key(id_doador) references doadores(id),
	foreign key(id_instituicao) references instituicoes(cnpj)
);

create table avaliacoes_instituicao (
	id serial primary key,
	id_doador integer not null,
	id_instituicao varchar(14) not null,
	atendimento char(1) not null check(atendimento in ('A', 'B', 'C', 'D')),
	confiabilidade char(1) not null check(confiabilidade in ('A', 'B', 'C', 'D')),
	coleta_recebimento char(1) not null check(coleta_recebimento in ('A', 'B', 'C', 'D')),
	observacoes varchar(255),
	criado_em timestamp not null default current_timestamp,
	
	foreign key(id_doador) references doadores(id),
	foreign key(id_instituicao) references instituicoes(cnpj)
);