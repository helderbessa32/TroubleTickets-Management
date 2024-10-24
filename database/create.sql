-- Desativar foreign_keys para evitar erros na DROP TABLE. Estas são atividades no populate.sql para garantir a integridade referencial
PRAGMA foreign_keys = off;
.mode columns
.headers on
.nullvalue NULL

DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name    VARCHAR(255) NOT NULL,
    email   VARCHAR(255) NOT NULL UNIQUE,
    username VARCHAR(255) NOT NULL,
    pass    VARCHAR(25) NOT NULL,
    roles VARCHAR(255) NOT NULL DEFAULT 'client',
    photo TEXT
);

DROP TABLE IF EXISTS departments;
CREATE TABLE departments (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name_dept TEXT NOT NULL UNIQUE
);

DROP TABLE IF EXISTS hashtags;
CREATE TABLE hashtags (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name_tag TEXT NOT NULL UNIQUE
);

DROP TABLE IF EXISTS tickets;
CREATE TABLE tickets (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    description TEXT NOT NULL,
    status TEXT NOT NULL DEFAULT 'unsolved',
    priority TEXT NOT NULL DEFAULT 'low',
    user_id INTEGER NOT NULL,
    department_id INTEGER NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (department_id) REFERENCES departments(id)
);

DROP TABLE IF EXISTS faq;
CREATE TABLE faq (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    question TEXT NOT NULL,
    answer TEXT NOT NULL,
    hashtag_id INTEGER NOT NULL,
    FOREIGN KEY (hashtag_id) REFERENCES hashtags(id)
);

DROP TABLE IF EXISTS replies;
CREATE TABLE replies(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    ticket_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    message TEXT NOT NULL,
    FOREIGN KEY (ticket_id) REFERENCES tickets(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

DROP TABLE IF EXISTS user_dept;
CREATE TABLE user_dept(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    department_id INTEGER NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (department_id) REFERENCES departments(id)
);


-- Tabela "agents"
DROP TABLE IF EXISTS agents;
CREATE TABLE agents (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER UNIQUE,
    user_dept_id INTEGER UNIQUE,
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (user_dept_id) REFERENCES user_dept(id)
);

-- Tabela "admins"
DROP TABLE IF EXISTS admins;
CREATE TABLE admins (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER UNIQUE,
    FOREIGN KEY (user_id) REFERENCES users (id)
);


insert into users (id, name, email, username, pass, roles) VALUES (1, 'Diogo Gomes', 'up201905991@up.pt', 'diogoafg7', '$2a$12$WEiu/a8MbNk7nr6HfCpKFuZDJAgaBB3Ms8iHONybBtxjW4YbGr1Na', 'admin');  --Pass:'Abc#123'
insert into users (id, name, email, username, pass, roles) VALUES (2, 'Arlina Arr', 'aarr1@list-manage.com', 'aarr1', '$2a$12$WEiu/a8MbNk7nr6HfCpKFuZDJAgaBB3Ms8iHONybBtxjW4YbGr1Na', 'client');
insert into users (id, name, email, username, pass, roles) VALUES (3, 'Fitz Steddall', 'fsteddall2@dropbox.com', 'fsteddall2', '$2a$12$WEiu/a8MbNk7nr6HfCpKFuZDJAgaBB3Ms8iHONybBtxjW4YbGr1Na', 'client');
insert into users (id, name, email, username, pass, roles) VALUES (4, 'Lodovico Bowdidge', 'lbowdidge3@ning.com', 'lbowdidge3', '$2a$12$WEiu/a8MbNk7nr6HfCpKFuZDJAgaBB3Ms8iHONybBtxjW4YbGr1Na', 'client');
insert into users (id, name, email, username, pass, roles) VALUES (5, 'Shayla Toopin', 'stoopin4@deviantart.com', 'stoopin4', '$2a$12$WEiu/a8MbNk7nr6HfCpKFuZDJAgaBB3Ms8iHONybBtxjW4YbGr1Na', 'client');
INSERT INTO users (id, name, email, username, pass, roles) VALUES (6, 'Arlina Arr', 'aargr1@list-manage.com', 'aafrr1', '$2a$12$WEiu/a8MbNk7nr6HfCpKFuZDJAgaBB3Ms8iHONybBtxjW4YbGr1Na', 'client');
INSERT INTO users (id, name, email, username, pass, roles) VALUES (7, 'Fitz Steddall', 'fstedgdall2@dropbox.com', 'fstfeddall2', '$2a$12$WEiu/a8MbNk7nr6HfCpKFuZDJAgaBB3Ms8iHONybBtxjW4YbGr1Na', 'client');
INSERT INTO users (id, name, email, username, pass, roles) VALUES (8, 'Lodovico Bowdidge', 'lbgowdidge3@ning.com', 'lbowfdidge3', '$2a$12$WEiu/a8MbNk7nr6HfCpKFuZDJAgaBB3Ms8iHONybBtxjW4YbGr1Na', 'client');
INSERT INTO users (id, name, email, username, pass, roles) VALUES (9, 'Shayla Toopin', 'stoopgin4@deviantart.com', 'stofopin4', '$2a$12$WEiu/a8MbNk7nr6HfCpKFuZDJAgaBB3Ms8iHONybBtxjW4YbGr1Na', 'admin');
INSERT INTO users (id, name, email, username, pass, roles) VALUES (10, 'John Doe', 'johndgoe@example.com', 'johnfdoe', '$2a$12$WEiu/a8MbNk7nr6HfCpKFuZDJAgaBB3Ms8iHONybBtxjW4YbGr1Na', 'client');
INSERT INTO users (id, name, email, username, pass, roles) VALUES (11, 'Jane Smith', 'janesgmitgh@example.com', 'janesfmith', '$2a$12$WEiu/a8MbNk7nr6HfCpKFuZDJAgaBB3Ms8iHONybBtxjW4YbGr1Na', 'client');
INSERT INTO users (id, name, email, username, pass, roles) VALUES (12, 'Michael Johnson', 'michagelgjohnson@example.com', 'mifchaeljohnson', '$2a$12$WEiu/a8MbNk7nr6HfCpKFuZDJAgaBB3Ms8iHONybBtxjW4YbGr1Na', 'admin');
INSERT INTO users (id, name, email, username, pass, roles) VALUES (13, 'Emily Brown', 'emilgybrown@example.com', 'emilfybrown', '$2a$12$WEiu/a8MbNk7nr6HfCpKFuZDJAgaBB3Ms8iHONybBtxjW4YbGr1Na', 'client');
INSERT INTO users (id, name, email, username, pass, roles) VALUES (14, 'David Wilson', 'davidgwilson@example.com', 'davifdwilson', '$2a$12$WEiu/a8MbNk7nr6HfCpKFuZDJAgaBB3Ms8iHONybBtxjW4YbGr1Na', 'client');



insert into departments (id, name_dept) values (1, 'Legal');
insert into departments (id, name_dept) values (2, 'Sales');
insert into departments (id, name_dept) values (3, 'Marketing');
insert into departments (id, name_dept) values (4, 'Engineering');
INSERT INTO departments (id, name_dept) VALUES (5, 'Finance');
INSERT INTO departments (id, name_dept) VALUES (6, 'Human Resources');
INSERT INTO departments (id, name_dept) VALUES (7, 'IT');
INSERT INTO departments (id, name_dept) VALUES (8, 'Customer Support');
INSERT INTO departments (id, name_dept) VALUES (9, 'Operations');
INSERT INTO departments (id, name_dept) VALUES (10, 'Research and Development');



insert into hashtags (id, name_tag) values (1, 'aliquam');
insert into hashtags (id, name_tag) values (2, 'facilisi');
insert into hashtags (id, name_tag) values (3, 'eleifend');
insert into hashtags (id, name_tag) values (4, 'tincidunt');
insert into hashtags (id, name_tag) values (5, 'platea');
insert into hashtags (id, name_tag) values (6, 'blandit');
insert into hashtags (id, name_tag) values (7, 'sem');
insert into hashtags (id, name_tag) values (8, 'diam');
insert into hashtags (id, name_tag) values (9, 'tempus');
insert into hashtags (id, name_tag) values (10, 'est');
insert into hashtags (id, name_tag) values (11, 'mi');
insert into hashtags (id, name_tag) values (12, 'tristique');
insert into hashtags (id, name_tag) values (13, 'volutpat');
insert into hashtags (id, name_tag) values (14, 'integer');
insert into hashtags (id, name_tag) values (15, 'amet');

insert into tickets (id, title, description, status, priority, user_id, department_id) values (1, 'PC', 'O preço do portátil no site e na loja não tem o mesmo desconto', 'unsolved', 'high', '1', '2');
insert into tickets (id, title, description, status, priority, user_id, department_id) values (2, 'NOS', 'O Router não funciona', 'unsolved', 'high', '1', '4');
insert into tickets (id, title, description, status, priority, user_id, department_id) values (3, 'MatrizAuto', 'Erro na campanha publicitária.', 'unsolved', 'high', '3', '3');
insert into tickets (id, title, description, status, priority, user_id, department_id) values (4, 'Advogado', 'Certidão de óbito não entregue', 'unsolved', 'low', '1', '1');
INSERT INTO tickets (id, title, description, status, priority, user_id, department_id) VALUES (5, 'Printer Issue', 'Printer is not printing properly', 'unsolved', 'medium', '2', '4');
INSERT INTO tickets (id, title, description, status, priority, user_id, department_id) VALUES (6, 'Network Connectivity', 'Experiencing network connectivity issues', 'unsolved', 'high', '4', '2');
INSERT INTO tickets (id, title, description, status, priority, user_id, department_id) VALUES (7, 'Website Error', 'Encountering errors on the website', 'unsolved', 'medium', '5', '3');
INSERT INTO tickets (id, title, description, status, priority, user_id, department_id) VALUES (8, 'Email Not Sending', 'Unable to send emails from the account', 'unsolved', 'low', '3', '1');
INSERT INTO tickets (id, title, description, status, priority, user_id, department_id) VALUES (9, 'Software Installation', 'Need assistance with installing software', 'unsolved', 'medium', '2', '4');
INSERT INTO tickets (id, title, description, status, priority, user_id, department_id) VALUES (10, 'Billing Inquiry', 'Billing discrepancy on the invoice', 'unsolved', 'low', '1', '2');
INSERT INTO tickets (id, title, description, status, priority, user_id, department_id) VALUES (11, 'Software Crashes', 'The software keeps crashing unexpectedly', 'unsolved', 'high', '3', '4');
INSERT INTO tickets (id, title, description, status, priority, user_id, department_id) VALUES (12, 'Website Access Issue', 'Unable to access certain pages on the website', 'unsolved', 'medium', '5', '3');
INSERT INTO tickets (id, title, description, status, priority, user_id, department_id) VALUES (13, 'Product Return Request', 'Requesting a return for a defective product', 'solved', 'low', '2', '2');
INSERT INTO tickets (id, title, description, status, priority, user_id, department_id) VALUES (14, 'Database Connection Error', 'Unable to connect to the database', 'solved', 'high', '4', '1');
INSERT INTO tickets (id, title, description, status, priority, user_id, department_id) VALUES (15, 'Email Spam Issue', 'Receiving excessive spam emails', 'unsolved', 'medium', '5', '4');


insert into faq (id, question, answer, hashtag_id) values (1, 'Como recupero pass?', 'Manda email', '1');
insert into faq (id, question, answer, hashtag_id) values (2, 'Este site é seguro?', 'Sim, totalmente verificado', '1');
insert into faq (id, question, answer, hashtag_id) values (3, 'Onde encontro os patrocinadores?', 'No fundo da pagina inicial', '1');
insert into faq (id, question, answer, hashtag_id) values (4, 'Como posso contactar o suporte?', 'Via email', '1');
insert into faq (id, question, answer, hashtag_id) values (5, 'Nao responderam ao meu ticket porque?', 'Nao tivemos tempo', '1');
INSERT INTO faq (id, question, answer, hashtag_id) VALUES (6, 'Qual é a política de reembolso?', 'Para solicitar um reembolso, entre em contato com nosso suporte ao cliente.', '1');
INSERT INTO faq (id, question, answer, hashtag_id) VALUES (7, 'Posso alterar o meu nome de usuário?', 'Sim, você pode alterar seu nome de usuário nas configurações da sua conta.', '1');
INSERT INTO faq (id, question, answer, hashtag_id) VALUES (8, 'Como faço para atualizar minhas informações de pagamento?', 'Acesse a seção de pagamento nas configurações da sua conta e atualize as informações necessárias.', '1');
INSERT INTO faq (id, question, answer, hashtag_id) VALUES (9, 'O que devo fazer se esqueci minha senha?', 'Na página de login, clique em "Esqueci minha senha" e siga as instruções para redefinir sua senha.', '1');
INSERT INTO faq (id, question, answer, hashtag_id) VALUES (10, 'Como faço para cancelar minha assinatura?', 'Entre em contato com nosso suporte ao cliente para solicitar o cancelamento da assinatura.', '1');
INSERT INTO faq (id, question, answer, hashtag_id) VALUES (11, 'Como faço para alterar meu endereço de e-mail?', 'Você pode alterar seu endereço de e-mail nas configurações da sua conta.', '1');

insert into replies (id, ticket_id, user_id, message) values (1, 1, 1, 'Faz reclamação no livro');
insert into replies  (id,ticket_id, user_id, message) values (2, 2, 1, 'Compra um novo');

insert into user_dept  (id, user_id, department_id) values (1, 1, 1);
insert into user_dept  (id, user_id, department_id) values (2, 1, 2);
insert into user_dept  (id, user_id, department_id) values (3, 1, 3);
insert into user_dept  (id, user_id, department_id) values (4, 1, 4);
insert into user_dept  (id, user_id, department_id) values (5, 2, 5);

insert into admins (id, user_id) values (1,1);
insert into admins (id, user_id) values (2,9);
insert into admins (id, user_id) values (3,12);
