#環境構築
##Docerビルド
1.
2.docker-compose up -d --build

*MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせてdocker-compose.ymlファイルを編集してください。

##laravel環境構築
1.docker-compose exec php bash
2.composer install
3..env.exampleファイルから.envを作成し、環境変数を変更
4.php artisan key:generate
5.php artisan migrate
6.php artisan db:seed

##使用技術
・PHP　7.4.9
・laravel  8.83.27
・MySQL　 8.2.0

##ER図
/ability-test/src/resources/css/ability-test.drawio.png
<img src="ability-test.drawio.png" alt="ER Diagram">

##URL
・開発環境：http//localhost/
・phpMyadmin：thhp//localhost:8080/


