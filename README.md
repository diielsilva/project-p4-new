Este projeto foi criado apenas para fins de estudo, visando fazer um sistema simples de "vendas" utilizando o framework PHP Laravel, utilizando um pouco de Boostrap (no modo CDN).

Como usar:

1º Passo: Instalar o pacote AMP (Apache, MySQL e PHP) ou ter um servidor que possua ele instalado.

2º Passo: Instalar o composer, e com o composer criar a pasta que se deseja inserir o projeto.

3º Passo: Ao criar o projeto laravel com o composer, copiar para pasta do projeto os Models,os Controllers, as Views e o arquvo de rotas (web.php).

no caso do Laravel, os arquivos estão localizados respectivamente em "projeto"/app/(cole os Models aqui), "projeto"/app/Htpp/Controllers/(cole os Controllers aqui),
"projeto"/resources/views/(cole as Views aqui, e apague a View de "welcome") e por último substituir o arquivo de rotas que está localizado em "projeto"/routes/(cole o arquivo aqui).

4º Passo: Deverá ser alterado o arquivo session.php que está localizado em "projeto"/config/session.php e nele deve ser alterado a propriedade "expire_on_close" que deve ser modificada para TRUE.

5º Passo: Criação do banco de dados desejado, no caso deste projeto foi usado um banco MySQL, após a criação do banco deve ser alterado o arquivo .env localizado na raíz do projeto "projeto"/.env e nele deve ser inserido o usuário, o nome do banco de dados e a senha do usuário.

OBS: Não possui cadastro de funcionários e nem de administradores, pois foi pensando para apenas o administrador geral do sistema os inserir diretamente no banco.

Feito isso, o sistema deverá estar pronto para uso, qualquer bug, podem reportar!.
