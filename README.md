# Principais características
O sistema de biblioteca funciona com 2 tipos de usuários: 

Bibliotecários que além dos acessos aos privilégios de usuários ainda tem acesso a criação de usuários, cadastro de livros, empréstimo de livros para usuários e consulta de livros e usuários.
Alunos ou Professores são usuários normais do sistema, estes usuários podem consultar livros, consultar seus empréstimos e podem modificar seus dados ou senha.

O cadastro de livros utilizam os seguintes dados:
ISBN que de acordo com a Câmara Brasileira do Livro, “o ISBN (International Standard Book Number/ Padrão Internacional de Numeração de Livro) é um padrão numérico criado com o objetivo de fornecer uma espécie de “RG” para publicações monográficas, como livros, artigos e apostilas. A difusão global do ISBN e a facilidade com que é lido por redes de varejo, bibliotecas e sistemas gerais de catalogação, tornou-o imprescindível para qualquer publicação.

Número do Tombo que constitui a primeira medida para tratar a publicação.
Em um livro de tombo ou livro de registro, a numeramos por ordem de entrada na biblioteca e
registramos esse número no verso da folha de rosto, com um carimbo apropriado para este fim.

Título do Livro.

Autores.

Edição

Ano

Editora

Exemplar que é o número do exemplar que foi emprestado, caso a biblioteca tenha mais do que 1 exemplar do mesmo.

Os livros podem ser definidos como Literatura, Didáticos ou Técnicos.

# Requisitos
Xampp Apache, PHP 8.1 e MySQL.

# Como utilizar
Processo de acesso.

Após a inserção dos arquivos da biblioteca na pasta HTDOCS do Xampp, é necessário ativar o apache do xampp e o mysql.

É necessário importar o banco de dados com o nome biblioteca.sql e acessar o localhost para acessar a biblioteca.

O usuário aluno para teste é aluno, senha aluno. O usuário para teste de bibliotecario é bibliotecario, senha bibliotecario.