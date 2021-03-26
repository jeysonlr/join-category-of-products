  /*
    Arquivo: 20210324_create_categorys_and_products
 */

create schema join_test;

create sequence join_test.join_categorias_produtos_seq
    increment 1
    minvalue 1
    maxvalue 999
    start 1
    cache 1;

create table join_test.join_categorias_produtos(
    id_categoria_planejamento integer not null default nextval('join_test.join_categorias_produtos_seq'::text::regclass),
    nome_categoria varchar not null,
    constraint id_categoria_planejamento_pk primary key(id_categoria_planejamento)
);

create sequence join_test.join_produtos_seq
    increment 1
    minvalue 1
    maxvalue 999
    start 1
    cache 1;

create table join_test.join_produtos(
    id_produto integer not null default nextval('join_test.join_produtos_seq'::text::regclass),
    id_categoria_planejamento integer not null,
    nome_produto varchar not null,
    valor_produto float,
    data_cadastro date not null,
    constraint id_produto_pk primary key(id_produto),
    constraint id_categoria_planejamento_fk foreign key (id_categoria_planejamento)
        references join_test.join_categorias_produtos(id_categoria_planejamento)
);
